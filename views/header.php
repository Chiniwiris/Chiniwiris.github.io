<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Courgette&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/header3.css">
<header>
    <nav>
        <li><a class="nav__controllers" href="<?php echo constant('URL') ?>home">home</a></li>
        <li><a class="nav__controllers" href="<?php echo constant('URL') ?>register">register</a></li>
        <div id="profile-container">
            <a href="<?php echo constant('URL') ?>user">
                <div class="nav__name"><?php echo ($user->getUsername() != '')? $user->getUsername() : $user->getName(); ?></div>
                <div class="nav__photo">
                    <?php 
                        if($user->getPhoto() == ''){?>
                            <i class="material-icons">account_circle</i>
                        <?php
                        } else{?>
                            <div class="profile__photo">
                            <img src="<?php echo constant('URL') ?>img/<?php echo $user->getPhoto() ?>" alt="">
                            </div>
                        <?php
                        }
                    ?>
                </div>    
            </a>
            <div class="profile__container__options">
                <div class="logout-btn"><a href="<?php echo constant('URL') ?>logout">logout</a></div>
            </div>
        </div>
    </nav>
</header>
