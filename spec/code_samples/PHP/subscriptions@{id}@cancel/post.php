$subscriptionCancelForm = new Rebilly\Entities\SubscriptionCancel();
$subscriptionCancelForm->setPolicy($subscriptionCancelForm::NOW);

try {
    $subscription = $client->subscriptions()->cancel('subscriptionId', $subscriptionCancelForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
