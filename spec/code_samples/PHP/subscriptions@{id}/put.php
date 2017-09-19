$subscriptionForm = new Rebilly\Entities\Subscription();
$subscriptionForm->setCustomerId('customerId');
$subscriptionForm->setWebsiteId('websiteId');
$subscriptionForm->setPlanId('planId');
$subscriptionForm->setBillingAddress([
    'firstName' => 'John',
    'lastName' => 'Doe',
    'organization' => 'Test LTD',
    'address' => 'Test street 5',
    'address2' => 'Test house 5',
    'city' => 'New York',
    'region' => 'Long Island',
    'country' => 'US',
    'postalCode' => '123456',
    'emails' => [
        [
            'label' => 'main',
            'value' => 'johndoe@testemail.com',
        ],
    ],
    'phoneNumbers' => [
        [
            'label' => 'work',
            'value' => '+123456789',
        ],
    ],
]);

try {
    $subscription = $client->subscriptions()->update('subscriptionId', $subscriptionForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
