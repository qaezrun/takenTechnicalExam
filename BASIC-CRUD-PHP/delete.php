<?php
    include 'connect.php';
    if(isset($_GET['deleteid'])){
        $user_id = $_GET['deleteid'];

        $sql = "delete from users where user_id=$user_id";
        $result = mysqli_query($con,$sql);
        if($result){
            header('location:createduser.php');
        }else{
            die(mysqli_error($con));
        }
    }
?>