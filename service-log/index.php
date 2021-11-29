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

        $query = "SELECT hours_remaining_seconds, probation_officer, court_id, active_time_seconds, course_review, course_name, 
                         DATE(first_time_taken) AS first_time_taken, CONCAT(first_name, ' ', last_name) AS username
                  FROM printed_courses pc, printed_documents pd, users u, user_courses uc, courses c
                  WHERE pd.id = $print_id AND pd.id = pc.print_id AND pd.user_id = u.id AND pc.user_course_id = uc.id AND uc.course_id = c.id";

        $rows = QuerySelect($query);

        $query = "SELECT document_name, content FROM documents WHERE id = 2";

        $rows2 = QuerySelect($query);

        $document_name = $rows2[0]["document_name"];
        $content = $rows2[0]["content"];

        $username = $rows[0]["username"];

        $content = str_replace("VARIABLE_1", $username, $content);
        $content = str_replace("VARIABLE_2", $print_unique_id, $content);

        $total_time = 0;
        $table_html = '';
        $table_2_html = '';

        for($i = 0; $i < count($rows); $i++){

            $total_time += intval($rows[$i]["active_time_seconds"]);

            $table_html .= '<tr style="border-bottom: 1px solid #000">
                                <td>' . $rows[$i]["course_name"] . '</td>
                                <td>' . ChangeDateFormatPublicAmerican($rows[$i]["first_time_taken"]) . '</td>
                                <td>' . FromSecondsToTime(intval($rows[$i]["active_time_seconds"])) . '</td>
                                <td>' . $rows[$i]["court_id"] . '</td>
                                <td>' . $rows[$i]["probation_officer"] . '</td>
                                <td>' . FromSecondsToTime(intval($rows[$i]["hours_remaining_seconds"])) . '</td>
                            </tr>';

            $table_2_html .= '<tr style="border-bottom: 1px solid #000">
                                <td>' . $rows[$i]["course_name"] . '</td>
                                <td>' . $rows[$i]["course_review"] . '</td>
                            </tr>';
        }

        $content_1 = explode("<tbody>", $content);
        $content_2 = explode("</tbody>", $content_1[1]);
        $content_3 = explode("</tbody>", $content_1[2]);

        $content_1 = $content_1[0];
        $content_2 = $content_2[1];
        $content_3 = $content_3[1];


        $content = $content_1 . "<tbody>" . $table_html . "</tbody>" . $content_2 . "<tbody>" . $table_2_html . "</tbody>" . $content_3;

        $content = str_replace("VARIABLE_3", FromSecondsToTime($total_time), $content);

        $pdf_html = '<!DOCTYPE html>
                    <html lang="en">

                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                    ' . $content . '
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