$apiKeyForm = new Rebilly\Entities\ApiKey();
$apiKeyForm->setDescription('Test');
$apiKeyForm->setDatetimeFormat('mysql');

try {
    $apiKey = $client->apiKeys()->create($apiKeyForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
