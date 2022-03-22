<?php
session_start();
if(!isset($_SESSION["adm"])){
    header("Location: index.php");
    exit;
}

require_once 'actions/db_connect.php';

if ($_GET['dish_id']) {
    $id = $_GET['dish_id'];
    $sql = "select * from dishes where dish_id = $id";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $name = $data['name'];
        $picture = $data['image'];
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
        <title>Delete Product</title>
        <?php require_once 'components/boot.php'?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 70% ;
            }     
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }    
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='pictures/<?= $picture ?>' alt="<?= $name ?>"></legend>
            <h5>You have selected the data below:</h5>
            <table class="table w-75 mt-3">
                <tr>
                    <td><?= $name?></td>
                </tr>
            </table>

            <h3 class="mb-4">Do you really want to delete this meal?</h3>
            <form action ="actions/a_delete.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>" />
                <input type="hidden" name="picture" value="<?= $picture ?>" />
                <button class="btn btn-danger" type="submit">Yes, delete it!</button>
                <a href="index.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
            </form>
        </fieldset>
    </body>
</html>