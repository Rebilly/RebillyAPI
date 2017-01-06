$subscription = $client->subscriptions()->load('subscriptionId');
$leadSource = $subscription->getLeadSource();
