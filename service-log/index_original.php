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

        $query = "SELECT hours_remaining_seconds, probation_officer, court_id, active_time_seconds,
                         DATE(first_time_taken) AS first_time_taken, CONCAT(first_name, ' ', last_name) AS username
                  FROM printed_courses pc, printed_documents pd, users u, user_courses uc
                  WHERE pd.id = $print_id AND pd.id = pc.print_id AND pd.user_id = u.id AND pc.user_course_id = uc.id";

        $rows = QuerySelect($query);

        $username = $rows[0]["username"];

        $pdf_html = '<!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Service Log</title>

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

                        <div class="service_log pt-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <img src="../assets/images/logo_oaklend.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <h1 class="text-center mt-5 mb-5">Community Service Log Sheet</h1>

                            <div class="container">
                                <div class="d-flex justify-content-between bd-highlight mb-4">
                                    <div class="p-2 bd-highlight">Name: ' . $username . '</div>
                                    <div class="p-2 bd-highlight">Verification Code: ' . $print_unique_id . '</div>
                                    <div class="p-2 bd-highlight">Organization: Oakland Assistance Chapter</div>
                                </div>
                                <table class="table-log">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Number of -Hours/Mins</th>
                                            <th>Court ID/Docket Number</th>
                                            <th>Probation Officer</th>
                                            <th>Remaining Required Hours</th>
                                        </tr>
                                    </thead>
                                <tbody>';

            $total_time = 0;

            for($i = 0; $i < count($rows); $i++){

                $total_time += intval($rows[$i]["active_time_seconds"]);

                $pdf_html .= '          <tr style="border-bottom: 1px solid #000">
                                            <td>' . ChangeDateFormatPublicAmerican($rows[$i]["first_time_taken"]) . '</td>
                                            <td>' . FromSecondsToTime(intval($rows[$i]["active_time_seconds"])) . '</td>
                                            <td>' . $rows[$i]["court_id"] . '</td>
                                            <td>' . $rows[$i]["probation_officer"] . '</td>
                                            <td>' . FromSecondsToTime(intval($rows[$i]["hours_remaining_seconds"])) . '</td>
                                        </tr>';
            }
                                        

            $pdf_html .= '          </tbody>
                                </table>
                                <div class="d-flex justify-content-between bd-highlight mb-5 mt-5 pb-5">
                                    <div class="p-2 bd-highlight">Total hours in this sheet = ' . FromSecondsToTime($total_time) . '</div>
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
<?=getHeader("Service Log");?>

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