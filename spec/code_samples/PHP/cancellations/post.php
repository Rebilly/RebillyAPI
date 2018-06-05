$subscriptionCancelForm = new Rebilly\Entities\SubscriptionCancel();
$subscriptionCancelForm->setPolicy($subscriptionCancelForm::AT_NEXT_RENEWAL);
$subscriptionCancelForm->setSubscriptionId('subscriptionId');

try {
    $subscription = $client->subscriptions()->cancel($subscriptionCancelForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
