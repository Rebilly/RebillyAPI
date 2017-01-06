$paymentCardMigrationForm = new Rebilly\Entities\PaymentCardMigrationsRequest();
$paymentCardMigrationForm->setFromGatewayAccountId('gatewayAccountId');
$paymentCardMigrationForm->setToGatewayAccountId('newGatewayAccountId');

$paymentCardIds = [
    'testPaymentCardId',
    'testPaymentCardId2',
];

$paymentCardMigrationForm->setPaymentCardIds($paymentCardIds)

try {
    $paymentCardMigrationResponse = $client->paymentCardMigrations()->migrate($paymentCardMigrationForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
