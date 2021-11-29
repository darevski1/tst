<?php session_start();?>
<?php

require_once '../../includes/db.php';
require_once '../../includes/config.php';
require_once '../../includes/generators.php';
require_once '../../messages/generators.php';
require_once '../../my-account/my_photos_videos/generators.php';



    ConnectToDatabase();

    $table   = 'admins';
    $user_id = 'admin_id';

    $loged_in = isLogedIn($table, $user_id);


    if(!$loged_in){
        ?>
            <script type="text/javascript">
                window.location.replace("../login");
            </script>               
        <?php
    }

    $user_id = 0;

    if(isset($_GET["uuid"]) && $_GET["uuid"] != ""){

        $user_unique_id = check_input($_GET["uuid"]);

        $user_id = GetID_FromUniqueID($user_unique_id, 'users');

        if($user_id == 0)
          exit();
    }else
      exit();
    

?>


<!doctype html>
<html lang="en">

<?=getHeader("Projects", "../.");?>

<body class="d-flex flex-column h-100">

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="sidebar">
            <ul class="nav" role="tablist">
                
                <li class="nav-item w-100" onclick="MyAccountTab(4)">
                    <a href="#photos_videos" class="nav-link pl-3" role="tab" data-toggle="tab" id="my_account_link_4">My Photos and Videos</a>
                </li>

                <li class="nav-item w-100" onclick="MyAccountTab(5)">
                    <a href="#project_status" class="nav-link pl-3" role="tab" data-toggle="tab" id="my_account_link_5">Project Status</a>
                </li>

            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="content">

            <nav class="navbar navbar-expand-lg navbar-light">
                <button type="button" id="sidebarCollapse" class="btn main-btn nostyle" style="all: unset; cursor:pointer">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
            </nav>
            <div class="tab-content tab-space">

                <?php include('../../my-account/my_photos_videos/index.php');?>
                
                <?php include('../../my-account/project_status.php');?>

            </div>

        </div>
    </div>

</body>
<?=getBottomScripts("../.")?>

<script type="text/javascript" src="../../my-account/my_photos_videos/script.js"></script>
<script type="text/javascript" src="../../js/messages.js"></script>






<script>

RenovationEstimateSelectedPhotos();
SelectMyAccountTab(5)

// side navbar on profile page
$(document).ready(function() {
    $("#sidebarCollapse").on("click", function() {
        $("#sidebar").toggleClass("active");
    });
});

$(document).ready(function() {

    $("#preview").hide();
    $("#edit_btn").click(function() {
        $("#edit").hide();
        $("#preview").show();
    });
    $("#cancel").click(function() {
        $("#preview").hide();
        $("#edit").show();
    });
});
// select 2
$(document).ready(function() {
    $('.select2-selection--single').select2({
        minimumResultsForSearch: -1,
        dropdownAutoWidth: true
    });
});

$('.nav li a').click(function() {
    $('.nav li a').removeClass('sideactive')
    $(this).addClass('sideactive');
});
</script>

</html>