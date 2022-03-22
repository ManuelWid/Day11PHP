<?php 
require_once 'actions/db_connect.php';

if ($_GET['dish_id']) {
    $id = $_GET['dish_id'];
    $sql = "select * from dishes where dish_id = $id";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $name = $data['name'];
        $price = $data['price'];
        $picture = $data['image'];
        $desc = $data['description'];
        $tcontent = "<tr>
            <td><img class='img-thumbnail' src='pictures/" .$picture."'</td>
            <td>" .$name."</td>
            <td>" .$price."€"."</td>
            <td>" .$desc."</td>
            </tr>";
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Restaurant</title>
        <?php require_once 'components/boot.php'?>
        <style type="text/css">
            .manageProduct {           
                margin: auto;
            }
            .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
            }
            td {          
                text-align: center;
                vertical-align: middle;
            }
            tr {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="manageProduct w-75 mt-3">    
            <div class='mb-3'>
                <a href= "index.php"><button class='btn btn-primary'type="button" >Home</button></a>
            </div>
            <p class='h2'>Meals</p>
            <table class='table table-striped'>
                <thead class='table-success'>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $tcontent;?>
                </tbody>
            </table>
            <img src="pictures/<?= $picture ?>" class="rounded-circle mx-auto d-block" alt="Not found" width="450px">
        </div>
    </body>
</html>