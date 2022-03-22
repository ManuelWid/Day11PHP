<?php
require_once 'db_connect.php';
require_once 'file_upload.php';

if ($_POST && !(empty($_POST["name"]))) { 
    // the empty() function is used to make sure there is a name, if only ($_POST) and empty name it would throw an error
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $uploadError = '';
    $picture = file_upload($_FILES['picture']);  
   
    $sql = "INSERT INTO dishes (image, name, price, description) VALUES ('$picture->fileName', '$name', $price, '$desc')";

    if (mysqli_query($connect, $sql)) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $price </td>
            <td> $desc </td>
            </tr></table><hr>
            <br/> You will be redirected in 3 seconds.";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error. "<br/> You will be redirected in 3 seconds.";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    mysqli_close($connect);
    header("refresh: 3; url = ../index.php");
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
                <h1>Create request response</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>