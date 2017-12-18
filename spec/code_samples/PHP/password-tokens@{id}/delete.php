try {
    $client->resetPasswordTokens()->delete('token');
} catch (ServerException $e) {
    echo $e->getMessage();
}
