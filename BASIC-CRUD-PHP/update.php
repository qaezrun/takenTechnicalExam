<?php 
    include 'connect.php';
    $user_id = $_GET['updateid'];
    if(isset($_POST['submit'])){
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $username = $_POST['uname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $radio = $_POST['radio'];
        $active = 1;
    
        // Basic validation
        if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($radio)){
            echo "<script>alert('Please fill in all required fields.'); history.back();</script>";
        } else {
            $sql = $query = "UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname', email='$email', password='$password', access_level='$radio', active='$active' WHERE user_id = '$user_id'";
            $result = mysqli_query($con, $sql);
    
            if($result){
                header("Location: createduser.php");
            } else {
                $error_message = "An error occurred: " . mysqli_error($con);
                echo "<script>alert('$error_message');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <style>
        html,body{
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
        }
        .main-con{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
        .con{
            width:30%;
        }
        .forms div{
            margin: 5px 0px 5px 0px;
        }
    </style>
    <div class="main-con">
        <div class="con">
            <form class="forms" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">First Name:</label>
                    <input type="text" class="form-control" placeholder="Enter first name" name="fname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Last Name:</label>
                    <input type="text" class="form-control" placeholder="Enter last name" name="lname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username:</label>
                    <input type="text" class="form-control" placeholder="Enter username" name="uname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email Address:</label>
                    <input type="email" class="form-control"placeholder="Enter email" name="email">
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="admin" name="radio">
                    <label class="form-check-label" for="inlineCheckbox1">admin</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="user" name="radio" >
                    <label class="form-check-label" for="inlineCheckbox2">user</label>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Password:</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-auto">
                    <button class="btn btn-primary" name="submit">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</body>
</html>