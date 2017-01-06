$leadSourceForm = new Rebilly\Entities\LeadSource();
$leadSourceForm->setSource('TestSource');
$leadSourceForm->setCampaign('TestCampaign');

try {
    $subscription = $client->subscriptions()->updateLeadSource('subscriptionId', $leadSourceForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
