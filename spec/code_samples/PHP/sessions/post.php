$sessionForm = new Rebilly\Entities\Session();

$permissions = [
    // Example permission to use GET and POST methods only for certain Customers
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
    // Example permission to use all methods for Websites resource
    [
        'resourceName' => Rebilly\Entities\ResourceType::TYPE_WEBSITES,
        'methods' => [
            $sessionForm::METHOD_GET,
            $sessionForm::METHOD_POST,
            $sessionForm::METHOD_PUT,
            $sessionForm::METHOD_HEAD,
            $sessionForm::METHOD_DELETE,
        ],
    ],
    // Example permission to use all methods for all resources
    [],
];

$sessionForm->setPermissions($permissions);

try {
    $session = $client->sessions()->create($sessionForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
