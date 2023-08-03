<?php
require __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $text = $_POST["Ticket"];
    print_r($text);

    $qr_code = QrCode::create($text)
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh); //makes the qr code more resillient

    //creates a png writer               
    $writer = new PNGWriter();

    //adds label to qr code
    $label = Label::create("Scan Ticket");

    //generates the qr code
    $result = $writer->write($qr_code, label: $label);

    //saves the qr code to a file
    // $qrCodeFile = __DIR__ . "/qrCode.png";
    // $result->saveToFile($qrCodeFile);
    

    $dataUri = $result->getDataUri();

    $qrDompdf = new Dompdf();

    //image in pdf format
    //$dompdf->loadHtml("<img src='$dataUri'>");


    $qrDompdf->loadHtml("
        <html>
            <head>
                <meta charset='utf-8'>
                <title>Event Ticket</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                    }
                    .ticket {
                        width: 500px;
                        margin: 50px auto;
                        background-color: #f9f9f9;
                        border-radius: 8px;
                        padding: 20px;
                        text-align: center;
                    }
                    .ticket h1 {
                        font-size: 24px;
                        margin-bottom: 20px;
                    }
                    .ticket p {
                        font-size: 16px;
                        margin-bottom: 10px;
                    }
                    .ticket .qr-code {
                        margin-top: 30px;
                    }
                </style>
            </head>
            <body>
                <div class='ticket'>
                    <h1>Event Ticket</h1>
                    <p>Event: Haarlem Festival</p>
                    <p>Date: January 1, 2023</p>
                    <p>Location: Haarlem, Netherlands</p>
                    <div class='qr-code'>
                        <img src='$dataUri' alt='QR Code' style='width: 200px; height: 200px;'>
                    </div>
                </div>
            </body>
        </html>
    ");

    $qrDompdf->setPaper('A4', 'landscape');
    $qrDompdf->render();

    $ticketPdfFile = __DIR__ . "/ticket.pdf";
    file_put_contents($ticketPdfFile, $qrDompdf->output());

    $invoiceDompdf = new Dompdf();

    //invoice in pdf format
    $invoiceDompdf->loadHtml(
        "
        <style>
                *
            {
                border: 0;
                box-sizing: content-box;
                color: inherit;
                font-family: inherit;
                font-size: inherit;
                font-style: inherit;
                font-weight: inherit;
                line-height: inherit;
                list-style: none;
                margin: 0;
                padding: 0;
                text-decoration: none;
                vertical-align: top;
            }

            /* heading */

            h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; margin-left: 50px; }
            h2 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-transform: uppercase; }

            /* table */

            table { font-size: 75%; table-layout: fixed; width: 100%; }
            table { border-collapse: separate; border-spacing: 2px; }
            th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
            th, td { border-radius: 0.25em; border-style: solid; }
            th { background: #EEE; border-color: #BBB; }
            td { border-color: #DDD; }

            /* page */

            html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; }
            html { background: #999; cursor: default; }

            body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; width: 8.5in; }
            body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

            /* header */

            header { margin: 0 0 3em; }
            header:after { clear: both; content: ''; display: table; }

            header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; }
            header span, header img { display: block; float: right; }
            header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
            header img { max-height: 100%; max-width: 100%; }


            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 3em; }
            article:after { clear: both; content: ''; display: table; }
        

            /* table info & balance */

            table.info, table.balance { float: right; width: 36%; margin-bottom: 50px;}
            table.info:after, table.balance:after { clear: both; content: ''; display: table; }

            /* table info */

            table.info th { width: 40%; }
            table.info td { width: 60%; }

            /* table items */
            table.inventory { clear: both; width: 100%; }
            table.inventory th { font-weight: bold; text-align: center; }

            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) { text-align: right; width: 12%; }
            table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }

            /* table balance */
            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }

            /* @media print {
                * { -webkit-print-color-adjust: exact; }
                html { background: none; padding: 0; }
                body { box-shadow: none; margin: 0; }
                .add, .cut { display: none; }
            }

            @page { margin: 0; } */
        </style>

    <html>
        <head>
            <meta charset='utf-8'>
            <title>Invoice</title>
        </head>
        <body>
            <header>
                <h1>Invoice</h1>
                <address>
                    <p>Jonathan Neal</p>
                    <p>John@gmail.com</p>
                    <p>101 E. Chapman Ave<br>Orange, CA 92866</p>
                    <p>(800) 555-1234</p>
                </address>
                <span><img src='/img/Vector1.png'></span>
            </header>
            <div style='display: flex; flex-direction: row;'>
                    <h2>Recipient</h2>
                    <p>Haarlem Festival</p>
            </div>
            <article>
                
                <!-- info -->
                <table class='info'>
                    <tr>
                        <th>Invoice #</th>
                        <td>101138</td>
                    </tr>
                    <tr>
                        <th>Invoice Date</th>
                        <td>January 1, 2012</td>
                    </tr>
                    <tr>
                        <th>Payment Date</th>
                        <td>January 2, 2012</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>$600.00</td>
                    </tr>
                </table>
                <!-- inventory -->
                <table class='inventory'>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Front End Consultation</td>
                            <td>Experience Review</td>
                            <td>$150.00</td>
                            <td>4</td>
                            <td>$600.00</td>
                        </tr>
                    </tbody>
                </table>
                <!-- balance -->
                <table class='balance'>
                    <tr>
                        <th>SubTotal</th>
                        <td>$0</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>$600.00</td>
                    </tr>
                    <tr>
                        <th>Amount Due</th>
                        <td>$600.00</td>
                    </tr>
                </table>
            </article>
            <aside>
                <h1>Thank you for your purchase</h1>
            </aside>
        </body>
    </html>
        "
    );

    $invoiceDompdf->render();

    $invoicePdfFile = __DIR__ . "/invoice.pdf";
    file_put_contents($invoicePdfFile, $invoiceDompdf->output());

    // validates the qr code with the desired value
    //$writer->validateResult($result, 'Life is too short to be generating QR codes');

    // Create a new PHPMailer instance
    $mailer = new PHPMailer(true);

    try {
        // Server settings
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'festivalsupp0rt@gmail.com';  // Your SMTP username
        $mailer->Password = 'sqbjicugzpqmtrar';  // Your SMTP password
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mailer->Port = 465;  // Your SMTP port (e.g., 587 for TLS)

        // Sender and recipient
        $mailer->setFrom('festivalsupp0rt@gmail.com','Festival Support');
        $mailer->addAddress($_SESSION['USER_MAIL'], 'user');

        // Attach the PDF files
        $mailer->addAttachment($ticketPdfFile, 'ticket.pdf');
        $mailer->addAttachment($invoicePdfFile, 'invoice.pdf');

        // Email subject and body
        $mailer->Subject = 'Event Ticket and Invoice';
        $mailer->Body = 'Please find the attached event ticket and invoice.';

        // Send the email
        $mailer->send();

        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ', $mailer->ErrorInfo;
    }
}


?>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    * {
        padding: 0px;
        margin: 0px;
        /* outline: 1px solid red; */
    }
</style>

<title>Register</title>
<script src="https://cdn.tailwindcss.com"></script>

<body class="w-[100vw] h-[100vh] overflow-hidden bg-[#F7F7FB] flex justify-center">
    <?php
    include __DIR__ . '/../header.php';
    generateHeader('login', 'dark');
    ?>
    <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 590" xmlns="http://www.w3.org/2000/svg" class="transition duration-300 ease-in-out delay-150 absolute h-[100vh] w-[100vw] lg:bottom-[-30vh] lg:bottom-[-30vh] sm:bottom-[-50vh] mb:">
        <defs>
            <linearGradient id="gradient" x1="0%" y1="50%" x2="100%" y2="50%">
                <stop offset="5%" stop-color="#F78DA7"></stop>
                <stop offset="95%" stop-color="#8ED1FC"></stop>
            </linearGradient>
        </defs>
        <path d="M 0,600 C 0,600 0,150 0,150 C 99.25,149.67857142857144 198.5,149.35714285714286 306,142 C 413.5,134.64285714285714 529.2499999999999,120.25 671,127 C 812.7500000000001,133.75 980.5,161.64285714285717 1113,169 C 1245.5,176.35714285714283 1342.75,163.17857142857142 1440,150 C 1440,150 1440,600 1440,600 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="0.4" class="transition-all duration-300 ease-in-out delay-150 path-0"></path>
        <defs>
            <linearGradient id="gradient" x1="0%" y1="50%" x2="100%" y2="50%">
                <stop offset="5%" stop-color="#F78DA7"></stop>
                <stop offset="95%" stop-color="#8ED1FC"></stop>
            </linearGradient>
        </defs>
        <path d="M 0,600 C 0,600 0,300 0,300 C 102.75,319.3571428571429 205.5,338.7142857142857 344,330 C 482.5,321.2857142857143 656.7499999999999,284.49999999999994 782,272 C 907.2500000000001,259.50000000000006 983.5,271.28571428571433 1085,280 C 1186.5,288.71428571428567 1313.25,294.35714285714283 1440,300 C 1440,300 1440,600 1440,600 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="0.53" class="transition-all duration-300 ease-in-out delay-150 path-1"></path>
        <defs>
            <linearGradient id="gradient" x1="0%" y1="50%" x2="100%" y2="50%">
                <stop offset="5%" stop-color="#F78DA7"></stop>
                <stop offset="95%" stop-color="#8ED1FC"></stop>
            </linearGradient>
        </defs>
        <path d="M 0,600 C 0,600 0,450 0,450 C 122.21428571428572,468 244.42857142857144,486 357,480 C 469.57142857142856,474 572.5000000000001,444.00000000000006 685,431 C 797.4999999999999,417.99999999999994 919.5714285714287,422 1047,428 C 1174.4285714285713,434 1307.2142857142858,442 1440,450 C 1440,450 1440,600 1440,600 Z" stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="1" class="transition-all duration-300 ease-in-out delay-150 path-2"></path>
    </svg>

    <div class="pb-[2.5rem] lg:w-[1280px] md:w-[100vw] sm:w-[100vw] flex items-center justify-center" id="content-container">
        <div class="w-2/6 h-4.5/5 flex flex-col items-center  mt-[100px] backdrop-blur bg-white/50 rounded-md border-white/25 border-2 drop-shadow-xl">
            <form method="POST" action="" class="flex flex-col w-4/6">
                <input name="Ticket" rows="1" class="block w-full h-[40px] mt-[50px] m-auto my-4 py-2 px-2 text-sm text-gray-800 bg-[#F7F7FB] border-0 rounded-sm focus:ring-0 resize-none" placeholder="Ticket UUID" required>
                </input>

                <button name="submitRegister" type="submit" class="w-full h-[40px] text-[#29334E] flex items-center justify-center gap-[10px] border-2 border-[#29334E] cursor-pointer p-5 rounded-md">Register</button>
            </form>
        </div>
    </div>
</body>