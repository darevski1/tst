<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();
$values = GetPageTextValues(3);
?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("How it works");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container pb-5">
        <div class="row">
            <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
                <div class="col-sm-12 text-center mb-4 mt-5">
                <img src="./../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">
                </div>
                    <h4 class="display-6 mb-5 w-75"><?=$values[0]?></h4>
            </div>
            <p class="lead">
            <?=$values[1]?>
            </p>
            <div class="card mt-5">
                <div class="card-body">
                    <h4><b><?=$values[2]?></b></h4>
                    <p><?=$values[3]?> </p>
                </div>
            </div>
            <div class="card  mt-3">
            <div class="card-body">
                    <h4><b><?=$values[4]?></b></h4>
                    <p><?=$values[5]?> </p>
                </div>
            </div>
            <div class="card mt-3">
                
                <div class="card-body">
                    <h4><b><?=$values[6]?></b></h4>
                    <p><?=$values[6]?> </p>
                </div>
                  
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 mb50 pb-3">
        <div class="row mb-5">
            <div class="col-md-6 col-sm-12 mr-1 p-1 ">
                <a href="../register" class="btn black_btn_outline btn-block btn-wider" type="button">Begin
                    Community
                    Service</a>
            </div>
            <div class="col-md-6 col-sm-12 p-1">
                <a href="../login" class="btn black_btn btn-block btn-wider" type="button">Login to Your
                    Account</a>
            </div>
        </div>
    </div>
    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>