@extends('template')

@section('content')

    <div class="clearfix" id="const-chat-cont">
      
    </div>

<script type="text/babel">

    class Messages extends React.Component{

        constructor(props){
            super(props)
            this.state={
                consultant:{
                    id:""
                 },
                message:"",
                selectedUser:""
            }
        }
 
        componentDidMount(){
            // get access token, then set it in local storages, then getg all the messages, then listen to messaegs
            this.getAccessToken()
      

        }

         getAccessToken=()=>{
            axios.post("/api/getAcessToken",{
                guard:"cons",
                email:document.getElementById("consEmail").value
            })
            .then(res=>{
                localStorage.setItem("api_token", res.data.api_token)
                //get all the conversations
                this.getAllTheConversations(res)
                
            })
            .catch(e=>{
                console.log(e)
            })
        }

        getAllTheConversations(res){
            axios.get("/api/consultant/messages",{
                    headers: { Authorization: `Bearer ${res.data.api_token}`}
                })
                .then(res=>{
                    this.setState({
                        consultant:res.data
                    })
                    this.listenFoConsultantMessages();
                    this.listenForStreamOffers()
                })
                .catch(e=>{
                    console.log(e)
                })
        }

        listenFoConsultantMessages(){
            
            Echo.connector.pusher.config.auth.headers['Authorization'] = `Bearer ${localStorage.getItem("api_token")}`;
                    Echo.private("messageFrom-user-toId-"+this.state.consultant.id)
                    .listen('MessageSent', (e) => {

                        var messages=this.state.selectedUser.messages
                        //push new message
                        messages.push({
                                    id:Math.random()*10,
                                    from:"user",
                                    message:e.message.message
                        })
                        //get selected user
                        var user=this.state.selectedUser
                        user.messages=messages
                        //set its new messages with new messatge we saved
                        //then add user to the state
                    
                        this.setState({
                            ...this.state,
                            selectedUser:user
                        })
                    });
        }

         listenForStreamOffers(){
           
                Echo.connector.pusher.config.auth.headers['Authorization'] = `Bearer ${localStorage.getItem("api_token")}`;
                Echo.private("offerFrom-user-toId-"+this.state.consultant.id)
                .listen('OfferSend',async (res) => {
                    console.log("offer ",res.offer)
                    const configuration=null
                    
                    const peerConnection = new RTCPeerConnection(configuration);
                    
                    await peerConnection.setRemoteDescription(new RTCSessionDescription(JSON.parse(res.offer)));
                    
                    const answer = await peerConnection.createAnswer();
                    await peerConnection.setLocalDescription(answer);
                    
                    axios.post("/api/consultant/send-answer",{
                        answer:answer,
                        toId:res.user.id
                    },{
                        headers: { Authorization: `Bearer ${localStorage.getItem("api_token")}`}
                    })
                    .then(res=>{
                        console.log(res)
                    })
                    .catch(err=>{
                        console.error("Sending answer error in consultant ",err)
                    })
                })

        }

        setText=(e)=>{
            this.setState({
                message:e.target.value
            })
        }
        sendText=(e)=>{
            if(e.key == "Enter" && e.shiftKey == false) {
                e.preventDefault()
                axios.post("/api/consultant/messages",{
                    message:this.state.message,
                    userId:this.state.selectedUser.id
                },{
                        headers: { Authorization: `Bearer ${localStorage.getItem("api_token")}`}
                })
                .then(res=>{
                    //get selected user messatges
                    var messages=this.state.selectedUser.messages
                    //push new message
                    messages.push({
                                id:Math.random()*10,
                                from:"consultant",
                                message:this.state.message
                    })
                    //get selected user
                    var user=this.state.selectedUser
                    user.messages=messages
                    //set its new messages with new messatge we saved
                    //then add user to the state
                
                    this.setState({
                        ...this.state,
                        selectedUser:user
                    })

                })
                .catch(err=>{
                    console.log(err)
                })
                e.target.value=""
            }
            
        }

        render(){
            var users=""
            var selectedUserMessages=""
            

            if(this.state.selectedUser!=""){
               selectedUserMessages=  <div className="messages-master-cont">
                            <div className="messages-header clearfix shadow">
                                <p>{this.state.selectedUser.email}</p>
                                <div className="messages-options">
                                    <i className="fas fa-phone-square fa-lg"></i>
                                    <i className="fas fa-video fa-lg"></i>
                                </div>
                            </div>
                            <div className="messages-body-cont clearfix">
                                <div className="messages-cont">
                                    <div className="message-text-cont">
                                        {
                                            this.state.selectedUser.messages.map(message=>{
                                                return(
                                                    <div key={message.id} className="message clearfix" >
                                                        <p className={message.from=="consultant"?"message-right":"message-left"}>{message.message}</p>
                                                    </div>
                                                )
                                            })
                                        }
                                        
                                    </div>
                                    <div className="message-send-text-cont">
                                        <textarea onKeyPress={this.sendText}  onChange={this.setText} placeholder="message...."></textarea>
                                    </div>
                                </div>
                                <div className="user-det-cont">
                                    <div className="user-det-img"><img src={this.state.selectedUser.profile_id} /></div>
                                    <ul>    
                                        <li><i className="fas fa-user"></i><span>User Name: </span><br />{this.state.selectedUser.name}</li>
                                        <li><i className="fas fa-at"></i><span>Email: </span><br />{this.state.selectedUser.email}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>   
                }

           if(this.state.consultant.users!=null ){
                users=this.state.consultant.users.map(user=>{
                return(
                    <div className="const-chat-cont clearfix">
                        <div key={user.id} onClick={()=>{this.setState({selectedUser:user})}} className="const-select-user-cont">
                            <div className="user-cont clearfix">
                                <div className="user-img"><img src={user.profile_id} /></div>
                                <div className="user-name">
                                    <p>{user.name}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                )
            })
           }

            return(
                <div class="clearfix" id="chat-cont">
                   {users}    
                   {selectedUserMessages}
                </div>
            )
        }
    }

    ReactDOM.render(<Messages />,document.getElementById("const-chat-cont"))

</script>

@endsection