try {
    $client->sessions()->delete('sessionId');
} catch (ServerException $e) {
    echo $e->getMessage();
}
