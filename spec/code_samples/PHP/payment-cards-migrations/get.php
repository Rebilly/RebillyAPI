$paymentCardMigrations = $client->paymentCardMigrations()->search([
    'filter' => 'status:active',
]);
