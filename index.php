<?php include "include/header.php";
    $app = '<script src="js/main.js"></script>'

?>
<div id="app">
    <header>
        <div class="main-container">
            <div class="left">
                <h1><a @click="fnHome()">TacticalMinds</a></h1>
                <div  class="searchBar">
                    <input type="search" v-model="searhInput" name="search" placeholder="search..."  @keyup="searchInput($event)">
                    <ul v-if="searhInput.length > 0">
                        <li v-for="item in data"><a @click.prevent="fnViewDetail(item.id)">{{item.name}}</a></li>
                    </ul>
                </div>
            </div>
            <div v-if="isLoggedIn" class="right">
                    <div class="cart" @click="showShoppingCart()" @mouseover="showShoppingCart = true" @mouseleave="showShoppingCart = false">
                        <i class="fa-sharp fa-solid fa-cart-shopping"> 
                        <span v-if="cartLength() > 0">{{cartLength()}}</span></i>
                        <div v-if="showShoppingCart" >
                            <p v-for="item in cart" @click="shoppingCart(item.id)" >{{item.name.slice(0,13) + '...'}}</p>
                            <p>Buy All</p>
                        </div>
                    </div>
                    <i class="fa-solid fa-user"></i>
                <!-- <img src="icons/profile-icon.png" alt="profile-icon"> -->
                <button @click.prevent="logout()">logout</button>
            </div>
            <div v-else class="right">
                <div class="signin">
                    <i class="fa-sharp fa-solid fa-right-to-bracket"></i>
                    <a href="login.php">Sign in</a>
				</div>
                <div class="signup">
                    <i class="fa-solid fa-user-plus"></i>
                    <a href="register.php">Sign up</a>
                </div>

            </div>
        </div>
    </header>
    <nav>
        <div class="nav-container">
            <i v-for="nav in navigations"
             :class="[nav.name, nav.icon]"
             @click="displayItem(nav.name)"
            >
                <p>{{nav.name}}</p>
            </i>
        </div>
    </nav>
    <main ref="main">
        <img src="images/gpu.png" alt="Graphics Processing Unit">
        <div class="showcase-content">
            <h2>Best Price</h2>
            <h3>Incredible Prices <br> on All Your <br> Favorite Items</h3>
            <p>Get more for less on related brands</p>
            <a href="#">Shop Now</a>
        </div>
        <div class="best-seller-section">
            <div class="product-container" v-for="product in bestSellerProducts"> 
                <div class="best-seller-product">
                    <div class="best-seller-tag">
                        <h3>Best Seller</h3>
                    </div>
                    <img :src="'images/'+ product.category +'/' + product.img" :alt="product.category">
                    <p class="product-name">{{product.name}}</p>
                    <h4><span class="discount">&#8369;{{Intl.NumberFormat().format(product.oldPrice)}}</span> &nbsp; <span class="price">&#8369;{{Intl.NumberFormat().format(product.newPrice)}}</span></h4>
                </div>
                <div class="ratings">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="button-container">
                    <button id="purchase-btn" @click="fnPurchase(product.name,product.id,product.newPrice, product.category,product.img)">Purchase</button>
                    <button id="add-to-cart-btn" @click="fnAddToCart(product.id)">Add to cart</button>
                </div>
            </div>
        </div>
    </main>
    <hr ref="hr">
    <section class="product" ref="product">
        <div class="products-container"> <!-- <-mag sugod ko og loop ani na line-->
            <div class="product-content" v-for="product in getCurrentItems()">
                <div class="product-img">
                    <img :src="'images/' + product.category + '/' + product.img">
                </div>
                <div class="product-description">
                    <h4>{{product.name}}</h4>
                    <p>{{product.description}}</p>
                    <div class="ratings">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <h4>{{product.brand}}</h4>
                    <a @click="fnViewDetail(product.id)">View Details</a>
                </div>
            </div>
            <!------>
            
        </div>
    </section>
    <section class="buttons">
        <div class="buttons-container">
        <button  v-if="currentPage > 1" @click="currentPage--" class="arrow-left" type="button"><i class="fa-solid fa-angle-left"></i></button>
        <div class="button-numbers">
			<button v-for="pageNumber in totalPages" :key="pageNumber"
                :class="{ active: pageNumber === currentPage }"
                @click="currentPage = pageNumber" type="button"><i :class="'fa-solid fa-' + pageNumber"></i></button>
        </div>
        <button v-if="currentPage < totalPages" @click="currentPage++" class="arrow-right" value="button"><i class="fa-solid fa-angle-right"></i></button>
        </div>
    </section>
		<!-- Main Footer -->
    <footer class="main-footer">
        <div class="header">
            <h2>Stay Connected!</h2>
        </div>
        <div class="content">
            <div class="row-1">
                <h3>INFORMATION</h3>
                <a href="#">About the Product</a>
                <a href="#">Sales about the product</a>
                <a href="#">Site map</a>
                <a href="#">Digital Solutions</a>
                <a href="#">Newsroom</a>
            </div>
            <div class="row-1">
                <h3>HELP</h3>
                <a href="#">Help and Support</a>
                <a href="#">Order Status</a>
                <a href="#">Shipping Rates/Options</a>
                <a href="#">Returns and Order Issues</a>
            </div>
            <div class="row-1 contact-links">
                <h3>CONTACT US</h3>
                <div class="call">
                    <i class="fa-sharp fa-solid fa-phone"></i>
                    <a href="#">09211022001</a>
                </div>
                <div class="email">
                    <i class="fa-sharp fa-solid fa-envelope"></i>
                    <a href="#">TacticalMinds.Support@gmail.com</a>
                </div>
                <div class="group">
                    <i class="fa-solid fa-user-group"></i>
                    <a href="#">Co-Browse</a>
                </div>
            </div>
            <div class="row-1 social-media">
                <h3>FOLLOW US</h3>
                <i class="facebook fa-brands fa-facebook"></i>
                <i class="twitter fa-brands fa-twitter"></i>
                <i class="youtube fa-brands fa-youtube"></i>
                <i class="instagram fa-brands fa-square-instagram"></i>
                <i class="linked-in fa-brands fa-linkedin"></i>
                <div class="stores">
                    <img src="Images/appstore.png" alt="Apple Store" width="100" height="30">
                    <img src="Images/playstore.png" alt="Google Play Store" width="100" height="30">
                </div>
            </div>
        </div>
        <div class="copyrights">
            <div class="logo">
                <img src="Images/phFlag.jpg" alt="Philippine Flag" width="20" height="10">
                <h5><a href="#">Philippines &nbsp;&nbsp;</a></h5>
            </div>
            <div class="col-1">
                <small>| &nbsp; Copyright &copy; 2022-2023, Tactical-Minds Group &nbsp; | &nbsp; </small>
                <small>All Rights Reserved. &nbsp; | </small>
            </div>
            <div class="col-2">
                <a href="#">&nbsp;&nbsp; Terms and Conditions &nbsp; | </a>
                <a href="#">&nbsp; Privacy Notice</a>
            </div>
        </div>
    </footer>
 </div>
<?php include "include/footer.php";?>





