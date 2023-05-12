const {createApp} = Vue;

createApp({
    data(){
        return{
            products:[]
        }
    },
    methods:{
        fnAddProduct:function(e){
            const vm = this;
            const data = new FormData(e.currentTarget)
            data.append('method','fnAddProduct')
            axios.post('dbCon/router.php',data).then((respond)=>{
                console.log(respond.data)
                if(respond.data === 1){
                    alert('Added Successfully')
                    window.location.href="addProduct.php";
                }else{
                    // alert(respond.data)
                    console.log(respond.data)
                }
                
            })
        },
        addproduct:()=>{
            console.log('test')
        }
    }

}).mount('#product-container')