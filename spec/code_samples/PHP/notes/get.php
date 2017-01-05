$notes = $client->notes()->search([
    'filter' => 'relatedType:customer',
]);
