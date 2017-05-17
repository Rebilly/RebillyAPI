$paymentCardTokenForm = new Rebilly\Entities\PaymentCardToken();
$paymentCardTokenForm->setFirstName('John');
$paymentCardTokenForm->setLastName('Doe');
$paymentCardTokenForm->setAddress('1313 Main Street');
$paymentCardTokenForm->setCity('Gotham');
$paymentCardTokenForm->setPostalCode('12345');
$paymentCardTokenForm->setRegion('NY');
$paymentCardTokenForm->setCountry('US');

$paymentInstrumentForm = new Entities\PaymentInstruments\PaymentCardPaymentInstrument();
$paymentInstrumentForm->setPan('4111111111111111');
$paymentInstrumentForm->setExpYear(2025);
$paymentInstrumentForm->setExpMonth(8);
$paymentInstrumentForm->setCvv(123);

$paymentCardTokenForm->setPaymentInstrument($paymentInstrumentForm);

try {
    $paymentCardToken = $client->paymentCardTokens()->create($paymentCardTokenForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
