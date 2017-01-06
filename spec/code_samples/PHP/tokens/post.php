$paymentCardTokenForm = new Rebilly\Entities\PaymentCardToken();
$paymentCardTokenForm->setFirstName('John');
$paymentCardTokenForm->setLastName('Doe');
$paymentCardTokenForm->setMethod(Rebilly\Entities\PaymentMethod::METHOD_PAYMENT_CARD);

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
