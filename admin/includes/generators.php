<?php

function GetHeader($title = "", $dot = "."){

    $return_html = '<head>
                        <meta charset="utf-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        <meta name="description" content="">
                        <meta name="author" content="">
                        <title>' . $title . '</title>
                        <!-- Custom fonts for this template-->
                        <link href="' . $dot . './assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
                        <link
                            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                            rel="stylesheet">

                        <!-- Custom styles for this template-->
                        <link href="' . $dot . './assets/css/sb-admin-2.css" rel="stylesheet">
                        <link href="' . $dot . './assets/css/custom.css" rel="stylesheet">
                        <link href="' . $dot . './../assets/css/table.css" rel="stylesheet">

                        


                        <link rel="apple-touch-icon" sizes="57x57" href="' . $dot . './../assets/images/favicon/apple-icon-57x57.png">
                        <link rel="apple-touch-icon" sizes="60x60" href="' . $dot . './../assets/images/favicon/apple-icon-60x60.png">
                        <link rel="apple-touch-icon" sizes="72x72" href="' . $dot . './../assets/images/favicon/apple-icon-72x72.png">
                        <link rel="apple-touch-icon" sizes="76x76" href="' . $dot . './../assets/images/favicon/apple-icon-76x76.png">
                        <link rel="apple-touch-icon" sizes="114x114" href="' . $dot . './../assets/images/favicon/apple-icon-114x114.png">
                        <link rel="apple-touch-icon" sizes="120x120" href="' . $dot . './../assets/images/favicon/apple-icon-120x120.png">
                        <link rel="apple-touch-icon" sizes="144x144" href="' . $dot . './../assets/images/favicon/apple-icon-144x144.png">
                        <link rel="apple-touch-icon" sizes="152x152" href="' . $dot . './../assets/images/favicon/apple-icon-152x152.png">
                        <link rel="apple-touch-icon" sizes="180x180" href="' . $dot . './../assets/images/favicon/apple-icon-180x180.png">
                        <link rel="icon" type="image/png" sizes="192x192"  href="' . $dot . './../../assets/images/favicon/android-icon-192x192.png">
                        <link rel="icon" type="image/png" sizes="32x32" href="' . $dot . './../assets/images/favicon/favicon-32x32.png">
                        <link rel="icon" type="image/png" sizes="96x96" href="' . $dot . './../assets/images/favicon/favicon-96x96.png">
                        <link rel="icon" type="image/png" sizes="16x16" href="' . $dot . './../assets/images/favicon/favicon-16x16.png">
                        <link rel="manifest" href="/manifest.json">
                        <meta name="msapplication-TileColor" content="#ffffff">
                        <meta name="msapplication-TileImage" content="' . $dot . './../assets/images/favicon/ms-icon-144x144.png">
                        <meta name="theme-color" content="#ffffff">
                    </head> ';

    return $return_html;

}

function getSideNavigation($dot = "."){

    $return_html = '<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                        <!-- Sidebar - Brand -->
                        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="' . $dot . './">
                            <div class="sidebar-brand-text mx-3">Ziprenovation</div>
                        </a>

                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">

                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link" style="pointer-events:none">
                                <span>Dashboard</span></a>
                        </li>

                        <!-- Divider -->
                        <hr class="sidebar-divider d-none d-md-block">

                        <!-- Sidebar Toggler (Sidebar) -->
                        <div class="text-center d-none d-md-inline">
                            <button class="rounded-circle border-0" id="sidebarToggle"></button>
                        </div>

                    </ul>';

    return $return_html;
}

function GetTopNavigation($username, $dot = "."){

    $return_html = '<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <ul class="navbar-nav ml-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">' . $username . '</span>
                                    <img class="img-profile rounded-circle" src="' . $dot . './assets/img/undraw_profile.svg">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="' . $dot . './logout.php" >
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>';

    return $return_html;
}

function GetFooter($dot = "."){

    $return_html = '<footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Your Website 2020</span>
                            </div>
                        </div>
                    </footer>';

    return $return_html;
}

function GetFooterScripts($dot = "", $dot2 = ""){

    $return_html = '<script src="' . $dot . './assets/vendor/jquery/jquery.min.js"></script>
                    <script src="' . $dot . './assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="' . $dot . './assets/vendor/jquery-easing/jquery.easing.min.js"></script>
                    <script src="' . $dot . './assets/js/sb-admin-2.min.js"></script>

                    <link rel="stylesheet" href="' . $dot2 . '../js/jquery-ui-1.12.1.custom/jquery-ui.css">
                    <script src="' . $dot2 . '../js/admin.js"></script>                    
                    <script src="' . $dot2 . '../js/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
                    <script src="' . $dot2 . '../js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
                    ';
  
    return $return_html;
}





function PopUpButtonsAdmin(){

    return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popup_modal_error_admin" 
                    id="popup_modal_button_error_admin" style="display: none">
                Popup Button
            </button>
            <!-- Modal -->
            <div class="modal fade" id="popup_modal_error_admin" tabindex="-1" aria-labelledby="Popup Modal Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span id="popup_modal_message_error_admin"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
            </div>


            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popup_modal_success_admin" 
                    id="popup_modal_button_success_admin" style="display: none">
                Popup Button
            </button>
            <!-- Modal -->
            <div class="modal fade" id="popup_modal_success_admin" tabindex="-1" aria-labelledby="Popup Modal Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span id="popup_modal_message_success_admin"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
            </div>';

}




function GetFilters($section = "dashboard"){

    $style = '';

    if($section == "dashboard")
        $style = ' style="margin-left:0px"';

    $return_html = '<div class="row" ' . $style . '>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
                            </div>
                            <div class="card-body">
                                <form class="form-inline" onsubmit="return false">';

    if($section == "users")
        $return_html .= '           <div class="form-group mx-sm-3 mb-2">
                                        <select class="form-control" id="' . $section . '_search_field">
                                            <option value="">Column</option>
                                            <option value="username">Username</option>
                                            <option value="email">Email</option>
                                            <option value="phone">Phone</option>
                                        </select>
                                    </div>';

    else if($section == "printed_documents")
        $return_html .= '           <div class="form-group mx-sm-3 mb-2">
                                        <select class="form-control" id="' . $section . '_search_field">
                                            <option value="">Column</option>
                                            <option value="pd.unique_id">Document Number</option>
                                            <option value="username">Name</option>
                                        </select>
                                    </div>';

    else if($section == "contactus")
        $return_html .= '           <div class="form-group mx-sm-3 mb-2">
                                        <select class="form-control" id="' . $section . '_search_field">
                                            <option value="">Column</option>
                                            <option value="name">Name</option>
                                            <option value="email">Email</option>
                                        </select>
                                    </div>';
                                    
    $return_html .= '               <div class="form-group mx-sm-3 mb-2">
                                        <input type="text" class="form-control" id="' . $section . '_search_value" autocomplete="off" placeholder="Search">
                                    </div>';

    $return_html .= '               <div class="form-group mx-sm-3 mb-2">
                                        <input type="text" class="form-control datepicker" id="' . $section . '_date_from" 
                                            autocomplete="off" placeholder="Date From" style="width: 120px">
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <input type="text" class="form-control datepicker" id="' . $section . '_date_to" 
                                            autocomplete="off" placeholder="Date To" style="width: 120px">
                                    </div>
                                    <button type="button" class="btn btn-primary mb-2" onclick="ApplyFilters(\'' . $section . '\')">Apply</button>
                                </form>
                            </div>
                        </div>
                    </div>';

    return $return_html;

}


