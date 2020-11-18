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
                api_token:localStorage.getItem("api_token"),
                configuration:null,
                peerConnection:null,
                userInCall:null
            }
    }

    componentDidMount(){
        //TODO - Add connections to states
        //TODO - Impelements async await
        this.setState({
            userInCall:localStorage.getItem("userInCallId")
        })
        this.listenForStreamOffers()
        
      
    }

    listenForStreamOffers(){
           
           Echo.connector.pusher.config.auth.headers['Authorization'] = `Bearer ${this.state.api_token}`;
           Echo.private("offerFrom-user-toId-"+this.state.user_id)
           .on('pusher:subscription_succeeded', (e)=> {
                //get the camera
                this.getLocalStream()
                this.answerCall();
            })
           .listen('OfferSend',async (res) => {
               console.log("offer ",res.offer)

               const peerConnection = new RTCPeerConnection(this.state.configuration);
               
               await peerConnection.setRemoteDescription(new RTCSessionDescription(JSON.parse(res.offer)));
               
               const answer = await peerConnection.createAnswer();
               await peerConnection.setLocalDescription(answer);
               
               this.setState({
                    peerConnection:peerConnection,
                    userInCall:res.user
               })

               peerConnection.onicecandidate=(e)=>{
                    console.log("user ice ",e)
                }

                peerConnection.oniceconnectionstatechange=(e)=>{
                    console.log("user oniceconnectionstatechange ",e)
                }
                peerConnection.onaddstream=(e)=>{
                    console.log("user remoteVideoStream ",e)
                    this.remoteVideoStream.current.srcObject=e.stream
                }

               axios.post("/api/consultant/send-answer",{
                   answer:JSON.stringify(answer),
                   toId:res.user.id
               },{
                   headers: { Authorization: `Bearer ${this.state.api_token}`}
               })
               .then(res=>{
                  
                   console.log("answer sent for the user ",res)
               })
               .catch(err=>{
                   console.error("Sending answer error in consultant ",err)
               })
           })
   }

    answerCall(){

        axios.post("/api/consultant/answer-call",{
                    userInCall:localStorage.getItem("userInCallId"),
            },{
                headers: { Authorization: `Bearer ${localStorage.getItem("api_token")}`}
            })
            .then(res=>{
                console.log("acceptance messegae sent ",res)
            })
            .catch(err=>{
                console.error("Sending call answer error in consultant ",err)
            })

    }

    
    getLocalStream(){
        const constraints={video:true}
        
        navigator.mediaDevices.getUserMedia(constraints)
        .then((stream)=>{
            this.localVideoStream.current.srcObject=stream
            var peerConnection=this.state.peerConnection
            peerConnection.addStream(stream)
            this.setState({
                peerConnection:peerConnection
            })
        })
        .catch(err=>{
            console.log("User media error ",err)
        });
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
