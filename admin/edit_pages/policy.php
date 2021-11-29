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

    if($page_id == 0)
        exit("");
    

    $query = "SELECT id, text_value FROM page_text_values WHERE page_id = $page_id";

    $rows = QuerySelect($query);
    // echo $query;

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

<?=getHeader("Privacy Policy", "../.");?>

<body class="d-flex flex-column h-100">
    <?=GetEditHeader("Privacy Policy", 15);?>
    <div class="intro-text-sellers-increase d-flex  justify-content-center align-items-center">
        <div class="container-xl pb-5 pt-4">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <input type="text" name="edit_page_values" class="form-control mt-5 mb-5"
                        id="page_text_value_<?=$ids[0]?>" value="<?=$values[0]?>">
                    <textarea type="text" rows="26" name="tiny_value" class="form-control mt-5 cs"
                        id="page_text_value_<?=$ids[1]?>"><?=$values[1]?></textarea>
                    <div id="editor"></div>
                </div>
            </div>
        </div>
    </div>

    <?=getFooter("../.")?>
    <!-- Da se dodade -->
    <?=PopUpButtonsAdmin()?>
</body>

<?=getBottomScripts("../.")?>
<script type="text/javascript" src="../../js/admin.js"></script>

<script src="https://cdn.tiny.cloud/1/8rxd34aaymwgu5divmpyyccz6dyivq3g4dqxnk3802s7h0ap/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
        tinymce.init({
          selector: ".cs",
       })
</script>

</html>