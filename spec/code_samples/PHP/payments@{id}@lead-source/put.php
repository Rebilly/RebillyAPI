$leadSourceForm = new Rebilly\Entities\LeadSource();
$leadSourceForm->setSource('TestSource');
$leadSourceForm->setCampaign('TestCampaign');

try {
    $payment = $client->payments()->updateLeadSource('paymentId', $leadSourceForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
