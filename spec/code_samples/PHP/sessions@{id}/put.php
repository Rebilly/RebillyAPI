$sessionForm = new Rebilly\Entities\Session();

$permissions = [
    [
        'resourceName' => Rebilly\Entities\ResourceType::TYPE_CUSTOMERS,
        'methods' => [
            $sessionForm::METHOD_GET,
            $sessionForm::METHOD_POST,
        ],
        'resourceIds' => [
            'testCustomerId',
            'testCustomerId2',
        ],
    ],
    [
        'resourceName' => Rebilly\Entities\ResourceType::TYPE_WEBSITES,
        'methods' => [
            $sessionForm::METHOD_GET,
            $sessionForm::METHOD_POST,
        ],
        'resourceIds' => [
            'testWebsiteId',
            'testWebsiteId2',
        ],
    ],
];

$sessionForm->setPermissions($permissions);

try {
    $session = $client->sessions()->update('sessionId', $sessionForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
