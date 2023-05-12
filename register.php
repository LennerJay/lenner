<?php include "include/header.php";
    $app = '<script src="js/register.js"></script>';
?>

<div id="register">
    <form @submit.prevent="fnSaveUser($event)">
        <label for="email"></label>
        <input v-model="email" type="email" name="email" placeholder="email"><br>
        <label for="username"></label>
        <input v-model="username" type="text" name="username"  placeholder="username"><br>
        <label for="password"></label>
        <input v-model="password" type="password" name="password"  placeholder="password"><br>
        <!-- <input type="submit" value="Submit"> -->
        <button type="submit">Submit</button>
    </form>
</div>



<?php include "include/footer.php";?>