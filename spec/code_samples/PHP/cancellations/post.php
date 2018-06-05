$subscriptionCancelForm = new Rebilly\Entities\SubscriptionCancel();
$subscriptionCancelForm->setPolicy($subscriptionCancelForm::AT_NEXT_RENEWAL);

try {
    $subscription = $client->subscriptions()->cancel('subscriptionId', $subscriptionCancelForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
