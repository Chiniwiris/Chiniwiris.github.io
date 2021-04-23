<?php
    $user = $this->d['user'];
    $photo = 'img/' . $user->getPhoto();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/user.css">
    <title>User</title>
</head>
<body>
<?php $this->showMessages(); ?>
   
   <div class="container">
       <?php require 'views/header.php'; ?>
       <div class="user-container">
            <div class="top">
                <div class="user__container__top__profile__photo"><img src="<?php echo ($user->getPhoto() != '')? 'img/' . $user->getPhoto() : 'img/no-photo.jpg' ?>" alt=""></div>
                <div class="username"><?php echo $user->getName(); ?></div>
            </div>
            <div class="body">
                <div class="section">
                    <div class="user__container__bottom__profile__photo"><img src="<?php echo ($user->getPhoto() != '')? 'img/' . $user->getPhoto() : 'img/no-photo.jpg' ?>" alt=""></div>
                    <form action="<?php echo constant('URL') ?>user/updatePhoto" method="post" enctype="multipart/form-data" autocomplete="off">
                        <p>profile photo:</p>
                        <input type="file" name="photo" id="photo-input" required>
                        <input type="submit" value="update photo">
                    </form>
                </div>
                <div class="section">
                    <form action="<?php echo constant('URL') ?>user/updateUsername" method="post" autocomplete="off">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username-input" required placeholder="<?php echo $user->getUsername() ?>">
                        <input type="submit" value="update username">
                    </form>
                </div>
                <div class="section">
                    <form action="<?php echo constant('URL') ?>user/updatePassword" method="post" autocomplete="off">
                        <label for="password">password:</label>
                        <input type="password" name="old-password" id="old-password-input" placeholder="old password" required><br>
                        <input type="password" name="new-password" id="new-password-input" placeholder="new password" required>
                        <input type="submit" value="update password">
                    </form>
                </div>
            </div>
        </div>
   </div>
</body>
</html>