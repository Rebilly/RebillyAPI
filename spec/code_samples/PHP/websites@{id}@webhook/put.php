$websiteWebhookForm = new Rebilly\Entities\WebsiteWebhook();
$websiteWebhookForm->setWebHookUrl('http://testwebsite.com/webhook');
$websiteWebhookForm->setWebHookUsername('test');
$websiteWebhookForm->setWebHookPassword('1234');

try {
    $website = $client->websiteWebhook()->update('websiteId', $websiteWebhookForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
