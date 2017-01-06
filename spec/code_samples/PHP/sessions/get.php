$sessions = $client->sessions()->search([
    'filter' => 'userId:testUserId',
]);
