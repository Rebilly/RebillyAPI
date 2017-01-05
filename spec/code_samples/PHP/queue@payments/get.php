$payments = $client->payments()->searchInQueue([
    'filter' => 'currency:USD',
]);
