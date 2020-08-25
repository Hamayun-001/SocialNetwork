<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreeZone | login</title>

    <!-- Styling -->
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style.css">
    <!--==============================================================================================s=-->
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
                            login!
                        </h2>
                    </div>
                    <form action="#" class="form">
                        <div class="form__group">
                            <input type="email" class="form__input" name="email" id="email" placeholder="Email address"
                                required autofocus />
                            <label class="form__label" for="email">Email address</label>
                        </div>
                        <div class="form__group">
                            <input type="password" class="form__input" name="password" id="password"
                                placeholder="Password" required />
                            <label class="form__label" for="password">password</label>
                        </div>
                        <div class="form__group u-mb-medium">
                            <div class="form__group-radio">
                                <input type="radio" class="form__radio-input" name="size" id="small-radio" />
                                <label for="small-radio" class="form__radio-label"><span
                                        class="form__radio-button"></span>Keep me Login</label>
                            </div>
                        </div>
                        <div class="form__group">
                            <button type="submit" class="btn btn--green">
                                <i class="fa fa-sign-in"></i> Login
                            </button>
                        </div>
                        <div class="form__group">
                            <span class="form__ask">Not registered ? </span>
                            <a href="register.php" class="form__link"> Signup Now!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

</html>