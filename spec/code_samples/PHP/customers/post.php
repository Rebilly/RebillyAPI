$customerForm = new Rebilly\Entities\Customer();
$customerForm->setPrimaryAddress([
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
    $customer = $client->customers()->create($customerForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
