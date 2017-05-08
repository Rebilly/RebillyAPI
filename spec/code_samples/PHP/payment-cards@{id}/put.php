$paymentCardForm = new Rebilly\Entities\PaymentCard();
$paymentCardForm->setCustomerId('customerId');
$paymentCardForm->setPan('4111111111111111');
$paymentCardForm->setExpYear(2025);
$paymentCardForm->setExpMonth(8);
$paymentCardForm->setBillingContactId('contactId');

try {
    $paymentCard = $client->paymentCards()->create($paymentCardForm, 'paymentCardId');
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
