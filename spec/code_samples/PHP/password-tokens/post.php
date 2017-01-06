$resetPasswordTokenForm = new Rebilly\Entities\ResetPasswordToken();
$resetPasswordTokenForm->setUserName('test');
$resetPasswordTokenForm->setPassword('1234');

try {
    $$resetPasswordToken = $client->resetPasswordTokens()->create($resetPasswordTokenForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
