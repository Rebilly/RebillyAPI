$paymentCardForm = new Rebilly\Entities\PaymentCard();
$paymentCardForm->setCustomerId('customerId');
$paymentCardForm->setPan('4111111111111111');
$paymentCardForm->setExpYear(2025);
$paymentCardForm->setExpMonth(8);
$paymentCardForm->setBillingAddress([
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
    $paymentCard = $client->paymentCards()->create($paymentCardForm, 'paymentCardId');
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
