<?php
    include "include/header.php";
    $app = '<script src="js/addProduct.js"></script>';

?>

<h1>Add product</h1>
<div id="product-container">
    <form @submit.prevent="fnAddProduct($event)">
        <input type="text" name="product_brand" placeholder="Product Brand"><br>
        <input type="text" name="product_name" placeholder="Product Name"><br>
        <textarea name="product_description" placeholder="Product Description" rows="4" cols="50"></textarea><br>
        <textarea name="product_specification" placeholder="Product Specification" rows="4" cols="50"></textarea><br>
        <input type="text" name="product_oldPrice" placeholder="Product Old Price"><br>
        <input type="text" name="product_newPrice" placeholder="Product New Price"><br>
        <input type="text" name="product_stock" placeholder="Product Stock"><br>
        <input type="text" name="product_category" placeholder="Product Category"><br>
        <input type="file" name="product_img" placeholder="Product Brand"><br>
        <button type="submit">Submit</button>
       

    </form>
</div>











<?php
    include "include/footer.php";

?>