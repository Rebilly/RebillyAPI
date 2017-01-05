$gatewayAccountForm = new Rebilly\Entities\GatewayAccount();
$paymentCardScheme = new Rebilly\Entities\PaymentCardScheme();
$paymentMethod = new Rebilly\Entities\PaymentMethod();

$gatewayAccountForm->setGatewayName('A1Gateway');
$gatewayAccountForm->setAcquirerName('Bank of Rebilly');
$gatewayAccountForm->setOrganizationId('organizationId');
$gatewayAccountForm->setMerchantCategoryCode(5734);
$gatewayAccountForm->setWebsites(['websiteId1', 'websiteId2']);
$gatewayAccountForm->setPaymentCardSchemes([$paymentCardScheme::SCHEME_VISA, $paymentCardScheme::SCHEME_MASTERCARD]);
$gatewayAccountForm->setMethod($paymentMethod::METHOD_CASH);

$gatewayConfig = [
    'accountId' => 'test',
    'password' => '123',
];

$gatewayAccountForm->setGatewayConfig($gatewayConfig);

try {
    $gatewayAccount = $client->gatewayAccounts()->update('gatewayAccountId', $gatewayAccountForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
