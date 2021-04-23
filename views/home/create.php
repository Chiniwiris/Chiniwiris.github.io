<?php $categories = $this->d['categories']; ?>

            <form id="home-form" action="<?php echo constant('URL') ?>home/newTask" method="post" autocomplete="off">
                <div class="section">
                    <label for="category">Category</label>
                    <select name="category" id="category-select" required="">
                        <?php
                            foreach($categories as $category){
                                ?>
                                <option value="<?php echo $category->getId() ?>"><?php echo $category->getName(); ?></option>
                                <?php
                                }
                        ?>
                    </select>
                </div>
                <div class="section">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title-input" required="">
                </div>
  
                
                <div class="section">
                    <label for="hours">hours</label>
                    <input type="number" name="hours" id="hours-input" required="">
                </div>
                <div class="section">
                    <input type="submit" value="New Task">
                </div>
            </form>
