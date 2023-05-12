const {createApp} = Vue;

createApp({
    data(){
        return{
            email:'',
            username:'',
            password:''
        }
    },
    methods:{
        fnSaveUser:function(e){

            var form = e.currentTarget
            const data = new FormData(form)
            console.log(data)
            data.append('method','register')
            axios.post('dbCon/router.php',data)
            .then(function(respond){
                console.log(respond)
                if(respond.data == 1){

                    alert('Registered Succesfully')
                    window.location.href="login.php"
                    
                }else{
                    alert(respond.data)
                }
            })
        }
    }
}).mount('#register')