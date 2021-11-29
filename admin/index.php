<?php session_start(); ?>
<?php
require_once('../includes/config.php');
require_once('../includes/db.php');
require_once('./includes/generators.php');

require_once('./includes/users.php');
require_once('./includes/courses.php');
require_once('./includes/course_sections.php');
require_once('./includes/printed_documents.php');
require_once('./includes/edit_pages.php');
require_once('./includes/schedules_page.php');
require_once('./includes/scheduled_event_details.php');
require_once('./includes/static_pages.php');
require_once('./includes/edit_documents.php');
require_once('./includes/accounting.php');
require_once('./includes/donations.php');

ConnectToDatabase();

$table   = 'admins';
$user_id = 'admin_id';

$page_name = "admin";

$loged_in = isLogedIn($table, $user_id);


if(!$loged_in){ 
    ?>
        <script type="text/javascript">
            window.location.replace("./login");
        </script>               
    <?php
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<?=GetHeader("Admin page", "");?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./" style="background-color: #FFF">
                <div class="sidebar-brand-text mx-3"><img src="./assets/img/logo_oakland.png" alt="logo" style="width:120px;"></div>
            </a>


            <!-- SECTIONS -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_users" onclick="ChangeSideMenu('users')">
                <a class="nav-link" style="pointer-events:none"><span>Users</span></a>
            </li>

            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_course_sections" onclick="ChangeSideMenu('course_sections')">
                <a class="nav-link" style="pointer-events:none"><span>Course Sections</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_courses" onclick="ChangeSideMenu('courses')">
                <a class="nav-link" style="pointer-events:none"><span>Courses</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_printed_documents" onclick="ChangeSideMenu('printed_documents')">
                <a class="nav-link" style="pointer-events:none"><span>Printed Documents</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_edit_pages" onclick="ChangeSideMenu('edit_pages')">
                <a class="nav-link" style="pointer-events:none"><span>Edit Pages</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_static_pages" onclick="ChangeSideMenu('static_pages')">
                <a class="nav-link" style="pointer-events:none"><span>Static Pages</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_schedules" onclick="ChangeSideMenu('schedules')">
                <a class="nav-link" style="pointer-events:none"><span>Schedule Events</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_event_details" onclick="ChangeSideMenu('event_details')">
                <a class="nav-link" style="pointer-events:none"><span>Event Details</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_edit_documents" onclick="ChangeSideMenu('edit_documents')">
                <a class="nav-link" style="pointer-events:none"><span>Edit Documents</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_accounting" onclick="ChangeSideMenu('accounting')">
                <a class="nav-link" style="pointer-events:none"><span>Accounting</span></a>
            </li>
            <li class="nav-item admin_side_menu" style="cursor: pointer;" id="side_menu_donations" onclick="ChangeSideMenu('donations')">
                <a class="nav-link" style="pointer-events:none"><span>Donations</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?=GetTopNavigation($loged_in, "");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?=GetUsersPage()?>
                <?=GetCourseSectionsPage()?>
                <?=GetCoursesPage()?>
                <?=GetPrintedDocumentsPage()?>
                <?=GetEditPagesPage()?>
                <?=GetSchedulesPage()?>   
                <?=GetEventDetailsPage()?>    
                <?=GetStaticPagesPage()?>     
                <?=GetEditDocumentsPage()?>      
                <?=GetAccountingPage()?>     
                <?=GetDonationPage()?>   

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?=GetFooter("");?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


<?=PopUpButtonsAdmin()?>

<?=GetFooterScripts()?>

</body>

<script src="../js/admin_week_picker.js" ></script>
<script src="./accounting.js" ></script>


<script type="text/javascript">

    $(function(){

        $('.week-picker').weekpicker();
    });
</script>

  <script type="text/javascript">
      ChangeSideMenu('accounting');

      for(i = 1; i <= 7; i++)
        CalculateRowTable_2(2, 6, i, false);

  </script>


</html>