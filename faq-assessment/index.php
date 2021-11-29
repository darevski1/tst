<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();
$values = GetPageTextValues(10);
?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("FAQ Assessment");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container pb-5">
        <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
           <div class="col-sm-12 text-center mb-4 mt-5">
           <img src="./../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">

           </div>
                    <h4 class="display-6 mb-5 w-75"><?=$values[0]?></h4>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <?=$values[1]?>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><?=$values[2]?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <?=$values[3]?>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><?=$values[4]?></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <?=$values[5]?>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><?=$values[6]?></p>
                    </div>
                </div>
            </div>

        </div>

        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <?=$values[7]?>
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                   <p><?=$values[8]?></p>
                    </div>
                </div>
            </div>

        </div>


        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <?=$values[9]?>
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><?=$values[10]?></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <?=$values[11]?>
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><?=$values[12]?></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <?=$values[13]?>
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><?=$values[14]?></p>
                    </div>
                </div>
            </div>

        </div>

        <div class="accordion mt-3  mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <?=$values[15]?>
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p><?=$values[16]?></p>
                    </div>
                </div>
            </div>

        </div>
 
   
       



    </div>
    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>