$contactForm = new Rebilly\Entities\Contact();
$contactForm->setFirstName('Sherlock');
$contactForm->setLastName('Holmes');
$contactForm->setOrganization('TestOrganization');

try {
    $contact = $client->contacts()->update('contactId', $contactForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
