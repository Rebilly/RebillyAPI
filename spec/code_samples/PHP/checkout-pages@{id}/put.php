$checkoutPageForm = new Rebilly\Entities\CheckoutPage();
$checkoutPageForm->setPlanId('planId');
$checkoutPageForm->setWebsiteId('websiteId');
$checkoutPageForm->setName('TestCheckoutPage');
$checkoutPageForm->setUriPath('test-checkout-page');

try {
    $checkoutPage = $client->checkoutPages()->update('checkoutPageId', $checkoutPageForm);
} catch (UnprocessableEntityException $e) {
    echo $e->getMessage();
}
