<?php
session_start();
$conn =  mysqli_connect("localhost", "root", "", "freezone");
if (mysqli_connect_errno()) {
    echo "Cannot connect to the Database due to the following error :" . mysqli_connect_errno();
}

$firstname = "";
$lastname = "";
$username = "";
$email = "";
$password = "";
$confirmPassword = "";
$date = "";
$error_array = array();
$token = bin2hex(random_bytes(64));

if (isset($_POST['submit'])) {

    //firstname
    $firstname = strip_tags($_POST['firstname']); //Remove HTML-tags
    $firstname = str_replace(' ', '', $firstname); //Remove white-spaces
    $firstname = ucfirst(strtolower($firstname)); //Convert to lowercase
    $_SESSION['firstname'] = $firstname;
    //lastname
    $lastname = strip_tags($_POST['lastname']); //Remove HTML-tags
    $lastname = str_replace(' ', '', $lastname); //Remove white-spaces
    $lastname = ucfirst(strtolower($lastname)); //Convert to lowercase
    $_SESSION['lastname'] = $lastname;

    //username
    $username = strip_tags($_POST['username']); //Remove HTML-tags
    $username = str_replace(' ', '', $username); //Remove white-spaces
    $username = ucfirst(strtolower($username)); //Convert to lowercase
    $_SESSION['username'] = $username;

    //email
    $email = strip_tags($_POST['email']); //Remove HTML-tags
    $email = str_replace(' ', '', $email); //Remove white-spaces
    $email = ucfirst(strtolower($email)); //Convert to lowercase
    $_SESSION['email'] = $email;

    //password
    $password = strip_tags($_POST['password']); //Remove HTML-tags

    $confirmPassword = strip_tags($_POST['confirmPassword']); //Remove HTML-tags

    //date
    $date = date("y-m-d"); //get current date

    // creating session token
    $_SESSION['token'] = $token;

    //Fullname validation
    if (strlen($firstname) > 25 || strlen($firstname) < 3) {
        array_push($error_array, "First name must be between 5 to 25 characters!!!<br>");
    }
    if (strlen($lastname) > 25 || strlen($lastname) < 3) {
        array_push($error_array, "Last name must be between 5 to 25 characters!!!<br>");
    }
    //Email validation
    $email_check = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    $num_rows = mysqli_num_rows($email_check); //Count for email check query return
    if ($num_rows > 0) {
        array_push($error_array, "Email Already Exist!!!<br>");
    }
    //Password Validation
    if ($password != $confirmPassword) {
        array_push($error_array, "Password do not match!!!<br>");
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {

            array_push($error_array, "Your password can only contain english alphabets and numbers!!!<br>");
        }
    }
    if (strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "Password must be between 5 to 30 characters!!!<br>");
    }

    if (empty($error_array)) {
        $password = md5($password);

        //profile pic Assignment
        $rand = rand(1, 2);
        if ($rand == 1) {
            $profile_pic = "../assets/img/profile_pic/p1.jpg";
        } else if ($rand == 2) {
            $profile_pic = "../assets/img/profile_pic/p2.jpg";
        }
        $_SESSION['profile_pic'] = $profile_pic;

        //Inserting data into database
        $run = mysqli_query($conn, "INSERT INTO users VALUES('','$firstname','$lastname','$username','$email','$password','$date','$profile_pic','0','0','no','0')");

        if ($run) {

            // clear fields
            unset($_SESSION['firstname']);
            unset($_SESSION['lastname']);
            unset($_SESSION['username']);
            // unset($_SESSION['email']);

            //Getting token in console
            echo "<script>console.log('token:" . $_SESSION['token'] . "')</script>";

            echo "<script>console.log('email:" . $_SESSION['email'] . "')</script>";

            //redirecting to Home-page
            // header('location:../index.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeZone | register</title>

    <!-- Styling -->
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
</head>

<body>
    <main>

        <section class="section-log" id="section-log">
            <div class="row">
                <div class="log">
                    <div class="log__form">
                        <div class="u-mb-medium">
                            <h2 class="heading-secondary">
                                sign up!
                            </h2>
                        </div>
                        <form action="register.php" method="POST" class="form">
                            <div class="form__group">
                                <?php if (in_array("First name must be between 5 to 25 characters!!!<br>", $error_array)) {
                                    echo '<span class="form__feild-error">First name must be between 5 to 25 characters!!!</span><br>';
                                } ?>
                                <input type="text" class="form__input" name="firstname" id="fullname"
                                    placeholder="First Name" required autofocus
                                    value="<?php if (isset($_SESSION['firstname'])) {
                                                                                                                                                                echo $_SESSION['firstname'];
                                                                                                                                                            } ?>" />
                                <label class="form__label" for="firstname">First Name</label>

                            </div>
                            <div class="form__group">
                                <?php if (in_array("Last name must be between 5 to 25 characters!!!<br>", $error_array)) {
                                    echo '<span class="form__feild-error">Last name must be between 5 to 25 characters!!!</span><br>';
                                } ?>
                                <input type="text" class="form__input" name="lastname" id="lastname"
                                    placeholder="Last Name" required autofocus
                                    value="<?php if (isset($_SESSION['lastname'])) {
                                                                                                                                                            echo $_SESSION['lastname'];
                                                                                                                                                        } ?>" />
                                <label class="form__label" for="lastname">Last Name</label>
                            </div>
                            <div class="form__group">
                                <input type="text" class="form__input" name="username" id="username"
                                    placeholder="Username" required
                                    value="<?php if (isset($_SESSION['username'])) {
                                                                                                                                                echo $_SESSION['username'];
                                                                                                                                            } ?>" />
                                <label class="form__label" for="username">Username</label>
                            </div>
                            <div class="form__group">
                                <?php if (in_array("Email Already Exist!!!<br>", $error_array)) {
                                    echo '<span class="form__feild-error">Email Already Exist!!!</span><br>';
                                } else if (in_array("Invalid email format!!!<br>", $error_array)) {
                                    echo '<span class="form__feild-error">Invalid email format!!!</span><br>';
                                }  ?>
                                <input type="email" class="form__input" name="email" id="email"
                                    placeholder="Email address" required
                                    value="<?php if (isset($_SESSION['email'])) {
                                                                                                                                                echo $_SESSION['email'];
                                                                                                                                            } ?>" />
                                <label class="form__label" for="email">Email address</label>
                            </div>
                            <div class="form__group">
                                <?php if (in_array("Password do not match!!!<br>", $error_array)) {
                                    echo '<span class="form__feild-error">Password do not match!!!</span><br>';
                                } else  if (in_array("Your password can only contain english alphabets and numbers!!!<br>", $error_array)) {
                                    echo '<span class="form__feild-error">Your password can only contain english alphabets and numbers!!!</span><br>';
                                } else  if (in_array("Password must be between 5 to 30 characters!!!<br>", $error_array)) {
                                    echo '<span class="form__feild-error">Password must be between 5 to 30 characters!!!</span><br>';
                                }
                                ?>
                                <input type="password" class="form__input" name="password" id="password"
                                    placeholder="Password" required />
                                <label class="form__label" for="password">password</label>
                            </div>
                            <div class="form__group">
                                <input type="password" class="form__input" name="confirmPassword" id="confirmPassword"
                                    placeholder="confirm Password" required />
                                <label class="form__label" for="confirmPassword">password</label>
                            </div>
                            <div class="form__group">
                                <button type="submit" name="submit" class="btn btn--green">
                                    Sign up
                                </button>
                            </div>
                            <div class="form__group">
                                <span class="form__ask">Already registered ? </span>
                                <a href="register.php" class="form__link"> login Now!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>

</html>