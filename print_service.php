<?php


require_once __DIR__ . '/vendor/autoload.php';




$pdf_html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/all.min.css">



    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="manifest" href="/site.webmanifest">


    <script src="assets/js/app.js"></script>
    <script src="assets/js/all.min.js"></script>

</head>

<body style="background: #ffffff;">


    <div class="service_log pt-5">
        <h1 class="text-center mt-5 mb-5">Community Service Log Sheet</h1>

        <div class="container">
            <div class="d-flex justify-content-between bd-highlight mb-4">
                <div class="p-2 bd-highlight">Name:</div>
                <div class="p-2 bd-highlight">Organization: Oakland Assistance Chapter Sheet _____ of _____</div>
            </div>
            <table class="table-log">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Number of
                            -Hours/Mins</th>
                        <th>Court ID/Docket Number</th>
                        <th>Probation Officer</th>
                        <th>Remaining Required Hours</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>w</td>
                        <td></td>
                        <td></td>
                    </tr>


                </tbody>
            </table>
            <div class="d-flex justify-content-between bd-highlight mb-5 mt-5 pb-5">
                <div class="p-2 bd-highlight">Total hours in this sheet = _______</div>
            </div>
        </div>
    </div>




</body>

</html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($pdf_html);
$mpdf->Output();


exit();


?>