<?php
    $user = $this->d['user'];
    $mostRecentTask = $this->d['mostRecentTask'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/home.css">
    <title>Home</title>
</head>
<body>
    <?php $this->showMessages(); ?>
    <div class="container">
        <!-- <header> -->
            
            <?php require 'views/header.php'; ?>
    
        <!-- carousel -->
        <section id="carousel">
            <p>This month you made:</p>
            <div class="carousel__container">
                <button aria-label="prev" class="carousel__prev">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="carousel__list">
                    
                </div>
                <button aria-label="next" class="carousel__next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div role="tablist" class="carousel__indicadores"></div>
            <div class="recent__task"><p>Most Recent task: <?php echo ' ' . $mostRecentTask['hours'] . 'hrs ' . $mostRecentTask['title'] ?></p></div>
            
        <!-- bottom right btn -->
        </section>
        <div title="click here to add new task" class="addBtn">
            <i class="material-icons">add</i>
        </div>

        <!-- google month charts -->
        <section id="google__charts">
            <div class="carousel__container2">
                <button aria-label="prev" class="carousel__prev2">
                    <i class="fas fa-chevron-left"></i>
                </button>

                    <div class="carousel__list2">
                        <div id="carousel__elementThisMonth"></div>
                        <div id="carousel__elementLastMonth"></div>
                    </div>

                <button aria-label="prev" class="carousel__next2">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div role="tablist" class="carousel__indicadores2"></div>
        </section>
    </div>

    <!-- intro -->
    <div class="slider">
        <div class="title">created by chiniwiris</div>
    </div>

    <!-- ajax form -->
    <div class="new-task-container"></div>
    
    <!-- scripts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="<?php echo constant('URL') ?>public/js/home-ajax.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"
      integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ=="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/glider-js@1.7.3/glider.min.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="<?php echo constant('URL') ?>public/js/home.js"></script>
</body>
</html>