$leadSourceForm = new Rebilly\Entities\LeadSource();
$leadSourceForm->setSource('TestSource');
$leadSourceForm->setCampaign('TestCampaign');

try {
    $invoice = $client->invoices()->updateLeadSource('invoiceId', $leadSourceForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
