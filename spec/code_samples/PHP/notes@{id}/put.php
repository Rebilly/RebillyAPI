$noteForm = new Rebilly\Entities\Note();
$noteForm->setRelatedId('customerId');
$noteForm->setRelatedType('customer');
$noteForm->setContent('Test Note');

try {
    $note = $client->notes()->update('noteId', $noteForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
