<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();
$values = GetPageTextValues(7);


    $course_unique_id = "";

    if(isset($_GET["cuid"]) && $_GET["cuid"] != ""){

        $course_unique_id = check_input($_GET['cuid']);

        $course_id = GetID_FromUniqueID($course_unique_id, 'courses');

        if($course_id == 0)
            $course_unique_id = "";
    }

?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("Sample Course");?>

<body class="bg-white">
    <?=GetHead();?>
    <?=getNavbar();?>

    <div class="container-wide mb100 bg-white"> 

        <div class="tab-pane" id="v_pills_courses">
            <div class="container">

                <div class="row">
                    <h2 class="mt-4"><?=$values[0]?></h2>
                    <p>
                    <?=$values[1]?>
                    </p>
                    <hr class="mt-4">

                    <?=GetAllCourses(6)?>

                </div>
            </div>
        </div>


        <div class="tab-pane" id="v_pills_active_course" style="display: none">

            <div class="container">
                <div class="d-flex justify-content-between align-items-center fixedpos mt-4 mb-4">
                    <h3 class="nopd"><b  id="course_name">The Three Branches of Government Part 2</b></h3>
                    <div class="d-flex justify-content-between align-items-center">

                        <button type="button" class="btn black_btn w-300 btn-lg mr-20" style="margin-right: 20px" 
                                onclick="PauseTime(); $('#v_pills_courses').show(); $('#v_pills_active_course').hide()">Go Back To Courses</button>

                        <div class="pause d-flex justify-content-center align-items-center cp-shadow" 
                            id="pause_button" onclick="PauseTime();"><i class="fas fa-pause"></i></div>
                        <div class="start d-flex justify-content-center align-items-center cp-shadow" 
                            id="play_button"  onclick="PlayTimeSample()"><i class="fas fa-play" ></i></div>

                        <div class="timer" id="course_timer" style="width: 160px">HH:MM:SS </div>
                    </div>

                </div>
                <div class="book-reader" id="course_text">

                </div>
            </div>
        </div>


    </div>
    <?=getFooter();?>

    <?=PopUpButtons();?>

    <?=PopUpKeepAliveButton();?>
</body>
<?=getBottomScripts();?>

<script type="text/javascript">

    $(document).ready(function() {
        course_unique_id = "<?=$course_unique_id?>";

        if(course_unique_id != ""){

            GetCourse(course_unique_id);

            $("#v_pills_courses").hide()
            $("#v_pills_active_course").show()
            PlayTimeSample()
        }
    });

</script>

</html>