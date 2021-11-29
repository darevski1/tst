<?php session_start();?>
<?php

require_once './includes/db.php';
require_once './includes/config.php';
require_once './includes/generators.php';

ConnectToDatabase();

$values = GetPageTextValues(1);

?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("Home", "");?>

<body>
    <?=GetHead("");?>
    <?=getNavbar("");?>
    <div class="intro d-flex align-items-center " >
        <div class="container">
            <div class="row">
                

            </div>
        </div>
    </div>
    <div class="section-l1">
        <div class="container">
            <h2 class="display-5"><?=$values[3]?>
                <br />
                <?=$values[26]?>
            </h2>

            <div class="d-flex flex-sm-row flex-column mb-3 mt-70">
                
                <div class="mt-3">
                    <h4><?=$values[4]?></h4>
                    <p class="medium_p"><?=$values[5]?></p>
                </div>
            </div>
            <div class="d-flex flex-sm-row flex-column mb-3">
                
                <div class="mt-3">
                    <h4><?=$values[6]?></h4>
                    <p class="medium_p"><?=$values[7]?> </p>
                </div>
            </div>
            <div class="d-flex flex-sm-row flex-column mb-3">
                
                <div class="mt-3">
                    <h4><?=$values[8]?></h4>
                    <p class="medium_p">
                    <?=$values[9]?> </p>
                </div>
            </div>

            <div class="d-flex flex-sm-row flex-column mb-3">
                
                <div class="mt-3">
                    <h4><?=$values[10]?></h4>
                    <p class="medium_p"><?=$values[11]?> </p>
                </div>
            </div>


        </div>
    </div>


    <div class="section-l2 d-flex align-items-center justify-content-center">
        <div class="container ">
            <div class="row">
                <h2 class="bold display-3"><?=$values[12]?></h2>
                <p class="big_p mt-4 bold">
                <?=$values[13]?>
                </p>
                
            </div>
        </div>
    </div>

    <div class="section-l3">
        <div class="container">
            <div class="row">
                <h2 class="text-center display-5"><?=$values[14]?></h2>
                <p class="big_p2 text-center mb-5"><?=$values[15]?>!</p>

                <div class="col-md-6 col-sm-12 p-3">
                    <div class="card vscard w-100 d-flex justify-content-center align-items-center"
                        style="width: 18rem;">
                        <i class="fas fa-globe fsa darkblue"></i>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title  fs-25 darkblue"><?=$values[16]?></h5>
                            <p class="card-text text-center big_p mt-3 darkblue"><?=$values[17]?>

                                .</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <div class="card vscard w-100 d-flex justify-content-center align-items-center"
                        style="width: 18rem;">
                        <i class="fas fa-network-wired fsa darkblue"></i>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title  fs-25 darkblue"><?=$values[18]?></h5>
                            <p class="card-text text-center big_p mt-3 darkblue"><?=$values[19]?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <div class="card vscard w-100 d-flex justify-content-center align-items-center"
                        style="width: 18rem;">
                        <i class="fas fa-laptop fsa darkblue"></i>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title  fs-25 darkblue"><?=$values[20]?></h5>
                            <p class="card-text text-center big_p mt-3 darkblue"><?=$values[21]?>

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <div class="card vscard w-100 d-flex justify-content-center align-items-center"
                        style="width: 18rem;">
                        <i class="far fa-building fsa darkblue"></i>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title fs-25 darkblue"><?=$values[22]?>
                            </h5>
                            <p class="card-text text-center big_p mt-3 darkblue"><?=$values[23]?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-l4 d-flex justify-content-center align-items-center">
        <div class="container ">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                    <h2 class="bold display-5 darkblue"><?=$values[24]?></h2>
                </div>
                <div class="col-md-6 col-sm-12 p-5">
                    <h2 class="display-xs darkblue"><?=$values[25]?></h2>
                    <a href="./login" class="btn black_btn mt-4">Join Today</a>
                </div>

            </div>
        </div>
    </div>

    <?=getFooter("");?>


    <?=getBottomScripts("");?>

</body>


</html>