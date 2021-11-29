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

    <?=GetEditHeader($header_title, 1);?>
    <div class="intro d-flex align-items-center ">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2 class="intro-text">
                        <input type="text" name="edit_page_values" class="form-control mt-2"
                            id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>"><br /> 
                           <input type="text" name="edit_page_values" class="form-control mt-2"
                            id="page_text_value_<?=$ids[1]?>" value="<?=$values[1]?>">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <div class="sb-box d-flex flex-column align-items-center justify-content-evenly ">
                        <img src="./assets/images/logo.jpg" alt="">
                     
                        <textarea type="text" rows="7" cols="15" name="edit_page_values" class="form-controls mt-5"
                id="page_text_value_<?=$ids[2]?>"><?=$values[2]?></textarea>
 
 
                    
                        <a href="./login" class="w-100 btn  black_btn btn-lg">Join Today</a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="section-l1">
        <div class="container">
             <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[3]?>" value="<?=$values[3]?>">
                <br />
                <input type="text" name="edit_page_values" class="form-controls"
                                id="page_text_value_<?=$ids[26]?>" value="<?=$values[26]?>">
           

            <div class="d-flex flex-sm-row flex-column mb-3 mt-70">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="circle-out d-flex justify-content-center align-items-center">
                        <div class="circle-in d-flex justify-content-center align-items-center">
                            <h6 class="text-center">1</h6>
                        </div>
                    </div>
                </div>
                <div class="m-left mt-3 w-100">
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[4]?>" value="<?=$values[4]?>">
                    <textarea type="text" rows="7" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[5]?>"><?=$values[5]?></textarea>
    
                </div>
            </div>
            <div class="d-flex flex-sm-row flex-column mb-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="circle-out d-flex justify-content-center align-items-center">
                        <div class="circle-in d-flex justify-content-center align-items-center">
                            <h6 class="text-center">2</h6>
                        </div>
                    </div>
                </div>
                <div class="m-left mt-3 w-100">
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>">
                    <textarea type="text" rows="7" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[7]?>"><?=$values[7]?></textarea>
    
                </div>
            </div>
            <div class="d-flex flex-sm-row flex-column mb-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="circle-out d-flex justify-content-center align-items-center">
                        <div class="circle-in d-flex justify-content-center align-items-center">
                            <h6 class="text-center">3</h6>
                        </div>
                    </div>
                </div>
                <div class="m-left mt-3 w-100">
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[8]?>" value="<?=$values[8]?>">
                    <textarea type="text" rows="7" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[9]?>"><?=$values[9]?></textarea>
    
                </div>
            </div>

            <div class="d-flex flex-sm-row flex-column mb-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="circle-out d-flex justify-content-center align-items-center">
                        <div class="circle-in d-flex justify-content-center align-items-center">
                            <h6 class="text-center">4</h6>
                        </div>
                    </div>
                </div>
                <div class="m-left mt-3 w-100">
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[10]?>" value="<?=$values[10]?>">
                    <textarea type="text" rows="7" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[11]?>"><?=$values[11]?></textarea>
    
                </div>
            </div>


        </div>
    </div>


    <div class="section-l2 d-flex align-items-center justify-content-center">
        <div class="container ">
            <div class="row">
            <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[12]?>" value="<?=$values[12]?>">
                                <textarea type="text" rows="7" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[13]?>"><?=$values[13]?></textarea>
                <div class="col-sm-12 amc">
                    <a href="./login" type="button" class="btn black_btn mt-4 w-300 btn-lg">Sign up to
                        get
                        started</a>

                </div>
            </div>
        </div>
    </div>

    <div class="section-l3">
        <div class="container">
            <div class="row">
            <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[14]?>" value="<?=$values[14]?>">
                
                <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[15]?>" value="<?=$values[15]?>">
                <div class="col-md-6 col-sm-12 p-3">
                    <div class="card vscard w-100 d-flex justify-content-center align-items-center"
                        style="width: 18rem;">
                        <i class="fas fa-globe fsa darkblue"></i>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                             
                            <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[16]?>" value="<?=$values[16]?>">
                           
                             <textarea type="text" rows="3" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[17]?>"><?=$values[17]?></textarea>
                                
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <div class="card vscard w-100 d-flex justify-content-center align-items-center"
                        style="width: 18rem;">
                        <i class="fas fa-network-wired fsa darkblue"></i>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                 
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[18]?>" value="<?=$values[18]?>">
                           
                             <textarea type="text" rows="3" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[19]?>"><?=$values[19]?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <div class="card vscard w-100 d-flex justify-content-center align-items-center"
                        style="width: 18rem;">
                        <i class="fas fa-laptop fsa darkblue"></i>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                  
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[20]?>" value="<?=$values[20]?>">
                           
                             <textarea type="text" rows="3" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[21]?>"><?=$values[21]?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <div class="card vscard w-100 d-flex justify-content-center align-items-center"
                        style="width: 18rem;">
                        <i class="far fa-building fsa darkblue"></i>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                  
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[22]?>" value="<?=$values[22]?>">
                           
                             <textarea type="text" rows="3" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[23]?>"><?=$values[23]?></textarea>
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
                    <h2 class="bold display-5 darkblue">
                    <input type="text" name="edit_page_values" class="form-controls mt-2"
                                id="page_text_value_<?=$ids[24]?>" value="<?=$values[24]?>">
                           
                    </h2>
                </div>
                <div class="col-md-6 col-sm-12 p-5">
                    <h2 class="display-xs darkblue">
                    <textarea type="text" rows="3" cols="15" name="edit_page_values" class="form-controls mt-5"
                    id="page_text_value_<?=$ids[25]?>"><?=$values[25]?></textarea>
                        </div>
                           
                    </h2>
                
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