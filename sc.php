<?php session_start();?>
<?php

require_once './includes/db.php';
require_once './includes/config.php';
require_once './includes/generators.php';

ConnectToDatabase();

$values = GetPageTextValues(1);

?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("Home", "");?>

<body>
    <?=GetHead("");?>
    <?=getNavbar("");?>
    <div class="ms-mobile">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mt-2 mb-2">
                    <div class="card">
                        <div class="p-2">
                            <ul class="lists">
                                <li class="d-flex justify-content-between align-items-start p-1">
                                    <div class="  me-auto">
                                    <div>Total number of courses:</div>
                                    </div>
                                    <span>14</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-start p-1">
                                    <div class="  me-auto">
                                    <div>Total time read:</div>
                                    </div>
                                    <span>14</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-start p-1">
                                    <div class="  me-auto">
                                    <div>Remaining Hours Needed:</div>
                                    </div>
                                    <span>14</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-start p-1">
                                    <div class="  me-auto">
                                    <div>Hours paid:</div>
                                    </div>
                                    <span>14</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr class="mt-3 mb-4">
                </div>

                <div class="d-grid gap-2">
                 <button class="btn btn-bt" type="button">Print your document</button>
                </div>

                <div class="col-sm-12">
                    <h2 class="mt-4">Courses Taken</h2>

                    <div class="card">
                        <div class="p-2">
                        <dl>
                            <dt>Section</dt>
                            <dd>Heroin / Opioids</dd>
                            <dt>Course Name</dt>
                            <dd>Commonly Used Opioid Medications</dd>
                            <dt>Time</dt>
                            <dd>00:00:00</dd>
                            <dt>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                    <label class="form-check-label print-label" for="flexCheckChecked">
                                        Print
                                    </label>
                                </div>
                            </dt>
                            
                        </dl>
                        <div class="d-grid gap-2">
                            <button class="btn btn-bt" type="button">Go to class</button>
                        </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-12">
                    <h2 class="mt-4">Printed the documents</h2>

                    <div class="card">
                        <div class="p-2">
                        <dl>
                            <dt>Document Number</dt>
                            <dd>05656</dd>
                            <dt>Number of Courses</dt>
                            <dd>4</dd>
                            <dt>Total Time</dt>
                            <dd>00:00:00</dd>
                            <dt>Print date</dt>
                            <dd>20.12.2021</dd>
                            <dt>Official Document</dt>
                            <dd>document_name.pdf</dd>
                            <dt>Service Log</dt>
                            <dd>Some service log</dd>
                        </dl>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <?=getFooter("");?>
    <?=getBottomScripts("");?>
</body>


</html>