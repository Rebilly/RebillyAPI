$authenticationOptionsForm = new Rebilly\Entities\AuthenticationOptions();
$authenticationOptionsForm->setPasswordPattern('[a-zA-Z0-9]');

try {
    $authenticationOptions = $client->authenticationOptions()->update($authenticationOptionsForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
