<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

require_once('../includes/stripe/old/vendor/autoload.php');
require_once '../includes/stripe_payments.php';

    ConnectToDatabase();

    $loged_in = isLogedIn();
    
    if(!$loged_in){
        ?>
            <script type="text/javascript">
                window.location.replace("../login");
            </script>               
        <?php
        exit();
    }
    
    $page_name = "profile";
    $user_id = $_SESSION['user_id'];


    $query = "SELECT id, unique_id, first_name, last_name, street_adress, city, country, state, 
                     reason, country_id, IFNULL(state_id, 0) AS state_id, gender, birth_month, 
                     birth_day, birth_year, probation_officer, court_id, hours_need, email, zip_code 
              FROM users
              WHERE id = $user_id";

    $rows = QuerySelect($query);

    $first_name     = AddSpace($rows[0]['first_name']);
    $last_name      = AddSpace($rows[0]['last_name']);
    $email          = AddSpace($rows[0]['email']);
    $street_adress  = AddSpace($rows[0]['street_adress']);
    $city           = AddSpace($rows[0]['city']);
    $country        = AddSpace($rows[0]['country']);
    $state          = AddSpace($rows[0]['state']);
    $zip_code       = AddSpace($rows[0]['zip_code']);
    $reason         = AddSpace($rows[0]['reason']);
    $gender         = AddSpace($rows[0]['gender']);
    $birth_month    = AddSpace($rows[0]['birth_month']);
    $birth_day      = AddSpace($rows[0]['birth_day']);
    $birth_year     = AddSpace($rows[0]['birth_year']);
    $probation      = AddSpace($rows[0]['probation_officer']);
    $court_id       = AddSpace($rows[0]['court_id']);
    $hours_need     = AddSpace($rows[0]['hours_need']);
    $country_id     = AddSpace($rows[0]['country_id']);
    $state_id       = AddSpace($rows[0]['state_id']);

    if(intval($birth_day) < 10)
        $birth_day = "0" . $birth_day;

    if(intval($birth_month) < 10)
        $birth_month = "0" . $birth_month;


    function AddSpace($value){
        if($value == "")
            $value = "&nbsp;";

        return $value;
    }



    $display_password_error = "none";
    $display_password_success = "none";

    $error_password_message = "";

    if(isset($_POST['new_password']) && $_POST['new_password'] != '' && isset($_POST['old_password']) && $_POST['old_password'] != ''){
        
        $password     = check_input($_POST['new_password']);
        $old_password = check_input($_POST['old_password']);
                
        $password_hashed = GenerateHashedString($password, '1756');
            
        $query = "SELECT password FROM users WHERE id = " . $user_id;
        
        $rows = QuerySelect($query);
        
        if(is_array($rows)){
            if(count($rows) > 0){
                if(!CheckHashedString($old_password, $rows[0]['password'], '1756')){
                    $error_password_message = "You old password is not correct";
                    $display_password_error = "block";
                }
            }else{
                $error_password_message = "Something went wrong <br />Try again";
                $display_password_error = "block";
            }
        }else{
            $error_password_message = "Something went wrong <br />Try again";
            $display_password_error = "block";
        }
        

        if($display_password_error == "none"){

            $query = "UPDATE users
                        SET  password = '$password_hashed'
                      WHERE  id = " . $user_id;
            
            $rows = QueryInsert($query);
            
            if($rows)
                $display_password_success = "block";
            else{
                $error_password_message = "Something went wrong <br />Try again";
                $display_password_error = "block";
            }
        }
        
    }


    $course_unique_id = "";

    if(isset($_GET["cuid"]) && $_GET["cuid"] != ""){

        $course_unique_id = check_input($_GET['cuid']);

        $course_id = GetID_FromUniqueID($course_unique_id, 'courses');

        if($course_id == 0)
            $course_unique_id = "";
    }

    if($course_unique_id == ""){

        $query = "SELECT c.unique_id 
                  FROM user_courses uc, courses c 
                  WHERE user_id = $user_id AND printed = 0 AND c.id = uc.course_id 
                  ORDER BY last_time_active DESC LIMIT 1";

        $rows = QuerySelect($query);

        if(count($rows) > 0)
            $course_unique_id = $rows[0]["unique_id"];

    }


    $section = "";

    if(isset($_GET["section"]) && $_GET["section"] != "")
        $section = check_input($_GET['section']);
    



    $join       = "";
    $event_id   = "";
    $date       = "";
    $time       = "";
    $event_title= "";
    $event_price= 0;

    if( isset($_GET["id"]) && $_GET["id"] != "" && 
        isset($_GET["d"])  && $_GET["d"]  != "" && 
        isset($_GET["t"])  && $_GET["t"]  != ""){


        $join = "join";

        $event_id   = check_input($_GET["id"]);
        $date       = check_input($_GET["d"]);
        $time       = check_input($_GET["t"]);

        $query = "SELECT title, price FROM scheduled_events WHERE id = $event_id";

        $rows = QuerySelect($query);

        if(count($rows) > 0){
            $event_title = $rows[0]["title"];
            $event_price = $rows[0]["price"];

        }

        OrderJoinEvent();
    }

?>

<!DOCTYPE html>
<html lang="en">

<?=getHeader("Profile");?>

</style>

<style type="text/css">

    .mr-20{
        margin-right: 20px;
    }
    
</style>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars btn-2 "></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>

            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <div class="text-center p-3">
                    <img src="../assets/images/logo.jpg" alt="logo" style="width: 120px;">
                </div>

                <!--  btn-block  active -->
                <a class="nav-link sideli" data-bs-toggle="pill" id="v_pills_account_tab"       href="#v_pills_account" onclick="StopTimers()" 
                    role="tab" aria-selected="false" aria-controls="v_pills_account">Account info</a>
                <a class="nav-link sideli" data-bs-toggle="pill" id="v_pills_courses_tab" href="#v_pills_courses" onclick="StopTimers()" 
                    role="tab" aria-selected="false" aria-controls="v_pills_courses">All Courses</a>
                <a class="nav-link sideli" data-bs-toggle="pill" id="v_pills_active_course_tab" href="#v_pills_active_course" 
                    role="tab" aria-selected="false" aria-controls="v_pills_active_course">Active Course</a>
                <a class="nav-link sideli" data-bs-toggle="pill" id="v_pills_my_courses_tab"    href="#v_pills_my_courses" onclick="StopTimers()" 
                    role="tab" aria-selected="false" aria-controls="v_pills_my_courses">My Courses</a>
                <a class="nav-link sideli" data-bs-toggle="pill" id="v_pills_my_courses_mobile_tab"    href="#v_pills_my_courses_mobile" onclick="StopTimers()" 
                    role="tab" aria-selected="false" aria-controls="v_pills_my_courses_mobile">My Courses Mobile</a>
                <a class="nav-link sideli" href="../pricing" target="_blank" onclick="StopTimers()">Pricing</a>
                <a class="nav-link sideli" data-bs-toggle="pill" id="v_pills_schedule_tab" href="#v_pills_schedule" onclick="StopTimers()" 
                    role="tab" aria-selected="false" aria-controls="v_pills_schedule_tab">Schedule Counse</a>
                <a class="nav-link sideli" data-bs-toggle="pill" id="v_pills_schedule_mobile_tab" href="#v_pills_schedule_mobile" onclick="StopTimers()" 
                    role="tab" aria-selected="false" aria-controls="v_pills_schedule_mobile_tab">Schedule Mobile</a>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-2 p-md-5 pt-5 mb-5">
            <div class="tab-content mb-5" id="v-pills-tabContent">
                
                <?php include('account_info.php');?>

                <?php include('active_course.php');?>

                <?php include('all_courses.php');?>

                <?php include('my_courses.php');?>

                <?php include('my_courses_mobile.php');?>

                <?php include('schedule.php');?>

                <?php include('schedule_mobile.php');?>
              
            </div>
        </div>
    </div>

    <a href="./?j=join" class="bold round-btn2 btn-block main-btn mt-3" id="submit_link" style="display: none">
        Check Out
    </a>

    <form action="./?id=<?=$event_id?>&d=<?=$date?>&t=<?=$time?>&section=schedule" method="POST" id="stripe_form" style="display: none" >
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?=$pk_key?>"
            data-amount=""
            data-name="<?=$event_title?> - $<?=$event_price?>"
            data-currency="USD"
            data-label="<?=$event_title?> - $<?=$event_price?>">
        </script>
    </form>

    <?=getFooter();?>


    <?=PopUpButtons();?>

    
    <?=PopUpKeepAliveButton();?>
    
</body>


<?=getBottomScripts();?>



<script src="../js/user_week_picker.js" ></script>

<script>

    $(function(){

        $('.week-picker').weekpicker();
    });


function SubmitStripeButton(){

    var x = document.getElementsByClassName("stripe-button-el");

    if(x.length > 0)
        x[0].click();
    else
        setTimeout(function(){
            SubmitStripeButton();          
        }, (500));
}

$(document).ready(function() {  

    $('.ui-datepicker-current-day').click();
      
    join = "<?=$join?>";
    date = "<?=$date?>";
    
    payment_success_display = "<?=$payment_success_display?>";
    payment_error_display   = "<?=$payment_error_display?>";

    if(join == "join"){
        window.history.replaceState({}, document.title, "/profile/");
        // window.history.replaceState({}, document.title, "/lawyer/profile/");
        
        document.getElementById("v_pills_schedule_tab").click()
        join_date = '<?=$date?>';
        

        date_split = join_date.split("-");

        join_year   = date_split[0]
        join_month  = date_split[1]
        join_day    = date_split[2]

        new_date = new Date(join_year, join_month, join_day);
        
        // $('#week_picker_id').datepicker("setDate", new Date(join_year, join_month, join_day) );

        if(payment_error_display == "none" && payment_success_display == "none")
            SubmitStripeButton()
    }else{


        course_unique_id = "<?=$course_unique_id?>";
        GetMyCoursesData()
        GetMyCoursesDataMobile()
        
        if(course_unique_id != ""){
            
            GetCourse(course_unique_id);
            $("#active_course_content").show()
            $("#no_active_course_text").hide()

            document.getElementById("v_pills_active_course_tab").click()
            PlayTime()
        }else{
            section = '<?=$section?>'

            if(section == "")
                document.getElementById("v_pills_courses_tab").click()
            else
                document.getElementById("v_pills_" + section + "_tab").click()
        }
    }

    if(payment_error_display == "block"){
        document.getElementById("v_pills_pricing_tab").click()

        PopUpMessage("<?=$payment_error_message?>");
    }

    if(payment_success_display == "block"){

        PopUpMessageSuccess('You have successfully signed up for this event.');
        GetScheduleEventTable(date);
    }
    

    // inactivityTime(); 

    $("#edit_info").hide();
    $("#edit_btn").click(function() {
        $("#profile_info").hide();
        $("#edit_info").show();
        $("#edit_btn").hide();
        $("#cancel").show();

    });
    $("#cancel").click(function() {
        $("#edit_info").hide();
        $("#profile_info").show();
        $("#edit_btn").show();
        $("#cancel").hide();
    });

    state_id = <?=$state_id?>;

    GetStates();
});
$(document).ready(function() {
    $("#password-update").hide();
    $("#cancel_pwd").hide();

    $("#edit_pwd").click(function() {
        $("#password-update").show();
        $("#edit_pwd").hide();
        $("#cancel_pwd").show();

    });
    $("#cancel_pwd").click(function() {
        $("#password-update").hide();
        $("#edit_pwd").show();
        $("#cancel_pwd").hide();
    });
});
</script>

</html>