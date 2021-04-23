<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Courgette&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/login.css">

    <title>Login</title>
</head>
<body>
    <?php $this->showMessages(); ?>
    <header>
        <h2>JourneyApp</h2>
    </header>
    <div class="container">
        <div class="form-container">
            <div class="form__container__header">
                <h3>Welcome to JourneyApp</h3>
                <p>complete the form to register</p>
            </div>
            <form action="<?php echo constant('URL') ?>signup/newUser" method="post" autocomplete="off">
                <label for="username">Username</label>
                <input type="text" name="username" id="username-input"><br>

                <label for="name">name</label>
                <input type="text" name="name" id="name-input"><br>

                <label for="password">password</label>
                <input type="password" name="password" id="password-input"><br>

                <input type="submit" value="Enter"><br>

                <p>Don't you have an account already? <a href="<?php echo constant('URL') ?>login">click here to create your account</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<a class="credits" href='https://www.freepik.com/photos/background'>Background photo created by kjpargeter - www.freepik.com</a>