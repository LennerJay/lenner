<?php 

    include "../dbCon/config.php";
    global $con;
  
    $method = $_POST['method'];
    if(function_exists($method))
    {
        call_user_func($method);
    }
    else
    {
        echo "Function not exist";
    }

function fnSaveUser(){
    global $con;
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $con->prepare('CALL sp_saveUser(?,?,?)');
    $query->bind_param('sss',$username,$password,$email);
    if($query->execute()){
        echo 1;
    }
    else{
        echo json_encode(mysqli_error($con));
    }
}

function fnLogIn(){
    global $con;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $con->prepare('CALL sp_checkUser(?,?)');
    $query->bind_param('ss',$username,$password);
    $query->execute();
    $result= $query->get_result();
    $data = array();
    while($row = $result->fetch_array()){
        $data[] = $row;
    }
    echo json_encode($data);
}


