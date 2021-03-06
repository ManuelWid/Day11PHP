<?php
session_start();
require_once 'actions/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - <?php echo $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <style>
        .userImage {
            width: 200px;
            height: 200px;
        }

        .hero {
            background: rgb(2, 0, 36);
            background: linear-gradient(24deg, rgba(2, 0, 36, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }
        .d-flex>p{
            font-size: 2em;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="hero">
            <div class="d-flex">
            <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
            <p class="ms-4 mt-1 text-light">== Hier könnte Ihre Werbung stehen. ==</p>
            </div>
        </div>
        <div class="container mt-3">
        <a href= "index.php"><button class="btn btn-primary" type="button" >Home</button></a>
        <a href= "userupdate.php?id=<?php echo $_SESSION['user'] ?>"><button class="btn btn-warning" type="button" >Edit profile</button></a>
        <a href= "logout.php?logout"><button class="btn btn-danger" type="button" >Logout</button></a>
        </div>
    </div>
</body>
</html>