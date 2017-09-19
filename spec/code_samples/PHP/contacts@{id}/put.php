$contactForm = new Rebilly\Entities\Contact();
$contactForm->setFirstName('Sherlock');
$contactForm->setLastName('Holmes');
$contactForm->setOrganization('TestOrganization');
$contactForm->setEmails(
    [
        [
            'label' => 'main',
            'value' => 'johndoe@testemail.com',
        ],
    ]
);
$contactForm->setPhoneNumbers(
    [
        [
            'label' => 'work',
            'value' => '+123456789',
        ],
    ]
);

try {
    $contact = $client->contacts()->update('contactId', $contactForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
