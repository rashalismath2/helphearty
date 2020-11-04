@extends('template')

@section('content')

    <div id="chat-cont">
      
    </div>

<script type="text/babel">

    class Messages extends React.Component{

        constructor(props){
            super(props)
            this.state={
                user:{
                    consultant:{
                        profile_id:""
                    }
                },
                message:""
            }
        }

        componentDidMount(){
            axios.get("/api/user/messages")
                .then(data=>{
                    this.setState({
                        user:data.data
                    })
                })
                .catch(e=>{
                    console.log(e)
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
                axios.post("/api/user/messages",{
                    message:this.state.message
                })
                .then(res=>{

                    this.setState({
                        ...this.state,
                        user:{
                            ...this.state.user,
                            messages:[...this.state.user.messages,{
                                id:Math.random()*10,
                                from:"user",
                                message:this.state.message
                            }]
                        }    
                    })
                    console.log(res)
                })
                .catch(e=>{
                    console.log(e)
                })
                e.target.value=""
            }
            
        }

        render(){

           if(this.state.user.messages!=null && this.state.user.messages.length>0){
            var messages=this.state.user.messages.map(message=>{
                return(
                    <div className="message clearfix" key={message.id}>
                        <p className={message.from=="consultant"?"message-left":"message-right"}>{message.message}</p>
                    </div>
                )
            })
           }

            return(
                <div className="chat-cont clearfix">
                    <div className="select-user-cont">
                        <div className="user-cont clearfix">
                            <div className="user-img"><img src={this.state.user.consultant.profile_id} /></div>
                            <div className="user-name">
                                <p>{this.state.user.consultant.first_name}</p>
                            </div>
                        </div>
                        <button>Consult Someone Else</button>
                    </div>
                    <div className="messages-master-cont">
                        <div className="messages-header clearfix shadow">
                            <p>{this.state.user.consultant.first_name}</p>
                            <div className="messages-options">
                                <i className="fas fa-phone-square fa-lg"></i>
                                <i className="fas fa-video fa-lg"></i>
                            </div>
                        </div>
                        <div className="messages-body-cont clearfix">
                            <div className="messages-cont">
                                <div className="message-text-cont">{messages}</div>
                                <div className="message-send-text-cont">
                                    <textarea onKeyPress={this.sendText}  onChange={this.setText} placeholder="message...."></textarea>
                                </div>
                            </div>
                            <div className="user-det-cont">
                                <div className="user-det-img"><img src={this.state.user.consultant.profile_id} /></div>
                                <ul>    
                                    <li><i className="fas fa-user"></i><span>First Name: </span><br />{this.state.user.consultant.first_name}</li>
                                    <li><i className="fas fa-user"></i><span>Last Name: </span><br />{this.state.user.consultant.last_name}</li>
                                    <li><i className="fas fa-at"></i><span>Email: </span><br />{this.state.user.consultant.email}</li>
                                    <li><i className="fas fa-university"></i><span>Education: </span><br />{this.state.user.consultant.education}</li>
                                    <li><i className="fas fa-address-card"></i><span>Address: </span><br />{this.state.user.consultant.work_address}</li>
                                    <li><i className="fas fa-book"></i><span>Bio: </span><br />{this.state.user.consultant.bio}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            )
        }
    }

    ReactDOM.render(<Messages />,document.getElementById("chat-cont"))

</script>

@endsection