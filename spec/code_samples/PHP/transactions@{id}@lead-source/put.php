$leadSourceForm = new Rebilly\Entities\LeadSource();
$leadSourceForm->setSource('TestSource');
$leadSourceForm->setCampaign('TestCampaign');

try {
    $transaction = $client->transactions()->updateLeadSource('transactionId', $leadSourceForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
