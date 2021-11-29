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

        $query = "SELECT document_name, content FROM documents WHERE id = 1";

        $rows2 = QuerySelect($query);

        $document_name = $rows2[0]["document_name"];
        $content = $rows2[0]["content"];

        $content = str_replace("VARIABLE_1", $rows[0]['username'], $content);
        $content = str_replace("VARIABLE_2", $rows[0]['address'], $content);
        $content = str_replace("VARIABLE_3", ChangeDateFormatPublicAmerican($rows[0]['start_date']), $content);
        $content = str_replace("VARIABLE_4", $rows[0]['probation_officer'], $content);
        $content = str_replace("VARIABLE_5", ChangeDateFormatPublicAmerican($rows[0]['completition_date']), $content);
        $content = str_replace("VARIABLE_6", $rows[0]['court_id'], $content);
        $content = str_replace("VARIABLE_7", FromSecondsToTime($rows[0]['active_time_seconds']), $content);
        $content = str_replace("VARIABLE_8", $rows[0]['number_of_courses'], $content);
        $content = str_replace("VARIABLE_9", $rows[0]['unique_id'], $content);

        

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
                    ' . $content . '
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