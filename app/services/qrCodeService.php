<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/ticket.php';
require_once __DIR__ . '/../services/ticketService.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

Class QRCodeService{

    public function __construct()
    {
    }

    public function send_QRCode($tickets)
    {
        $mailer = new PHPMailer(true);
        $attachmentFiles = []; // Array to store attachment files

        try {
            // Server settings
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->Username = 'festivalsupp0rt@gmail.com';
            $mailer->Password = 'sqbjicugzpqmtrar';
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mailer->Port = 465;

            // Sender and recipient
            $mailer->setFrom('festivalsupp0rt@gmail.com', 'Festival Support');
            $mailer->addAddress($_SESSION['USER_MAIL'], 'user');

            

            foreach ($tickets as $ticket) {
                
                $dompdf = new Dompdf();

                $qr_code = QrCode::create($ticket->getId())
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh); //makes the qr code more resilient

                // creates a png writer               
                $writer = new PNGWriter();

                // adds label to qr code
                $label = Label::create("Scan Ticket");

                // generates the qr code
                $result = $writer->write($qr_code, label: $label);

                $dataUri = $result->getDataUri();

                // saves the qr code to a file
                // $qrCodeFile = __DIR__ . "/qrCode.png";
                // $result->saveToFile($qrCodeFile);

                $pdfFile = __DIR__ . "/../public/tickets/ticket_" . $ticket->getId() . ".pdf";
                $dompdf->loadHtml("
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
                                <p>Time: 12:00 PM</p>
                                <p>Location: Haarlem, Netherlands</p>
                                <div class='qr-code'>
                                    <img src='$dataUri' alt='QR Code' style='width: 200px; height: 200px;'>
                                </div>
                            </div>
                        </body>
                    </html>
                ");
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();

                file_put_contents($pdfFile, $dompdf->output());
                array_push($attachmentFiles, $pdfFile);
            }

            // Attach the PDF files
            foreach ($attachmentFiles as $attachmentFile) {
                $mailer->addAttachment($attachmentFile, basename($attachmentFile));
            }

            // Email subject and body
            $mailer->Subject = 'Haarlem Festival Ticket';
            $mailer->Body = 'Thank you for your purchase! Please find your tickets attached to this email.';

            // Send the email
            $mailer->send();

            echo 'Email sent successfully!';
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ', $mailer->ErrorInfo;
        }
    }

}