<?php 

	session_start();
	include "include/header.php";
	$app = "<script src='js/details.js'></script>";
?>
<div id="details-app">
<div class="container">
	<header class="main-header">
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
	</header>
</div><!-- End of class container -->

<div class="navigations">
	<div class="links">
		<i class="home fa-solid fa-shop"></i>
		<a href="index.php">Home</a>
		<i class="computer fa-solid fa-computer"></i>
		<a href="computer.php">Computer</a>
		<i class="mobile fa-solid fa-mobile"></i>
		<a href="mobile.php">Mobile</a>
		<i class="television fa-solid fa-tv"></i>
		<a href="television.php">Television</a>
		<i class="hardware fa-solid fa-memory"></i>
		<a href="hardware.php">Hardware</a>
		<i class="software fa-brands fa-uncharted"></i>
		<a href="software.php">Software</a>
		<i class="electronics fa-sharp fa-solid fa-microchip"></i>
		<a href="electronics.php">Electronics</a>
	</div>
</div><!-- End of class navigations -->

<!-- Main Section -->
<section class="main-section">
	<div class="content" v-for="item in product">
		<div class="image">
			<img id="prod-img" :src="'images/'+ item.category +'/' + item.img" alt="Ethernet Cable" width="330" height="200">
		</div>
		<div class="image-description">
			<h3>{{item.name}}</h3>
			<p>{{item.description}}</p>
			<div class="ratings">
				<i class="fa-solid fa-star"></i>
				<i class="fa-solid fa-star"></i>
				<i class="fa-solid fa-star"></i>
				<i class="fa-solid fa-star-half"></i>
				<i class="fa-regular fa-star"></i>
			</div>
			<h4>Brand | {{item.brand}}</h4>
			<h4><span class="discount">&#8369;{{item.oldPrice}}</span> &nbsp; <span class="price">&#8369;{{item.newPrice}}</span></h4>
			<div class="color-selections">
				<button id="click-black" type="button" >Black</button>
				<button id="click-yellow" type="button" >Yellow</button>
				<button id="click-blue" type="button" >Blue</button>
			</div>
			<button class="purchase" @click="fnPurchase(item.brand,item.id,item.newPrice,item.category,item.img)">Purchase</button>
			<button class="cart" @click="fnAddToCart(item.id)">Add to Cart</button>
		</div>
		<div class="options">
			<h4>Delivery Option</h4>
			<div class="opt">
				<i class="map fa-solid fa-location-dot"></i>
				<small>Philippines</small>
			</div>
			<div class="opt">
				<i class="cash fa-solid fa-sack-dollar"></i>
				<small>Standard Delivery</small>
			</div>
			<div class="opt">
				<i class="deliver fa-sharp fa-solid fa-truck"></i>
				<small>Cash on Delivery available for orders below (price)</small>
			</div>

			<h4>Return and Warranty</h4>
			<div class="opt">
				<i class="back fa-solid fa-arrow-rotate-right"></i>
				<small>7 Days Money Back Guarantee</small>
			</div>
			<div class="opt">
				<i class="deliver fa-sharp fa-solid fa-truck"></i>
				<small>Warranty not available</small>
			</div>
		</div>
	</div><!-- End of class content -->
</section>
<!-- End class main-section -->

<!-- User Communication to Owner -->
<section class="communicate">
	<div class="communicate-content">
		<div class="logo">
			<img src="" alt="E-Commerce Tactical Minds Logo" width="110" height="110">
		</div>
		<div class="contact">
			<p>Administrator</p>
			<?php if(isset($_SESSION['users'])) { ?>
				<i class="fa-solid fa-circle" style="color: #53E900;"></i>
				<small>Online</small>
			<?php } else { ?>
				<i class="fa-solid fa-circle" style="color: #FF3838;"></i>
				<small>Offline</small>
			<?php } ?>
			<div class="buttons">
				<button onclick="message()">Message</button>
				<button onclick="viewShop()">View Shop</button>
			</div>
		</div>
	</div>
</section>
<!-- End of class Communication -->

<!-- Product Details -->
<section class="product-details">
	<div class="details-content">
		<h2>Product Specifications</h2>
		<div class="row-1">
			<div class="col-1">
				<ul >
					<li v-for="spec in specs[0]"><span>{{spec}}</span></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- End of class Product Details -->

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
<!-- End of main-footer -->
<?php 

include "include/footer.php";

?>