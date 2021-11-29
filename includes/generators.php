<?php

function getHeader($title = "", $dot = "."){

    $get_html = '
                <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $title . '</title>
                <link rel="stylesheet" href="' . $dot . './assets/css/bootstrap.css">
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
                <link rel="stylesheet" href="' . $dot . './assets/css/main.css">
                <link rel="stylesheet" href="' . $dot . './assets/css/table.css">
                <link rel="stylesheet" href="' . $dot . './assets/css/normalize.css">
                <link rel="stylesheet" href="' . $dot . './assets/css/all.min.css">
                <link rel="icon" type="image/png" sizes="32x32" href="' . $dot . './assets/images/favicon/favicon-32x32.png">


                <script src="' . $dot . './assets/js/app.js"></script>
                <script src="' . $dot . './assets/js/all.min.js"></script>

            </head>';

    return $get_html;
}

function GetHeaderSummernote($title = "", $dot = "."){

    $get_html = '
                <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $title . '</title>
                <link rel="stylesheet" href="' . $dot . './assets/css/bootstrap.css">
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
                <link rel="stylesheet" href="' . $dot . './assets/css/main.css">
                <link rel="stylesheet" href="' . $dot . './assets/css/table.css">
                <link rel="stylesheet" href="' . $dot . './assets/css/normalize.css">
                <link rel="stylesheet" href="' . $dot . './assets/css/all.min.css">
                <link rel="icon" type="image/png" sizes="32x32" href="' . $dot . './assets/images/favicon/favicon-32x32.png">



                <script src="' . $dot . './assets/js/app.js"></script>
                <script src="' . $dot . './assets/js/all.min.js"></script>


<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

            </head>';

    return $get_html;


}


function GetHead($dot = "."){

    $get_html = '
                <header class="d-flex justify-content-between align-items-center ">
                    <div class="container d-flex justify-content-between align-items-center mbo-header">
                        <div class="logo"><a href="' . $dot . './"><img src="' . $dot . './assets/images/logo.jpg" alt="Logo" style="height: 35px; margin-right:15px;"></a><span class="ml-5">EIN: 80-0946765</span></div>
                        <div class="search d-flex justify-content-between align-items-center mbo-header">
                            <div class="form-group">
                                Validate Document: <input type="text" class="form-bordered" id="search_validate">
                            </div>
                            
                            <ul class="navbar-nav flex-row ms-md-auto">
                                <li class="nav-item ">
                                    <a class="nav-link p-2 bluetxt" href="https://github.com/twbs" target="_blank" rel="noopener">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-2 bluetxt" href="https://twitter.com/getbootstrap" target="_blank"
                                        rel="noopener">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-2 bluetxt" href="https://bootstrap-slack.herokuapp.com/" target="_blank"
                                        rel="noopener">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item">

                                </li>
                            </ul>
                        </div>
                    </div>
                </header>';

    return $get_html;
}

function getNavbar($dot = '.'){

    $loged_in = isLogedIn();

    $get_html = '<nav class="navbar navbar-expand-xl  navbar-light bg-blue">
                    <div class="container">
                        <button class="navbar-toggler border-white" type="button co-white" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class=""><i class="fas fa-bars co-white"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto flex-nowrap">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="' . $dot . './">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a type="button" role="button" class="nav-link dropdown-toggle" id="dropdown01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Programs</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown01" data-bs-popper="none">
                                        ' . GetStaticPagesLinks($dot) . '
                                    </div>
                                    </li>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="' . $dot . './about">About us</a>
                                </li>';

        
        $sample_course_link = $dot . './sample-course';

        if($loged_in)
            $sample_course_link = $dot . './profile';


        $get_html .= '         
                        
                                <li class="nav-item">
                                    <a class="nav-link" href="' . $dot . './contact">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="' . $dot . './validate">Validate Document</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a type="button" role="button" class="nav-link dropdown-toggle" id="dropdown02" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Services</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown02" data-bs-popper="none">
                                        <div class="dropdown dropend">
                                            <a class="dropdown-item dropdown-toggle" href="#" id="dropdown-layouts" data-bs-toggle="dropdown" 
                                                      aria-haspopup="true" aria-expanded="true" style="padding-right:20px">
                                                      Online Community Service</a>
                                            <div class="dropdown-menu " aria-labelledby="dropdown-layouts" data-bs-popper="none">
                                                <a class="dropdown-item" href="' . $dot . './how-it-works">How it Works</a>
                                                <a class="dropdown-item" href="' . $dot . './pricing">Pricing</a>
                                                <a class="dropdown-item" href="' . $sample_course_link . '">Sample Course</a>
                                                <a class="dropdown-item" href="' . $dot . './register">Sign-Up</a>
                                                <a class="dropdown-item" href="' . $dot . './faq-service">FAQ Service</a>

                                            </div>
                                        </div>
                                        <div class="dropdown dropend">
                                            <a class="dropdown-item dropdown-toggle" href="#" id="dropdown-layouts" data-bs-toggle="dropdown" 
                                                      aria-haspopup="true" aria-expanded="true" style="padding-right:20px">
                                                      Web-Based Counsel</a>
                                            <div class="dropdown-menu " aria-labelledby="dropdown-layouts" data-bs-popper="none">
                                                <a class="dropdown-item" href="' . $dot . './how-it-works-web">How it Works</a>
                                                <a class="dropdown-item" href="' . $dot . './faq">FAQ</a>
                                                <a class="dropdown-item" href="' . $dot . './profile?section=schedule">Schedule</a>

                                            </div>
                                        </div>

                                        <div class="dropdown dropend">
                                            <a class="dropdown-item dropdown-toggle" href="#" id="dropdown-layouts" data-bs-toggle="dropdown" 
                                                      aria-haspopup="true" aria-expanded="true" style="padding-right:20px">
                                                      Assessment</a>
                                            <div class="dropdown-menu " aria-labelledby="dropdown-layouts" data-bs-popper="none">
                                                <a class="dropdown-item" href="' . $dot . './how-it-works-assessment">How it Works</a>
                                                <a class="dropdown-item" href="' . $dot . './faq-assessment">FAQ</a>
                                                <a class="dropdown-item" href="' . $dot . './profile?section=schedule">Schedule</a>

                                            </div>
                                        </div>
                                    </div>
                                    </li>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="' . $dot . './donations">Donations</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ms-auto flex-nowrap">';
        

    if($loged_in)
        $get_html .= '          <li class="nav-item">
                                    <a class="nav-link" href="' . $dot . './profile">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="' . $dot . './logout.php">Log out</a>
                                </li>';
    else
        $get_html .= '          <li class="nav-item">
                                    <a class="nav-link" href="' . $dot . './login">Login</a>
                                </li>';


    $get_html .= '          </ul>
                        </div>
                    </div>
                </nav>';

    return $get_html;
}

function GetStaticPagesLinks($dot = "."){

    $query = "SELECT page_name, unique_id FROM static_pages WHERE page_status = 'Public' ORDER BY page_name";

    $rows = QuerySelect($query);

    $return_html = '';

    for($i = 0; $i < count($rows); $i++)
        $return_html .= '<a class="dropdown-item" href="' . $dot . './page/?uid=' . $rows[$i]["unique_id"] . '">' . $rows[$i]["page_name"] . '</a>';
    
    return $return_html;
}

function GetEditHeader($title, $page_id){
    $get_html = '<nav class="navbar navbar-dark bg-dark bg-light">
                    <div class="container-xl d-flex justify-content-between">
                        <h4 class="text-white">' . $title . ' - page edit</h4>
                        <form class="form-inline my-2 my-lg-0">
                            <button class="btn btn-light" type="button">Cancel</button>
                            <button class="btn btn-light" type="button" 
                                onclick="SaveEditPage(' . $page_id . ')">Save</button>
                        </form>
                    </div>
                </nav>';

    return $get_html;
}

function getFooter($dot = '.'){

    $get_html = '<footer class="footer">
                    <div class="container">
                        <ul class="list-inline bottom-zero">
                            <li class="list-inline-item"><a href="' . $dot . './terms">Terms of Service</a></li>
                            <li class="list-inline-item"><a href="' . $dot . './policy">Privacy Policy</a></li>
                            <li class="list-inline-item"> Copyright© Lawyer ' . date("Y") . ' </li>
                        </ul>
                    </div>
                </footer>';

    return $get_html;
}

function getBottomScripts($dot = '.'){

    $get_html = '<script src="' . $dot . './assets/js/bootstrap.bundle.min.js"></script>

                 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                 <script src="' . $dot . './assets/js/main.js"></script>

                 <script src="' . $dot . './js/script.js"></script>


                 <link rel="stylesheet" href="' . $dot . './js/jquery-ui-1.12.1.custom/jquery-ui.css">


                 <script src="' . $dot . './js/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
                 <script src="' . $dot . './js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
                 
                 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
                 <script>
                    $(document).ready(function() {
                        $(".js-example-basic-single").select2();
                    });
                 </script>';

    return $get_html;
}



function PopUpButtons(){

    return '<!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                    data-bs-target="#popup_modal_message_success_div" id="popup_modal_button_success"  style="display:none">
              Launch demo modal
            </button>
            <!-- Modal -->
            <div class="modal fade" id="popup_modal_message_success_div" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                    <p class="mt-4" id="popup_modal_message_success">Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                </div>
              </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                    data-bs-target="#popup_modal_message_error_div" id="popup_modal_button_error" style="display:none">
              Launch demo modal
            </button>
            <!-- Modal -->
            <div class="modal fade" id="popup_modal_message_error_div" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                    <p class="mt-4" id="popup_modal_message_error">Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                </div>
              </div>
            </div>';
}

function PopUpKeepAliveButton(){

    return '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#keep_alive_box" id="keep_alive_button" style="display: none">
                    Launch modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="keep_alive_box" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Keep alive</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="keep_alive_close"></button>
                        </div>
                        <div class="modal-body">
                            You have been passive for 3 minutes. Please confirm that you are active so you can continue reading.
                            <br /><br />
                            If you don\'t confirm in 15 seconds your timer will be stopped and you will be redirected to the section "All Courses"
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-default black_btn_outline" data-bs-dismiss="modal">Close</button> -->
                            <button type="button" class="btn black_btn" id="keep_alive_confirm" onclick="KeepAliveConfirm()">Confiirm</button>
                        </div>
                    </div>
                </div>
            </div>';
}

function GetContries($country_id = 0){

    $rows = GetData('country', 'printable_name');

    $return_string = '<select class="js-example-basic-single form-control" name="country" id="country" onChange="GetStates()"  style="width: 100%">
                        <option value="0" disabled="">Select Country</option>';

    for($i = 0; $i < count($rows); $i++)
        if($country_id == intval($rows[$i]["id"]))
            $return_string .= '<option value="' . $rows[$i]['id'] . '" selected>' . $rows[$i]['value'] . '</option>';
        else
            $return_string .= '<option value="' . $rows[$i]['id'] . '">' . $rows[$i]['value'] . '</option>';

    

    $return_string .= '</select>';
    
    return $return_string;
}

function GetStatesSelect($country_id, $state_id = 0){

    $rows = GetStates($country_id);

    $return_string = '<option value="0" disabled="">Select State/Province</option>';

    for($i = 0; $i < count($rows); $i++)
        if($state_id == intval($rows[$i]["id"]))
            $return_string .= '<option value="' . $rows[$i]['id'] . '" selected>' . $rows[$i]['value'] . '</option>';
        else
            $return_string .= '<option value="' . $rows[$i]['id'] . '">' . $rows[$i]['value'] . '</option>';
    

    return $return_string;
}

function GetAllCourses($course_theme_id = 0){

    $where = "";

    if($course_theme_id > 0)
        $where = " AND course_theme_id = 6 ";

    $query = "SELECT unique_id, course_theme_id, theme_name, course_name, number_of_courses, order_number
              FROM courses c, course_themes ct 
              WHERE ct.id = course_theme_id AND course_status = 'Active' $where
              ORDER BY course_theme_id, order_number ASC";

    $rows = QuerySelect($query);

    $current_theme = "";
    $current_number_of_course = 0;

    $sections = [[], [], []];

    $prev_theme_number_of_courses = 0;

    $openning_div = '<div class="col-sm-4">
                        <ul class="list-unstyled">
                            <li>
                                <ul>';

    $closing_div  = '           </ul>
                            </li>
                        </ul>
                    </div>';


    $html = '';

    for($i = 0; $i < count($rows); $i++){

        if($current_theme != $rows[$i]["theme_name"]){

            if($current_theme != ""){

                if($prev_theme_number_of_courses > 2)
                    $sections[2] .= $closing_div;
                else
                    $sections[2] = '';

                if($prev_theme_number_of_courses > 1)
                    $sections[1] .= $closing_div;
                else
                    $sections[1] = '';

                $sections[0] .= $closing_div;

                $html .= $sections[0] . $sections[1] . $sections[2];
            }

            $current_number_of_course = 0;

            $prev_theme_number_of_courses = intval($rows[$i]["number_of_courses"]);
            $section_1_number_of_courses = ceil($prev_theme_number_of_courses / 3);
            $section_2_number_of_courses = $section_1_number_of_courses + round($prev_theme_number_of_courses / 3);

            $current_theme = $rows[$i]["theme_name"];
            $html .= '<h5 class="mb-4 mt-4">' . $current_theme . '</h5>';

            $sections[0] = $openning_div;
            $sections[1] = $openning_div;
            $sections[2] = $openning_div;
        }

        $temp_id = 2;

        if($section_1_number_of_courses > $current_number_of_course)
            $temp_id = 0;
        else if($section_2_number_of_courses > $current_number_of_course)
            $temp_id = 1;

        $sections[$temp_id] .= '<li><a href="?cuid=' . $rows[$i]['unique_id'] . '">' . $rows[$i]['course_name'] . '</a></li>';

        $current_number_of_course++;
    }

    if(count($rows) > 0){
        if($prev_theme_number_of_courses > 2)
            $sections[2] .= $closing_div;
        else
            $sections[2] = '';

        if($prev_theme_number_of_courses > 1)
            $sections[1] .= $closing_div;
        else
            $sections[1] = '';

        $sections[0] .= $closing_div;

        $html .= $sections[0] . $sections[1] . $sections[2];
    }

    return $html;
}


function GetMyCoursesTable($user_id){

    $query = "SELECT active_time_seconds, course_name, theme_name, unique_id
              FROM user_courses uc, courses c, course_themes ct
              WHERE user_id = $user_id AND uc.course_id  = c.id AND c.course_theme_id = ct.id AND printed = 0";

    $rows = QuerySelect($query);

    $html = "";

    for($i = 0; $i < count($rows); $i++)
        $html .= '<tr>
                    <th scope="row"  style="padding-top:  15px;">
                        <input class="form-check-input" type="checkbox" name="select_course_cb"
                               value="' . $rows[$i]["unique_id"] . '##' . $rows[$i]["active_time_seconds"] . '">
                    </th>
                    <td style="padding-top:  15px;">' . $rows[$i]["theme_name"] . '</td>
                    <td style="padding-top:  15px;">' . $rows[$i]["course_name"] . '</td>
                    <td style="padding-top:  15px;">' . FromSecondsToTime(intval($rows[$i]["active_time_seconds"])) . '</td>
                    <td><a href="./?cuid=' . $rows[$i]["unique_id"] . '" type="button" class="btn black_btn_outline">Go to class</a></td>
                  </tr>';

    return $html;
}


function GetMyCoursesTableMobile($user_id){

    $query = "SELECT active_time_seconds, course_name, theme_name, unique_id
              FROM user_courses uc, courses c, course_themes ct
              WHERE user_id = $user_id AND uc.course_id  = c.id AND c.course_theme_id = ct.id AND printed = 0";

    $rows = QuerySelect($query);

    $html = "";

    for($i = 0; $i < count($rows); $i++)
        $html .= '<div class="card">
                    <div class="p-2">
                    <dl>
                        <dt>Section</dt>
                        <dd>' . $rows[$i]["theme_name"] . '</dd>
                        <dt>Course Name</dt>
                        <dd>' . $rows[$i]["course_name"] . '</dd>
                        <dt>Time</dt>
                        <dd>' . FromSecondsToTime(intval($rows[$i]["active_time_seconds"])) . '</dd>
                        <dt>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="' . $rows[$i]["unique_id"] . '##' . $rows[$i]["active_time_seconds"] . '" id="flexCheckChecked" checked>
                                <label class="form-check-label print-label" for="flexCheckChecked">
                                    Print
                                </label>
                            </div>
                        </dt>
                    </dl>
                    <div class="d-grid gap-2">
                        <a href="./?cuid=' . $rows[$i]["unique_id"] . '" type="button" class="btn black_btn_outline">Go to class</a>
                    </div>
                    </div>
                </div>';

                  

    return $html;
}


function GetMyPrintedCoursesTable($user_id){

    $query = "SELECT total_time_seconds, number_of_courses, DATE(printed_datetime) AS printed_datetime, unique_id
              FROM printed_documents
              WHERE user_id = $user_id
              ORDER BY printed_datetime DESC";

    $rows = QuerySelect($query);

    $html = "";

    for($i = 0; $i < count($rows); $i++)
        $html .= '<tr>
                    <td style="padding-top:  15px;">' . $rows[$i]["unique_id"] . '</td>
                    <td style="padding-top:  15px;">' . $rows[$i]["number_of_courses"] . '</td>
                    <td style="padding-top:  15px;">' . FromSecondsToTime(intval($rows[$i]["total_time_seconds"])) . '</td>
                    <td style="padding-top:  15px;">' . ChangeDateFormatPublicAmerican($rows[$i]["printed_datetime"]) . '</td>
                    <td><a  href="../official-document/?uid=' . $rows[$i]["unique_id"] . '" target="_blank" 
                            type="button" class="btn black_btn_outline">Official Document</a></td>
                    <td><a href="../service-log/?uid=' . $rows[$i]["unique_id"] . '" target="_blank" type="button" class="btn black_btn_outline">Service Log</a></td>
                  </tr>';

    return $html;
}




function GetMyPrintedCoursesTableMobile($user_id){

    $query = "SELECT total_time_seconds, number_of_courses, DATE(printed_datetime) AS printed_datetime, unique_id
              FROM printed_documents
              WHERE user_id = $user_id
              ORDER BY printed_datetime DESC";

    $rows = QuerySelect($query);

    $html = "";

    for($i = 0; $i < count($rows); $i++)
        $html .= '<div class="card">
                    <div class="p-2">
                    <dl>
                        <dt>Document Number</dt>
                        <dd>' . $rows[$i]["unique_id"] . '</dd>
                        <dt>Number of Courses</dt>
                        <dd>' . $rows[$i]["number_of_courses"] . '</dd>
                        <dt>Total Time</dt>
                        <dd>' . FromSecondsToTime(intval($rows[$i]["total_time_seconds"])) . '</dd>
                        <dt>Print date</dt>
                        <dd>' . ChangeDateFormatPublicAmerican($rows[$i]["printed_datetime"]) . '</dd>
                        <dt>Official Document</dt>
                        <dd><a  href="../official-document/?uid=' . $rows[$i]["unique_id"] . '" target="_blank" 
                        type="button" class="btn black_btn_outline">Official Document</a></dd>
                        <dt>Service Log</dt>
                        <dd><a href="../service-log/?uid=' . $rows[$i]["unique_id"] . '" target="_blank" type="button" class="btn black_btn_outline">Service Log</a></dd>
                    </dl>
                    </div>
                </div>';

    return $html;
}

function GetDonationsDB($donation_id = "", $static_page_id = ""){

    $where = " donation_status = 'Active'";

    if($donation_id != "")
        $where .= " AND d.id = $donation_id";

    if($static_page_id != "")
        $where .= " AND static_page_id = $static_page_id";

    $query = "SELECT d.id, d.unique_id, d.content, st.unique_id AS static_page_unique_id
              FROM donations d
              LEFT JOIN static_pages st
              ON d.static_page_id = st.id
              WHERE $where";

    $rows = QuerySelect($query);

    return $rows;
}

function GetAllDonationsContent(){

    $rows = GetDonationsDB();

    $html = '';

    for($i = 0; $i < count($rows); $i++)
        $html .= GenerateDonationContent($rows[$i]);

    return $html;
}

function GenerateDonationContent($row, $static_page_unique_id = ""){

    $donate_function = 'Donate(\'' . $row["unique_id"] . '\')';

    if($static_page_unique_id != "")
        $donate_function = 'DonateStaticPage(\'' . $row["unique_id"] . '\', \'' . $static_page_unique_id . '\')';

    $html = '<div class="container" id="donate_container_' . $row["unique_id"] . '">
                <div class="donations">
                    <div class="container">
                        <div class="row">
                            <p>' . $row["content"] . '</p>
                            <div class="donation-body d-flex justify-content-center">
                                <div class="input-group input-25 mb-3  ">
                                <div class="input-group-text">$</div>
                                    <input  type="text" class="form-control contact-in" name="donation_price"
                                        id="donation_' . $row["unique_id"] . '">
                                    <button class="btn btn-outline-secondary black_btn" type="button" 
                                        onClick="' . $donate_function . '">Donate</button>
                                </div>
                            </div>';

    if($row["static_page_unique_id"] != "")
        $html .=           '<p class="text-center mt-3"><a href="../page?uid=' . $row["static_page_unique_id"] . '">Read More</a></p>';

    $html .=           '</div>
                    </div>
                </div> 
            </div>';

    return $html;
}
