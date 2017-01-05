try {
    $client->plans()->delete('planId');
} catch (ServerException $e) {
    echo $e->getMessage();
}
