$subscriptionForm = new Rebilly\Entities\Subscription();
$subscriptionForm->setCustomerId('customerId');
$subscriptionForm->setWebsiteId('websiteId');
$subscriptionForm->setPlanId('planId');

try {
    $subscription = $client->subscriptions()->create($subscriptionForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
