<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Font-awesome/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div id="app">
        <h1>TEST Length</h1>
        <input type="text" v-model="message">
        <p>{{mesage}}</p>
        <button @click="fnTest">click</button>
        <i :class="'fa-solid fa-' + itemsLength"></i>
    </div>
    <script src="js/vue.js"></script>
    <script>
        const {createApp} = Vue;
        createApp({
            data(){
                return{
                    items: [ { text: "Learn JavaScript", done: false },
                            { text: "Learn Vue", done: false },
                            { text: "Build something awesome", done: true }],
                    message:''
                }
            },
            methods:{
                fnTest:function(){
                    this.items.push({
                        text:'test1',
                        done:false
                    })
                    console.log(this.items)
                }

            },
            computed: {
                itemsLength() {
                return this.items.length
                }
            },
            // watch: {
            //     itemsLength (val, oldVal) {
            //     console.log('length changed')
            //     }
            // }
        }).mount('#app')
    </script>
</body>
</html>