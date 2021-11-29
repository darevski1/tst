<?php session_start();?>
<?php

require_once '../../includes/config.php';
require_once '../../includes/db.php';
require_once '../../includes/generators.php';

ConnectToDatabase();


$table = 'admins';
$user_id = 'admin_id';

$loged_in = isLogedIn($table, $user_id);

if (!$loged_in) {
    ?>
        <script type="text/javascript">
            window.location.replace("../login");
        </script>
    <?php
    exit();
}

if (isset($_GET['spuid']) && $_GET['spuid'] != "") {

    $page_unique_id = check_input($_GET['spuid']);

    $page_id = GetID_FromUniqueID($page_unique_id, "site_pages");

    if ($page_id == 0)
        exit("");
    
    $rows = GetPageTextValuesAdmin($page_id);

    $header_title = $rows[0]["page_title"];

    $ids = [];
    $values = [];

    for ($i = 0; $i < count($rows); $i++) {
        $ids[] = $rows[$i]['id'];
        $values[] = $rows[$i]['text_value'];
    }

}else
    exit("");


?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader($header_title, "../.");?>


<body>
 
    <?=GetEditHeader($header_title, 6);?>
 

    <div class="contact d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mx">

                <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
                    <div class="col-sm-12 text-center mb-4 mt-5">
                      <img src="../../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">
                    </div>
                    <h4 class="display-6 mb-5 w-75">
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>"> 
                    </h4>
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
           <div class="row d-flex align-items-center mb-5">
               <div class="col-sm-4 d-flex flex-column align-items-center">
                  <i class="far fa-map  fas-size"></i>
                  <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>"> 
                 
                    <textarea type="text" rows="3" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[1]?>"><?=$values[1]?></textarea>
                   
               </div>
               <div class="col-sm-4 d-flex flex-column align-items-center">
                  <i class="far fa-map  fas-size"></i>
                  <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>"> 
                   
                    <textarea type="text" rows="3" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[3]?>"><?=$values[3]?></textarea>
                    
               </div>
               <div class="col-sm-4 d-flex flex-column align-items-center">
                   <i class="far fa-envelope fas-size"></i>
                   <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>"> 
                   
                    <textarea type="text" rows="3" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[5]?>"><?=$values[5]?></textarea>
                     
               </div>
           </div>
        </div>
                    
    </div>
    <?=getFooter("../.");?>


    <?=PopUpButtons()?>

</body>

    <?=getBottomScripts("../.");?>
<script type="text/javascript" src="../../js/admin.js"></script>
</html>