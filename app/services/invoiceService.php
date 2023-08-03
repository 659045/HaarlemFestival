<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/ticket.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

Class InvoiceService{

    public function send_Invoice($tickets)
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

            $invoicePdfFile = __DIR__ . "/../public/invoices/invoice.pdf";
            file_put_contents($invoicePdfFile, $invoiceDompdf->output());
            
            $mailer->addAttachment($invoicePdfFile, 'invoice.pdf');
            

            // Email subject and body
            $mailer->Subject = 'Haarlem Festival Invoice';
            $mailer->Body = 'This email contains an invoice for your purchase at Haarlem Festival.';

            // Send the email
            $mailer->send();

            echo 'Email sent successfully!';
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ', $mailer->ErrorInfo;
        }
    }

}