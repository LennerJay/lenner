const {createApp} = Vue;
createApp({
    data(){
        return{
            isLoggedIn:undefined,
            product:[],
            specs:[],          
            fetchProducts:[],
            searchData:[],
            data:[],
            searhInput:'',          
            shoppingCart:[],
            cart:[],
            purchasedProduct:[],
            showShoppingCart:false,
        }
    },
    methods:{
        fnAddToCart:function(product_id){
            console.log(product_id)
            let isExists = this.shoppingCart.some(item => item.id == product_id)
            console.log(isExists)
            if(isExists){
                swal.fire({
                    text:'Item has been added to your shopping cart',
                    icon:'success',
                    timer:1100,
                    showConfirmButton: false
                })
            }else{
                this.cart = []
                const vm = this;
                const data = new FormData;
                data.append('method','fnAddToCart')
                data.append('product_id',product_id)
                axios.post('dbCon/router.php',data).then((respond)=>{
                    if(respond.data === 1){
                        swal.fire({
                            text:'Item has been added to your shopping cart',
                            icon:'success',
                            timer:1100,
                            showConfirmButton: false
                        })
                        vm.getShoppingCart();
                    }else if(respond.data === 2){
                        console.log(respond.data)
                        swal.fire({
                            title:'Welcome to Tactical Mind Shop',
                            html:'Please <a href="login.php">Sign up</a> to continue',
                            icon:'info',
                        })
                    }else{
                        swal.fire(  
                        'Something went Wrong',
                        'We will fix this as soon as possible',
                        'error')
                        console.log(respond.data)
                    }
                })
            }
        },
        fnPurchase:function(brandName,product_id,price,category,img){
            if(!this.isLoggedIn){
                swal.fire({
                    title:'Welcome to Tactical Mind Shop',
                    html:'Please <a href="login.php">Sign up</a> to continue',
                    icon:'info',
                })
            }else{
                const item = this.purchasedProduct.filter(e => e.id == product_id)
                if(item.length > 0){
                    swal.fire({
                        icon:'question',
                        text:"Do you want to Buy this item Again?",
                        confirmButtonText:'Yes',
                        showCancelButton: true,
                    }).then(result =>{
                        if(result.isConfirmed){
                            this.fnSendToRouter(brandName,product_id,price,category,img,'updateQuantity',item[0].quantity);
                        }
                    })
                }else{
                    this.fnSendToRouter(brandName,product_id,price,category,img,'saveProduct');
                }
            }
        },
        fnSendToRouter:function(brandName,product_id,price,category,img,option,num = 0){
            const p = Intl.NumberFormat().format(price)
            swal.fire({
                imageUrl:`images/${category}/${img}`,
                title:brandName,
                imageWidth: 400,
                imageHeight: 200,
                confirmButtonColor:'#FFB916',
                confirmButtonText:'Continue',
                showCancelButton: true,
                html:`<p>Price: ${p}</p><div><label for='quantity'>Quantity</label><input type='number' name='quantity' id='quantity' value="1"></div>`
            }).then(result=>{
                const quantity = document.querySelector('#quantity')
                if(result.isConfirmed){
                    let total = Number(quantity.value) * price
                    total =  Intl.NumberFormat().format(total)
                    swal.fire({
                        title:'Receipt',
                        html:`<p>Quantity: ${quantity.value}<p>
                            <p>Price: ${p}<p>
                            <p>Total: ${total}<p>
                        `,
                        confirmButtonText:'Purchase',
                        showCancelButton: true,
                    }).then(result=>{
                    if(result.isConfirmed){
                            const data = new FormData;
                            if(option == 'updateQuantity'){
                                data.append('quantity',eval(`${quantity.value} + ${num}`))
                                data.append('method',option)
                            }else{
                                data.append('quantity',quantity.value)
                                data.append('method','fnPurchase')
                            }
                            data.append('product_id',product_id)
                            axios.post('dbCon/router.php',data).then(respond=>{
                                console.log(respond.data)
                                if(respond.data == 1){
                                    swal.fire(
                                        'Purchased Success',
                                        'wait for the owner to approve your order',
                                        'success'
                                    ).then(result=>{
                                        window.location.href ="details.php"
                                    })
                                }else{
                                    swal.fire(
                                        'Something went Wrong',
                                        'We will fix this as soon as possible',
                                        'error'
                                    )
                                }
                            })
                        }
                   })
                }
            })
        },
        getShoppingCart:function(){
            const vm = this;
            const data = new FormData;
            data.append('method','getShoppingCart');
            axios.post('dbCon/router.php',data).then(respond =>{
                vm.fetchProducts.forEach(e =>{
                    respond.data.filter(item => item.status == 0).forEach(item =>{
                        if(item.product_id == e.id){
                            this.cart.push(e)
                            vm.shoppingCart.push({
                                id: item.product_id
                            })
                        }
                    })
                })
            })
        },
        getProduct:function(id){
            const vm = this;
            const data = new FormData;
            data.append('productId',id);
            data.append('method','getProduct');
            axios.post('dbCon/router.php',data).then(respond => {
                if(id === 0){
                    respond.data.forEach(e => {
                        vm.fetchProducts.push({
                            id: e.product_id,
                            brand: e.product_brand,
                            name: e.product_name,
                            description: e.product_description,
                            specs: e.product_specification,
                            oldPrice: e.product_oldPrice,
                            newPrice: e.product_newPrice,
                            stock: e.product_stock,
                            sold: e.product_sold,
                            img: e.product_img,
                            category: e.product_category
                        })

                    })

                }else{
                    respond.data.forEach(e=>{   
                        vm.product.push({
                            id: e.product_id,
                            brand: e.product_brand,
                            name: e.product_name,
                            description: e.product_description,
                            oldPrice: e.product_oldPrice,
                            newPrice: e.product_newPrice,
                            stock: e.product_stock,
                            sold: e.product_sold,
                            img: e.product_img,
                            category: e.product_category
                        })
                        vm.specs.push(e.product_specification.split(","))
                    })
                }
            })
        },
        checkStatus:function(){
            const data = new FormData;
            data.append('method','checkStatus')
            axios.post('dbCon/router.php',data).then(respond =>{
                if(respond.data == 1){
                    this.getPurchasedProduct();
                    this.getShoppingCart();
                    this.isLoggedIn = true
                }else{
                    this.isLoggedIn = false
                }
            })
        },
        searchInput:function(e){
            if(this.searchData.length > 0){ 
                this.data = []
            }
            this.searchData = this.fetchProducts.filter(item => item.name.toLowerCase().indexOf(e.target.value.toLowerCase()) >= 0 && e.target.value != "")
            this.searchData.forEach(e => this.data.push({name: e.name.slice(0,13) + '...',id:e.id}))
            if(e.which == 13){
                this.searhInput = ''
            }
            console.log(this.specs)
            console.log(this.specs[0])
        },
        fnViewDetail:function(id){
            localStorage.setItem('id',id)
            window.location.href = "details.php"
        },
        fnHome:function(){
            localStorage.setItem('path','index.php')
            window.location.href="index.php";
        },
        logout:function(){
            const data = new FormData;
            data.append('method','logout')
            axios.post('dbCon/router.php',data).then((respond)=>{
                if(respond.data === 1){
                    localStorage.setItem('isLoggedIn','100')
                    window.location.href="details.php"
                }
            })
        },
        getShoppingCart:function(){
            const vm = this;
            const data = new FormData;
            data.append('method','getShoppingCart');
            axios.post('dbCon/router.php',data).then(respond =>{
                vm.fetchProducts.forEach(e =>{
                    respond.data.filter(item => item.status == 0).forEach(item =>{
                        if(item.product_id == e.id){
                            this.cart.push(e)
                            vm.shoppingCart.push({
                                id: item.product_id
                            })
                        }
                    })
                })
            })
        },        
        cartLength(){
            return this.cart.length
        },
        getPurchasedProduct:function(){
            const vm = this;
            const data = new FormData;
            data.append('method','getPurchasedProduct')
            axios.post('dbCon/router.php',data).then(respond =>{
                respond.data.filter(item => item.status == 0).forEach(product=>{
                    vm.purchasedProduct.push({
                        id: product.product_id,
                        quantity: product.quantity
                    })
                })
            })
        }
    },
    created(){
        this.getProduct(localStorage.getItem('id'))
        this.getProduct(0);
        this.checkStatus();
   
    }
}).mount('#details-app')