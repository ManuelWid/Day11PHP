<?php
require_once 'db_connect.php';
require_once 'file_upload.php';

if ($_POST) {    
    $name = $_POST['name'];
    $price = $_POST['price'];
    $id = $_POST['id'];
    $desc = $_POST['desc'];
    $uploadError = '';

    $picture = file_upload($_FILES['picture']); 
    if($picture->error===0){
        ($_POST["picture"]=="product.png")?: unlink("../pictures/$_POST[picture]");           
        $sql = "UPDATE dishes SET name = '$name', price = $price, description='$desc', image = '$picture->fileName' WHERE dish_id = $id";
    }else{
        $sql = "UPDATE dishes SET name = '$name', price = $price, description='$desc' WHERE dish_id = $id";
    }    
    if (mysqli_query($connect, $sql)) {
        $class = "success";
        $message = "The record was successfully updated <br/> You will be redirected in 5 seconds.";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error() . "<br/> You will be redirected in 5 seconds.";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    mysqli_close($connect);
    header("refresh:5 ; url=../index.php");
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update</title>
        <?php require_once '../components/boot.php'?> 
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Update request response</h1>
            </div>
            <div class="alert alert-<?= $class;?>" role="alert">
                <p><?= ($message) ?? ''; ?></p>
                <p><?= ($uploadError) ?? ''; ?></p>
                <a href='../update.php?dish_id=<?= $id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>