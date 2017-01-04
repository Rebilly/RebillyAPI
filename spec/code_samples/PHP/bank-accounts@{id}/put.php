$bankAccountForm = new Rebilly\Entities\BankAccount();
$bankAccountForm->setCustomerId('customerId');
$bankAccountForm->setContactId('contactId');
$bankAccountForm->setRoutingNumber('0123456');
$bankAccountForm->setAccountNumber('0123456');
$bankAccountForm->setAccountType('checking');

try {
    $bankAccount = $client->customers()->update('bankAccountId', $bankAccountForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
