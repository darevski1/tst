<?php
require_once "./includes/generators.php";
?>
<!DOCTYPE html>
<html lang="en">
<?=GetHeader("Admin page", "");?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?=getSideNavigation("");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?=GetTopNavigation("");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

                    <div class="d-flex justify-content-center row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>Mark</td>
                                    <td>
                                        <select class="form-control" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck"></label>
                                        </div>
                                    </td>
                                    <td><button type="button" id="edit" data-value="1"
                                            class="btn btn-primary">Primary</button></td>
                                </tr>
                                <tr class="spanedit" dataid="1">
                                    <td colspan="8">
                                        <div class="col-md-7 col-sm-12 border-style">
                                            <form class="user p-5 " class="bg-gray-100">
                                                <div class="form-group">
                                                    <label for="text">Text:</label>

                                                    <input type="email" class="form-control" id="exampleInputEmail"
                                                        aria-describedby="emailHelp"
                                                        placeholder="Enter Email Address...">
                                                </div>
                                                <div class="form-group">
                                                    <label for="text">Text:</label>
                                                    <input type="password" class="form-control"
                                                        id="exampleInputPassword" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="text">Text:</label>

                                                    <select class="form-control" aria-label="Default select example">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                                <div class="bd-example">
                                                    <button class="btn btn-success" type="button">Button</button>
                                                    <button class="btn btn-primary" type="button">Button</button>
                                                    <button class="btn btn-danger" type="button">Button</button>

                                                </div>

                                                <hr>

                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?=GetFooterScripts("")?>


</body>

</html>