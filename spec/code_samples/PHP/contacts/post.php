$contactForm = new Rebilly\Entities\Contact();
$contactForm->setFirstName('Sherlock');
$contactForm->setLastName('Holmes');
$contactForm->setOrganization('TestOrganization');

try {
    $contact = $client->contacts()->create($contactForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
