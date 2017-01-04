$emailCredentials = $client->emailCredentials()->search([
    'filter' => 'senderName:testSender',
]);
