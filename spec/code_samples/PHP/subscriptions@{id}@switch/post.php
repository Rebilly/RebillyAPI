$subscriptionSwitchForm = new Rebilly\Entities\SubscriptionSwitch();
$subscriptionSwitchForm->setPlanId('newPlanId');
$subscriptionSwitchForm->setPolicy($subscriptionSwitchForm::NOW);

try {
    $subscription = $client->subscriptions()->switchTo('subscriptionId', $subscriptionSwitchForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
