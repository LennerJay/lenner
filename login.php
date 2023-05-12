<?php include "include/header.php";
    $app = '<script src="js/login.js"></script>'
?>


<div id="app">
    <form @submit.prevent="fnLogIn($event)">
        <label for="username"></label>
        <input type="text" name="username">
        <label for="password"></label>
        <input type="password" name="password">
        <button type="submit">Submit</button>
    </form>
    <!-- <div v-for="user in userDetails">
        <p>{{user.userId}}</p>
        <p>{{user.username}}</p>
        <p>{{user.password}}</p>
        <p>{{user.email}}</p>
    </div> -->
</div>

<a href="register.php">Register</a>



<?php include "include/footer.php";?>