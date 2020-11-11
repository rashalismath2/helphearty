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
                user_id:localStorage.getItem("user_id")
            }
    }

    componentDidMount(){
        //TODO - Add connections to states
        //TODO - Impelements async await

        this.getLocalStream()
        this.getRTCPConnection()
        this.listenToAnswers()
    }

    getLocalStream(){
        const constraints={video:true}
        
        navigator.mediaDevices.getUserMedia(constraints)
        .then((stream)=>{
            this.localVideoStream.current.srcObject=stream
        })
        .catch(err=>{
            console.log("User media error ",err)
        });
    }

    async getRTCPConnection(){
        const configuration=null
        const peerConnection = new RTCPeerConnection(configuration);
        const offer =await peerConnection.createOffer()
        peerConnection.setLocalDescription(offer);
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
