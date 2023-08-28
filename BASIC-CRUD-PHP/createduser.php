<?php 
    include 'connect.php';
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
            width:70%;
            height: 50%;
        }
        .table-holder{
            width:100%;
            height: 80%;
        }
    </style>
    <div class="main-con">
        <div class="con">
            <div class="table-holder">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">user_id</th>
                        <th scope="col">username</th>
                        <th scope="col">firstname</th>
                        <th scope="col">lastname</th>
                        <th scope="col">email</th>
                        <th scope="col">accesslevel</th>
                        <th scope="col">password</th>
                        <th scope="col">active</th>
                        <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "Select * from users";
                            $result = mysqli_query($con,$query);
                            if($result){
                                while($row = mysqli_fetch_assoc($result)){
                                    $user_id = $row['user_id'];
                                    $username = $row['username'];
                                    $firstname = $row['firstname'];
                                    $lastname = $row['lastname'];
                                    $password = $row['password'];
                                    $email = $row['email'];
                                    $access_level = $row['access_level'];
                                    $active = $row['active'];
                                
                                    echo '<tr>
                                    <th scope="row">'.$user_id.'</th>
                                    <td>'.$username.'</td>
                                    <td>'.$firstname.'</td>
                                    <td>'.$lastname.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$password.'</td>
                                    <td>'.$access_level.'</td>
                                    <td>'.$active.'</td>
                                    <td>
                                        <a href="update.php?updateid='.$user_id.'" class="text-decoration-none py-3"> Update </a>
                                        <a href="delete.php?deleteid='.$user_id.'" class="text-decoration-none py-3"> Delete </a>
                                    </td>
                                    </tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <form action="user.php" method="GET">
            <div class="row justify-content-end">
                <div class="col-auto">
                <button class="btn btn-dark">Create New</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>
</html>