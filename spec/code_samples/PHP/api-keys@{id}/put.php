$apiKeyForm = new Rebilly\Entities\ApiKey();
$apiKeyForm->setDescription('TestPut');
$apiKeyForm->setDatetimeFormat('mysql');

try {
    $apiKey = $client->apiKeys()->update('apiKeyID', $apiKeyForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
