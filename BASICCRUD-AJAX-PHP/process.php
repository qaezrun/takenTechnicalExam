<?php
$servername = "localhost";
$username  ='root';
$dbname = "techexam";
$con = new mysqli($servername,$username, '', $dbname);
    
if(!$con){
    die(mysqli_error($con));
    echo "not connected";
}

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'GET':
        $sql = "SELECT * from product";
        $result = mysqli_query($con, $sql);
        $dataArray = array();
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $dataObject = (object) array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "unit" => $row['unit'],
                    "price" => $row['price'],
                    "DateExp" => $row['dateExp'],
                    "AvailableIn" => $row['availInvent'],
                    "imageLink" => $row['image'],
                    
                );
                $dataArray[] = $dataObject;
            }
        }
        echo json_encode($dataArray);
        break;
    case 'POST':
        $name = $_POST["name"];
        $unit = $_POST["unit"];
        $price = $_POST["price"];
        $expD = $_POST["expD"];
        $avInv = $_POST["avInv"];
        $link = $_POST["link"];

        $sql = "INSERT INTO product (name, unit, price, dateExp, availInvent, image) 
        VALUES ('$name', '$unit', '$price', '$expD', '$avInv', '$link')";
        $result = mysqli_query($con, $sql);
        
        if($result){
            echo true;
        }else{
            echo false;
        }
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $putData);
        $id = $putData["id"];
        $updatedName = $putData["name"];
        $updatedUnit = $putData["unit"];
        $updatedPrice = $putData["price"];
        $updatedExpD = $putData["expD"];
        $updatedAvInv = $putData["avInv"];
        $updatedLink = $putData["link"];

        // Perform the update in your database
        $sql = "UPDATE product SET 
                    name = '$updatedName',
                    unit = '$updatedUnit',
                    price = '$updatedPrice',
                    dateExp = '$updatedExpD',
                    availInvent = '$updatedAvInv',
                    image = '$updatedLink'
                WHERE id = '$id'";
        
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo 'Success update';
        } else {
            echo 'fatal error';
        }
        break;
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $deleteData); // Parse DELETE data
    
        $idToDelete = $deleteData["id"];

        $sql = "DELETE FROM product WHERE id = '$idToDelete'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "Data removed!";
        } else {
            echo "fatal error";
        }
        break;
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(array("message" => "Error try again later."));
}

?>