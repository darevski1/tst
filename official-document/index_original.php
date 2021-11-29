<?php
    

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';
require_once '../vendor/autoload.php';



ConnectToDatabase();

    $print_unique_id = "";
    $print_id = 0;

    if(isset($_GET["uid"]) && $_GET["uid"] != ""){

        $print_unique_id = check_input($_GET['uid']);

        $print_id = GetID_FromUniqueID($print_unique_id, "printed_documents");

    }else{
        exit();
    }


    if($print_id > 0){

        $query = "SELECT CONCAT(first_name, ' ', last_name) AS username, probation_officer, court_id, pd.unique_id, 
                         CONCAT(street_adress, ', ', city, ', ', city, IF(state IS NULL, '', CONCAT(', ', state)), ', ', country) AS address, 
                        (SELECT DATE(first_time_taken) 
                            FROM user_courses uc, printed_courses pc 
                            WHERE pc.print_id = pd.id AND pc.user_course_id = uc.id 
                            ORDER BY first_time_taken ASC LIMIT 1) AS start_date,
                        (SELECT DATE(last_time_active) 
                            FROM user_courses uc, printed_courses pc 
                            WHERE pc.print_id = pd.id AND pc.user_course_id = uc.id 
                            ORDER BY last_time_active ASC LIMIT 1) AS completition_date,
                        (SELECT COUNT(course_id) FROM printed_courses pc WHERE pc.print_id = pd.id) AS number_of_courses,
                        (SELECT SUM(active_time_seconds) 
                            FROM user_courses uc, printed_courses pc 
                            WHERE pc.print_id = pd.id AND pc.user_course_id = uc.id) AS active_time_seconds
                  FROM users u, printed_documents pd
                  WHERE pd.id = $print_id AND pd.user_id = u.id";

        $rows = QuerySelect($query);

        $pdf_html = '<!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Official Document</title>

                        <link rel="stylesheet" href="../assets/css/bootstrap.css">
                        <link rel="stylesheet" href="../assets/css/main.css">
                        <link rel="stylesheet" href="../assets/css/normalize.css">
                        <link rel="stylesheet" href="../assets/css/all.min.css">

                        <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon/favicon-32x32.png">
                        <link rel="preconnect" href="https://fonts.gstatic.com">
                        <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@1,700&display=swap" rel="stylesheet">
                        <link rel="manifest" href="/site.webmanifest">

                        <script src="../assets/js/app.js"></script>
                        <script src="../assets/js/all.min.js"></script>

                    </head>

                    <body style="background: #ffffff;">


                        <div class="document pb-5 pt-5">
                            <div class="container-document">
                                <h1 class="text-center">OAKLAND ASSISTANCE CHAPTER</h1>
                                <h5 class="text-center"><u>Community Service Statement of Completion</u></h5>
                                <div class="row mt-5">
                                    <div class="col-sm-3">
                                        <img src="./../assets/images/logo_document.jpg" style="width:300px" alt="">
                                    </div>
                                    <div class="col-sm-9 pds">
                                        <table class="table-document">
                                            <tbody>
                                                <tr>
                                                    <td>Client Worker:</td>
                                                    <td>' . $rows[0]['username'] . '</td>
                                                    <td>Current Address:</td>
                                                    <td>' . $rows[0]['address'] . '</td>
                                                </tr>
                                                <tr>
                                                    <td>Start Date:</td>
                                                    <td>' . ChangeDateFormatPublicAmerican($rows[0]['start_date']) . '</td>
                                                    <td>Probation Officer:</td>
                                                    <td>' . $rows[0]['probation_officer'] . '</td>
                                                </tr>
                                                <tr>
                                                    <td>Completion Date:</td>
                                                    <td>' . ChangeDateFormatPublicAmerican($rows[0]['completition_date']) . '</td>
                                                    <td>Court ID:</td>
                                                    <td>' . $rows[0]['court_id'] . '</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Time:</td>
                                                    <td>' . FromSecondsToTime($rows[0]['active_time_seconds']) . '</td>
                                                    <td>Charity:</td>
                                                    <td>Oakland Assistance Chapter</td>
                                                </tr>
                                                <tr>
                                                    <td>Number Of Courses:</td>
                                                    <td>' . $rows[0]['number_of_courses'] . '</td>
                                                    <td>Verification Code:</td>
                                                    <td>' . $rows[0]['unique_id'] . '</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <p class="doc-p">This letter serves to verify the above-named person successfully completed <u>100</u>
                                        hours
                                        volunteer
                                        community service work sponsored by our non-profit organization. The services performed were
                                        educational in nature with labor component and provide ongoing value to the community and the
                                        client through self-improvement. All training materials were prepared or approved by a licensed
                                        and experienced Masters Level Social Worker. Examples of topics addressed include Anger
                                        Management, Civics, Drug and Alcohol Awareness, Parenting and American Government.
                                        Structured feedback from client is used to improve our other programs.</p>
                                    <p class="doc-p">To verify the authenticity of this program please visit us www.oaklandassistance.net.
                                        On the front
                                        page please click on Client Authentication and then enter clients first/last name and provided
                                        verification code included in this letter. If other information is needed or you have questions
                                        please reach us at info@oaklandassistance.com or call at 000-000-0000.</p>
                                </div>
                                <div class="col-sm-12 mtp">
                                    <h4 class="mtuser">Respectfully Submitted,</h4>
                                    <p class="mt-5">=========================</p>
                                    <h4 class="mtuser">Mark Carpenter MSPC</h4>
                                    <h4 class="mtuser">Matthew Mullins</h4>
                                    <h4 class="mtuser">Executive Director Oakland Assistance Chapter</h4>

                                </div>
                            </div>

                        </div>

                    </body>

                    </html>';


        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($pdf_html);
        $mpdf->Output();


        exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
<?=getHeader("Official Document");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <main class="form-signin mt-5">
                    <div class="text-center mt-5">
                        <p>No document was found with ID <b><?=$print_unique_id?></b></p>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>