<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();
$values = GetPageTextValues(2);

?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("About us");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="section-2 ">
        <div class="container">
            <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
                <div class="col-sm-12 text-center mb-4">
                    <img src="./../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">
                </div>
                <h4 class="display-6 mb-2 w-75"> <?=$values[0]?>
                </h4>
            </div>
            <div class="col-sm-12">
                <p class="big_p mt-4">
                <?=$values[1]?>
                </p>
            </div>
            
        </div>
    </div>
    <div class="section-l2s d-flex align-items-center justify-content-center">
        <div class="container ">
            <div class="row">
                <h2 class="bold display-5"><?=$values[2]?></h2>
                <p class="big_p mt-4">
                <?=$values[3]?>
                </p>
                
            </div>
        </div>
    </div>
    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>