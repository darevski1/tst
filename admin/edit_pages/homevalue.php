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

    if ($page_id == 0) {
        exit("");
    }

    $query = "SELECT id, text_value FROM page_text_values WHERE page_id = $page_id ORDER BY id ASC";

    $rows = QuerySelect($query);
    

    $ids = [];
    $values = [];

    for ($i = 0; $i < count($rows); $i++) {
        $ids[] = $rows[$i]['id'];
        $values[] = $rows[$i]['text_value'];
    }

} else {
    exit("");
}

?>
<!doctype html>
<html lang="en">

<?=getHeader("Home value", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Home value", 16);?>
    <div class="home-value-hero d-flex justify-content-center align-items-center">
        <div class="home-value">
            <div class="container-xl">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 mb-5mobile">
                        <div class="home-bg d-flex justify-content-center align-items-center h-100 mb-3" style="width: 420px">

                            <input type="text" name="edit_page_values" class="form-control" id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>">
                            
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="form-contact ptb-30 h-100">
                            <div class="form-stl">
                                <form action="" onsubmit="return false"  autocomplete="on">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <input type="text" name="edit_page_values" class="form-control" 
                                                        id="page_text_value_<?=$ids[1]?>" value="<?=$values[1]?>">

                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <input type="text" name="edit_page_values" class="form-control" 
                                                        id="page_text_value_<?=$ids[2]?>" value="<?=$values[2]?>">

                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <input type="text" name="edit_page_values" class="form-control" 
                                                        id="page_text_value_<?=$ids[3]?>" value="<?=$values[3]?>">
                                                
                                            </div>
                                        </div>

                                                <textarea type="text" rows="3" name="edit_page_values" class="form-control"
                                                       id="page_text_value_<?=$ids[4]?>"><?=$values[4]?></textarea>

                                        <div class="col-sm-12 mt-4">
                                            <div class="form-group">


                                                <input type="text" name="edit_page_values" class="form-control" 
                                                        id="page_text_value_<?=$ids[5]?>" value="<?=$values[5]?>">
                            
                                            </div>
                                        </div>
                                        <div class="col-sm-12" >
                                            <div class="form-group">


                                                <input type="text" name="edit_page_values" class="form-control" 
                                                        id="page_text_value_<?=$ids[6]?>" value="<?=$values[6]?>">
                            
                            
                                            </div>
                                        </div>
                                        <div class="col-sm-12" >
                                            <div class="form-group">


                                                <input type="text" name="edit_page_values" class="form-control" 
                                                        id="page_text_value_<?=$ids[7]?>" value="<?=$values[7]?>">
                            
                            
                                            </div>
                                        </div>

                                        <div class="col-sm-12 mt-3">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-lg round-btn btn-block main-btn btn-p">
                                                  Calculate
                                                </button>
                                            </div>
                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?=getFooter("../.")?> 

    <?=PopUpButtons()?>
</body>

<?=getBottomScripts("../.")?>
<script type="text/javascript" src="../../js/admin.js"></script>

</html>