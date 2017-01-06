$resetPasswordTokens = $client->resetPasswordTokens()->search([
    'filter' => 'token:string',
]);
