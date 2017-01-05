$emailCredentialsForm = new Rebilly\Entities\EmailCredentials();
$emailCredentialsForm->setSenderName('John Doe');
$emailCredentialsForm->setSenderEmail('jdoe@test.com');
$emailCredentialsForm->setUsername('test');
$emailCredentialsForm->setPassword('1234');
$emailCredentialsForm->setHost('testmail.com');
$emailCredentialsForm->setPort('25');

try {
    $emailCredentials = $client->emailCredentials()->create($emailCredentialsForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
