$customerForm = new Rebilly\Entities\Customer();
$customerForm->setFirstName('Sherlock');
$customerForm->setLastName('Holmes');
$customerForm->setEmail('sherlock.holmes@gmail.com');

try {
    $customer = $client->customers()->update('myCustomerId', $customerForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
