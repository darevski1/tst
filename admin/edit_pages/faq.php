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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


<body>
 
    <?=GetEditHeader($header_title, 4);?>
    <div class="container pb-5">
        <div class="col-sm-12 text-center d-flex justify-content-center align-items-center flex-column">
           <div class="col-sm-12 text-center mb-4 mt-5">
           <img src="../../assets/images/logo_oaklend.png" alt="logo oaklend" class="mb-3">

           </div>
       
            <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>">
            
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[1]?>" value="<?=$values[1]?>">
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>
                        <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[2]?>"><?=$values[2]?></textarea>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[3]?>" value="<?=$values[3]?>">
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[4]?>"><?=$values[4]?></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[5]?>" value="<?=$values[5]?>">
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[6]?>"><?=$values[6]?></textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[7]?>" value="<?=$values[7]?>">
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[8]?>"><?=$values[8]?></textarea>
                    </div>
                </div>
            </div>

        </div>


        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[9]?>" value="<?=$values[9]?>">
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[10]?>"><?=$values[10]?></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[11]?>" value="<?=$values[11]?>">
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[12]?>"><?=$values[12]?></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[13]?>" value="<?=$values[13]?>">
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[14]?>"><?=$values[14]?></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[15]?>" value="<?=$values[15]?>">
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[16]?>"><?=$values[16]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[17]?>" value="<?=$values[17]?>">
                    </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[18]?>"><?=$values[18]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[19]?>" value="<?=$values[19]?>">
                    </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[20]?>"><?=$values[20]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[21]?>" value="<?=$values[21]?>">
                    </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[22]?>"><?=$values[22]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[23]?>" value="<?=$values[23]?>">
                    </button>
                </h2>
                <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[24]?>"><?=$values[24]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsetwe" aria-expanded="false" aria-controls="collapsetwe">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[25]?>" value="<?=$values[25]?>">
                    </button>
                </h2>
                <div id="collapsetwe" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[25]?>"><?=$values[25]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTre" aria-expanded="false" aria-controls="collapseTre">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[26]?>" value="<?=$values[26]?>">
                    </button>
                </h2>
                <div id="collapseTre" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[27]?>"><?=$values[27]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsePet" aria-expanded="false" aria-controls="collapsePet">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[27]?>" value="<?=$values[27]?>">
                    </button>
                </h2>
                <div id="collapsePet" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[28]?>"><?=$values[28]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[29]?>" value="<?=$values[29]?>">
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[30]?>"><?=$values[30]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSeve" aria-expanded="false" aria-controls="collapseSeve">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[31]?>" value="<?=$values[31]?>">
                    </button>
                </h2>
                <div id="collapseSeve" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[32]?>"><?=$values[32]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEig" aria-expanded="false" aria-controls="collapseEig">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[32]?>" value="<?=$values[32]?>">
                    </button>
                </h2>
                <div id="collapseEig" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[33]?>"><?=$values[33]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseNin" aria-expanded="false" aria-controls="collapseNin">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[33]?>" value="<?=$values[33]?>">
                    </button>
                </h2>
                <div id="collapseNin" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[34]?>"><?=$values[34]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTn" aria-expanded="false" aria-controls="collapseTn">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[35]?>" value="<?=$values[35]?>">
                    </button>
                </h2>
                <div id="collapseTn" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[36]?>"><?=$values[36]?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-3 mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEe" aria-expanded="false" aria-controls="collapseEe">
                        <input type="text" name="edit_page_values" class="form-controls mt-2"
                            id="page_text_value_<?=$ids[37]?>" value="<?=$values[37]?>">
                    </button>
                </h2>
                <div id="collapseEe" class="accordion-collapse collapse" aria-labelledby="headingNine"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <textarea type="text" rows="6" cols="15" name="edit_page_values" class="form-controls mt-5 summernote"
                id="page_text_value_<?=$ids[38]?>"><?=$values[38]?></textarea>
                    </div>
                </div>
            </div>
        </div>
         
    </div>

    <?=getFooter("../.");?>
    <?=PopUpButtons()?>

</body>

    <?=getBottomScripts("../.");?>
<script type="text/javascript" src="../../js/admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
</html>