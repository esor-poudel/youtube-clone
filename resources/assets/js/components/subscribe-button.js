const { default: Axios } = require("axios");

Vue.component('subscribe-button',{
    props:{
        channel:{
            type:Object,
            required:true,
            default:()=>({})
        },

        InitialSubscriptions:{
            type: Array,
            required:true,
            default:()=>[]
        }
    },
    data: function(){
        return{
            subscriptions: this.InitialSubscriptions
        }
    },
    computed:
    {
        subscribed(){
            if(!__auth()|| this.channel.user_id===__auth().id) return false;
            return !!this.subscription
        },
        owner()
        {
            if( __auth()&&this.channel.user_id===__auth().id) return true
            return false
        },
        subscription(){
            if(!__auth()) return null
            return this.subscriptions.find(subscription=>subscription.user_id===__auth().id)
        },
    },
    methods:{
        togglesubscription()
        {
            if(!__auth())
            {
              return alert("please login to subscribe");
            }
            if(this.owner){
                return alert("you cannot subscribe to your own channel");
            }
            if(this.subscribed){

                Axios.delete(`/channels/${this.channel.id}/subscriptions/${this.subscription.id}`)
                .then(()=>{
                    this.subscriptions= this.subscriptions.filter(s => s.id !== this.subscription.id)
                })

            }else{

                Axios.post(`/channels/${this.channel.id}/subscriptions`)
                .then((res) =>{
                    this.subscriptions=[
                        ...this.subscriptions,
                        res.data
                    ]
                })
                
            }
        }
    }
})