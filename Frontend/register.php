<?php
$conn =  mysqli_connect("localhost", "root", "", "freezone");
if (mysqli_connect_errno()) {
    echo "Cannot connect to the Database due to the following error :" . mysqli_connect_errno();
}
$fullname = "";
$username = "";
$email = "";
$password = "";
$confirmPassword = "";
$date = "";
if ($_POST['submit']) {

    //fullname
    $fullname = strip_tags($_POST['fullname']); //Remove HTML-tags
    $fullname = str_replace(' ', '', $fname); //Remove white-spaces
    $fullname = ucfirst(strtolower($fullname)); //Convert to lowercase

    //username
    $username = strip_tags($_POST['username']); //Remove HTML-tags
    $username = str_replace(' ', '', $username); //Remove white-spaces
    $username = ucfirst(strtolower($username)); //Convert to lowercase

    //email
    $email = strip_tags($_POST['email']); //Remove HTML-tags
    $email = str_replace(' ', '', $email); //Remove white-spaces
    $email = ucfirst(strtolower($email)); //Convert to lowercase
    //password
    $password = strip_tags($_POST['password']); //Remove HTML-tags
    $confirmPassword = strip_tags($_POST['confirmPassword']); //Remove HTML-tags
    //date
    $date = date("y-m-d"); //get current date

    //Email format validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = filter_var($email . FILTER_VALIDATE_EMAIL);
    } else {
        echo "Invalid email format!!!";
    }

    $query = mysqli_query($conn, "INSERT INTO users VALUES('','Hamayun')");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeZone | Registration</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FreeZone | login</title>

        <!-- Styling -->
        <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
    </head>

</body>
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
                    <form action="backend/register.php" method="POST" class="form">
                        <div class="form__group">
                            <input type="text" class="form__input" name="fullname" id="fullname" placeholder="Full Name"
                                required autofocus />
                            <label class="form__label" for="fullname">Full Name</label>
                        </div>
                        <div class="form__group">
                            <input type="text" class="form__input" name="username" id="username" placeholder="Username"
                                required />
                            <label class="form__label" for="username">Username</label>
                        </div>
                        <div class="form__group">
                            <input type="email" class="form__input" name="email" id="email" placeholder="Email address"
                                required />
                            <label class="form__label" for="email">Email address</label>
                        </div>
                        <div class="form__group">
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

</html>

</body>

</html>