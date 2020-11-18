@extends('template')

@section('content')


<div id="user-stream-cont">

</div>



<script  type="text/babel">

class Chat extends React.Component{

    constructor(props){
            super(props)
            this.localVideoStream=React.createRef();
            this.remoteVideoStream=React.createRef();
            this.state={
                user_id:localStorage.getItem("user_id"),
                configuration:null,
                peerConnection:null,
            }
    }

    componentDidMount(){
        //TODO - Add connections to states
        //TODO - Impelements async await
        this.callConsultant()
        this.listenForCallAcceptance()

  

    }

    componentDidUpdate(){
        if(this.state.peerConnection!=null){
          
            this.state.peerConnection.onicecandidate =(e)=>{
                    console.log("user ice ",e)
                }

                this.state.peerConnection.oniceconnectionstatechange=(e)=>{
                    console.log("user oniceconnectionstatechange ",e)
                }
                this.state.peerConnection.onaddstream=(e)=>{
                    console.log("user remoteVideoStream ",e)
                    this.remoteVideoStream.current.srcObject=e.stream
                }

        }
    }

    callConsultant(){
        axios.post("/api/user/call-cons",{},{
            headers: { Authorization: `Bearer ${localStorage.getItem("api_token")}`}
        })
        .then(res=>{
            console.log(res)
        })
        .catch(err=>{
            console.error("error in calling ",err)
        })
    }

    listenForCallAcceptance(){
        Echo.connector.pusher.config.auth.headers['Authorization'] = `Bearer ${localStorage.getItem("api_token")}`;
        Echo.private("acceptCall-toId-"+this.state.user_id)
        .listen('InitCall', (res) => {
            this.getRTCPConnection()
            this.listenToAnswers()
            console.log("acceptCall ",res)
        })
    }

    getLocalStream(){
        const constraints={ video: true, audio: true }  
        
        navigator.mediaDevices.getUserMedia(constraints)
        .then((stream)=>{
            this.localVideoStream.current.srcObject=stream
            var peerConnection=this.state.peerConnection
            stream.getTracks().forEach(track =>{
                peerConnection.addTrack(track, stream)
            });
            this.setState({
                peerConnection:peerConnection
            })
        })
        .catch(err=>{
            console.log("User media error ",err)
        });
    }

    async getRTCPConnection(){
        
        var peerConnection = new RTCPeerConnection(this.state.configuration);
     
        const offer =await peerConnection.createOffer()
        peerConnection.setLocalDescription(offer);

        this.setState({
            peerConnection:peerConnection
        })

        this.getLocalStream()


        //send offer
        axios.post("/api/user/send-offer",{
            offer:JSON.stringify(offer)
        },{
            headers: { Authorization: `Bearer ${localStorage.getItem("api_token")}`}
        })
        .then(res=>{
            console.log(res)
        })
        .catch(err=>{
            console.error("Sending offer error in user ",err)
        })

    }

    listenToAnswers(){
        Echo.connector.pusher.config.auth.headers['Authorization'] = `Bearer ${localStorage.getItem("api_token")}`;
        Echo.private("answerFrom-cons-toId-"+this.state.user_id)
        .listen('AnswerSend', (res) => {
            var peerConnection=this.state.peerConnection
            peerConnection.setRemoteDescription(new RTCSessionDescription(JSON.parse(res.answer)))
            this.setState({
                peerConnection:peerConnection
            })

            console.log("answer from cons ",res)
        })
    }

    render(){


        return(
            <div>
                <video ref={this.localVideoStream} width="320" height="240" autoPlay></video>    
                <video ref={this.remoteVideoStream} width="320" height="240" autoPlay></video>    
            </div>
        )
    }

}


ReactDOM.render(<Chat />,document.getElementById("user-stream-cont"))
</script>

@endsection
