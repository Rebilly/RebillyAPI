try {
    $payment = $client->payments()->cancel('paymentId');
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
