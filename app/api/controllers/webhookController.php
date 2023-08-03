<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../services/ticketService.php';
require_once __DIR__ . '/../../services/qrCodeService.php';
require_once __DIR__ . '/../../services/invoiceService.php';
require_once __DIR__ . '/../../models/ticket.php';

use Mollie\Api\MollieApiClient;


class WebHookController
{
  function index()
  {
    try {
      $mollie = new \Mollie\Api\MollieApiClient();
      $mollie->setApiKey('test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8');

      $this->updateTicketsGenerateInvoice();
    } catch (Exception $e) {
      echo "API call failed: " . htmlspecialchars($e->getMessage());
    }
  }

  function updateTicketsGenerateInvoice()
  {
    $ticketService = new TicketService();

    $result = $ticketService->get_TicketsByUserIdAndStatus($_SESSION["USER_ID"], "pending");


    $qrCodeService = new QrCodeService();
    $qrCodeService->send_QRCode($result);
    $invoiceService = new InvoiceService();
    $invoiceService->send_Invoice($result);
    for ($i = 0; $i < sizeof($result); $i++) {
      $ticketService->checkoutTicket($result[$i]->getId());
    }
  }
}
