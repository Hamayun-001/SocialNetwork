<?php
session_start();
$conn =  mysqli_connect("localhost", "root", "", "freezone");
if (mysqli_connect_errno()) {
    echo "Cannot connect to the Database due to the following error :" . mysqli_connect_errno();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeZone</title>

    <!-- Styling -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->

</head>

<body>
    <!-- If not logged_in  -->
    <?php if (!isset($_SESSION['token'])) {  ?>
    <a href="Frontend/login.php"><i class="fa fa-sign-in"></i> Login</a>

    <!-- If logged_in  -->
    <?php } else { ?>
    <h1>Welcome
        <?php echo "<span style='font-weight:bold;color:lightgreen'>" . $_SESSION['token'] . "!</span>";
            ?>
    </h1>

    <a href="backend/logout.php"><i class="fa fa-fa-sign-out"></i> Logout</a>
    <?php
    } ?>

</body>

</html>