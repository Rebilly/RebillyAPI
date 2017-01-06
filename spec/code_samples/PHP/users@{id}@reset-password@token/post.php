$resetPasswordForm = new Rebilly\Entities\ResetPassword();
$resetPasswordForm->setNewPassword('1234');

try {
    $user = $client->users()->updatePassword('userId', 'token', $resetPasswordForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
