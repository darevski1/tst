<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();
$values = GetPageTextValues(6);
?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("Contact");?>

<body>
    <?=GetHead();?>

    <?=getNavbar();?>

    <div class="contact d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mx">

                <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
                    <div class="col-sm-12 text-center mb-4 mt-5">
                      <img src="../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">
                    </div>
                    <h4 class="display-6 mb-5 w-75">Contact Us</h4>
                </div>                     
                    <div class="form">
                      <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="contact_name" class="form-control contact-in ">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">E-email:</label>
                                <input type="email" id="contact_email" class="form-control contact-in ">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <label for="name">Subject:</label>
                                <input type="text" id="contact_subject" class="form-control contact-in ">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <label for="name">Message:</label>
                                <textarea id="contact_message" class="form-controls contact-in" cols="30" rows="5"></textarea>        
                            </div>
                        </div>


                        <div class="alert alert-danger" role="alert"  id="contact_error_message" 
                             style="display: none; width: 600px; margin-left: 12px; margin-top: 20px; margin-bottom: -10px;">
                            
                        </div>
                        <div class="alert alert-success" role="alert" id="contact_success_message"
                             style="display: none; width: 600px; margin-left: 12px; margin-top: 20px; margin-bottom: -10px;">
                        </div>

                        <div class="col-sm-12">
                            <button type="button" class="btn black_btn mt-4 btn-wider btn-lg" onclick="ContactUs()">Send</button>
                        </div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-info d-flex align-items-center p-2">
        <div class="container">
           <div class="row d-flex align-items-center">
               <div class="col-sm-4 d-flex flex-column align-items-center">
                  <i class="far fa-map  fas-size"></i>
                   <h4><?=$values[0]?></h4>
                    <p class="text-muted">
                    <?=$values[1]?>
                    </p>
               </div>
               <div class="col-sm-4 d-flex flex-column align-items-center">
                   <i class="fas fa-phone fas-size"></i>
                   <h4><?=$values[2]?></h4>
                    <p class="text-muted">
                    <?=$values[3]?>
                    </p>
               </div>
               <div class="col-sm-4 d-flex flex-column align-items-center">
                   <i class="far fa-envelope fas-size"></i>
                   <h4><?=$values[4]?></h4>
                    <p class="text-muted">
                    <?=$values[5]?>
                    </p>
               </div>
           </div>
        </div>
                    
    </div>

    <?=getFooter();?>


</body>
<?=getBottomScripts();?>


</html>