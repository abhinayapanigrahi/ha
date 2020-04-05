<div class="users"><?php

    if(isSessionActive()){
        ?>
        Welcome <?php echo getLogedInUser(); ?> |
        <a href="./index.php?page=logout">Log Out</a>
        <?php
    }else{
        ?><a href="./index.php?page=login">Login</a><?php
    }
    
    ?>              
</div>