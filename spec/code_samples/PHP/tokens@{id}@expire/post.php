try {
    $paymentCardToken = $client->paymentCardTokens()->expire('tokenId');
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
