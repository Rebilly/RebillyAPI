$noteForm = new Rebilly\Entities\Note();
$noteForm->setRelatedId('customerId');
$noteForm->setRelatedType(Rebilly\Entities\ResourceType::TYPE_CUSTOMER);
$noteForm->setContent('Test Note');

try {
    $note = $client->notes()->update('noteId', $noteForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
