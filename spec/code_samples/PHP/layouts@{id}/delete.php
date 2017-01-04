try {
    $client->layouts()->delete('layoutId');
} catch (ServerException $e) {
    echo $e->getMessage();
}
