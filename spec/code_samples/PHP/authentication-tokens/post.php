$authenticationForm = new Rebilly\Entities\AuthenticationToken();
$authenticationForm->setUsername('username');
$authenticationForm->setPassword('1234');

try {
    $authenticationToken = $client->authenticationTokens()->login($authenticationForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
