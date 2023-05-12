<?php 
    include "backend.php";
    session_start();
    $method = $_POST['method'];
    if(function_exists($method)){
        call_user_func($method);
    }else{
        echo "Function not exist";
    }
    function checkStatus(){
        if(isset($_SESSION['username'])){
            echo 1;
        }else{
            echo 2;
        }
    }
    function updateQuantity(){
        if(isset($_SESSION['username'])){
            $backend = new Backend();
            echo $backend->updateQuantity($_SESSION['user_id'],$_POST['product_id'],$_POST['quantity']);
        }else{
            echo 2;
        }
    }
    function getPurchasedProduct(){
        if(isset($_SESSION['username'])){
            $backend = new Backend();
            echo $backend->fnGetPurchasedProduct($_SESSION['user_id']);
        }else{
            echo 2;
        }
    }
    function fnPurchase(){
        if(isset($_SESSION['username'])){
            $backend = new Backend();
            echo $backend->fnPurchase($_SESSION['user_id'],$_POST['product_id'],$_POST['quantity'],0);
        }else{
            echo 2;
        }
    }
    function getShoppingCart(){
        if(isset($_SESSION['username'])){
            $backend = new Backend;
            echo $backend->getShoppingCart($_SESSION['user_id']);
        }

    }
    function fnAddToCart(){
        if(isset($_SESSION['username'])){
            $backend = new Backend();
            echo $backend->addToCart($_SESSION['user_id'],$_POST['product_id'],0);
        }else{
            echo 2;
        }

    }
    function fnLogIn(){
        $backend = new Backend();
        echo $backend->login($_POST['username'],$_POST['password']);
    }

    function register(){
        $backend = new Backend();
        echo $backend->register($_POST['username'],$_POST['password'],$_POST['email']);

    }   
    function fnAddProduct(){
        $folder = '../images/' . $_POST['product_category'] . '/';
        $filename = $_FILES['product_img']['name'];
        $destination = $folder . $filename;
        $backend = new Backend();
        $result = $backend->addProduct($_POST['product_brand'],$_POST['product_name'],$_POST['product_description'],$_POST['product_specification'],$_POST['product_oldPrice'],$_POST['product_newPrice'],$_POST['product_stock'],
        0,
        $filename,
        $_POST['product_category']);
        if($result === 1){
            move_uploaded_file($_FILES['product_img']['tmp_name'],$destination);
            echo $result;
        }else{
            echo $result;
        }
    }
    function getProduct(){
        $backend = new Backend();
        echo $backend->getProduct($_POST['productId']);
    }
    function logout(){
        session_unset();
        session_destroy();
        echo 1;
    }

?>