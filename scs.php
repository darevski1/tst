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
    <div class="ms-mobile">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="mt-4">Schedule</h2>
                    <p>A timer will track the minutes you spend on each section. You must click on the submit button to receive full credit. A 'keep alive' box will pop up every few minutes. If you are not present to click the button, you will be returned to this page, and the timer will stop. If you leave the section without clicking the submit button, you may lose some of your earned time. </p>
                </div>
                <div class="d-grid gap-2 mt-3">
                     <button class="btn btn-bt" type="button">Chooes Week</button>
                </div>
                <div class="col-sm-12">
                    <div class="wrapme mt-5">
                        <div class="block-arow  d-flex justify-content-center align-items-baseline">
                         
                            <i class="fas fa-caret-left"></i>
                       
                        </div>
                        <div class="wrap-schedule">
                            
                            <div class="block-timer d-flex justify-content-center align-items-center">Monday, Sep 13th, 2021</div>

                            <div class="card card-schedule d-flex align-items-center "> 
                                <div class="mt-2"><b>Time: </b>08:00h - 08:00h</div>
                                <div class="sc-option mt-2 mb-2"> / </div>
                            </div>
                            <div class="card card-schedule d-flex align-items-center "> 
                                <div class="mt-2"><b>Time: </b>08:00h - 08:00h</div>
                                <div class="sc-option mt-2 mb-2"> / </div>
                            </div>
                            <div class="card card-schedule d-flex align-items-center "> 
                                <div class="mt-2"><b>Time: </b>08:00h - 08:00h</div>
                                <div class="sc-option mt-2 mb-2"> 
                                    <div class="card openc cardersa">
                                        <div class="card-body">
                                            <h6 class="card-titleg ms-title">new_password</h6>
                                            <p class="scheduleg-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                                            <p class="scheduleg-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                                            <div class="col-sm-12 text-center">
                                                <button class="btn openc btn-sm">dddd</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-schedule d-flex align-items-center "> 
                                <div class="mt-2"><b>Time: </b>08:00h - 08:00h</div>
                                <div class="sc-option mt-2 mb-2"> 
                                    <div class="card opend cardersa">
                                        <div class="card-body">
                                            <h6 class="card-titled ms-title">333</h6>
                                            <p class="schedules-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                                            <p class="schedules-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                                            <div class="col-sm-12 text-center">
                                                <button class="btn opend btn-sm">dddd</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-schedule d-flex align-items-center "> 
                                <div class="mt-2"><b>Time: </b>08:00h - 08:00h</div>
                                <div class="sc-option mt-2 mb-2"> 
                                    <div class="card openb cardersa">
                                        <div class="card-body">
                                            <h6 class="card-titleg ms-title">333</h6>
                                            <p class="scheduleg-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                                            <p class="scheduleg-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                                            <div class="col-sm-12 text-center">
                                                <button class="btn openb btn-sm">dddd</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-schedule d-flex align-items-center "> 
                                <div class="mt-2"><b>Time: </b>08:00h - 08:00h</div>
                                <div class="sc-option mt-2 mb-2"> 
                                    <div class="card openl cardersa">
                                        <div class="card-body">
                                            <h6 class="card-titlel ms-title">333</h6>
                                            <p class="schedulel-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                                            <p class="schedulel-text ms2 ms2-title ms-p">Status: <b>Finished</b></p>
                                            <div class="col-sm-12 text-center">
                                                <button class="btn openl btn-sm">dddd</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        

                        <div class="block-arow  d-flex justify-content-center align-items-baseline">
                            <i class="fas fa-caret-right" onclick="SwipeRightSchedule()"></i>
                        </div>

                    </div>
                    
                </div>
        
            </div>
        </div>

    </div>
    <?=getFooter("");?>
    <?=getBottomScripts("");?>
</body>


</html>