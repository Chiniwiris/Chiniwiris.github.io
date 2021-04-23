<?php $user = $this->d['user']; 
      $journey = $this->d['journey'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/register.css">
    <title>Register</title>
</head>
<body>
    <?php $this->showMessages(); ?>
    <div class="container">
        <?php require 'views/header.php'; ?>

        <div class="register-table">
        <table>
            <thead>
                <tr>
                    <th>title</th>
                    <th>category</th>
                    <th>hours</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="items-container">
                
                    <?php 
                         require_once 'models/joincategoriesjourneymodel.php';
                         foreach($journey as $task){
                             $joinModel = new JoinCategoriesJourneyModel();
                             $joinModel->settitle($task->getTitle());
                             $joinModel->setTaskId($task->getTaskId());
                             $joinModel->setHours($task->getHours());
                             $joinModel->setCategoryId($task->getCategoryId());
                             $joinModel->setColor($task->getColor());
                             $joinModel->setUserId($task->getUserId());
                             $joinModel->setNameCategory($task->getNameCategory());
                             
                             ?>
                             <tr id="item-<?php echo $joinModel->getTaskId(); ?>">
                                <td><span></span><?php echo $joinModel->getTitle(); ?></td>
                                <td style="color: <?php echo $joinModel->getColor(); ?>"><?php echo $joinModel->getNameCategory(); ?></td>
                                <td><?php echo $joinModel->gethours(); ?></td>
                                <td><button class="delete-btn" data-id="<?php echo $joinModel->getTaskId();?>">delete</button></td>
                            </tr>
                             <?php
                         }
                    ?>
               
            </tbody>
        </table>
        </div>

    </div>
    <script src="<?php echo constant('URL') ?>public/js/register.js"></script>
</body>
</html>