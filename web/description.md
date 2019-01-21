# Introduction
The Rebilly API is built on HTTP.  Our API is RESTful.  It has predictable
resource URLs.  It returns HTTP response codes to indicate errors.  It also
accepts and returns JSON in the HTTP body.  You can use your favorite
HTTP/REST library for your programming language to use Rebilly's API, or
you can use one of our SDKs (currently available in [PHP](https://github.com/Rebilly/rebilly-php)
and [Javascript](https://github.com/Rebilly/rebilly-js-sdk)).

We have other APIs that are also available.  Every action from our [app](https://app.rebilly.com)
is supported by an API which is documented and available for use so that you
may automate any workflows necessary.  This document contains the most commonly
integrated resources.

# Authentication
When you sign up for an account, you are given your first secret API key.
You can generate additional API keys, and delete API keys (as you may
need to rotate your keys in the future). You authenticate to the
Rebilly API by providing your secret key in the request header.

Rebilly offers three forms of authentication:  secret key, publishable key, JSON Web Tokens, and public signature key.
- [Secret API key](#section/Authentication/SecretApiKey): used for requests made
  from the server side. Never share these keys. Keep them guarded and secure.
- [Publishable API key](#section/Authentication/PublishableApiKey): used for 
  requests from the client side. For now can only be used to create 
  a [Payment Token](#tag/Payment-Tokens/paths/~1tokens/post) and 
  a [File token](#operation/fileCreation).
- [JWT](#section/Authentication/JWT): short lifetime tokens that can be assigned a specific expiration time.

Never share your secret keys. Keep them guarded and secure.

<!-- ReDoc-Inject: <security-definitions> -->

# SDKs

Rebilly offers a Javascript SDK and a PHP SDK to help interact with
the API.  However, no SDK is required to use the API.

Rebilly also offers [FramePay](https://rebilly.github.io/framepay-docs/),
 a client-side iFrame-based solution to help
create payment tokens while minimizing PCI DSS compliance burdens
and maximizing the customizability. [FramePay](https://rebilly.github.io/framepay-docs/)
is interacting with the [payment tokens creation operation](#operation/paymentTokenCreation).

## Javascript SDK

The [Javascript SDK](https://github.com/Rebilly/rebilly-js-sdk) is maintained 
within Github, and contains the installation and usage instructions.

## PHP SDK
For all PHP SDK examples provided in these docs you will need to configure the `$client`.
You may do it like this:

```php
$client = new Rebilly\Client([
    'apiKey' => 'YourApiKeyHere',
    'baseUrl' => 'https://api.rebilly.com',
]);
```

# Using filter with Collections
Rebilly provides collections filtering. You can use `?filter` param on collection to define which records should be shown in the response.

Here is filter format description:

- Fields and values in filter are separated with `:`: `?filter=firstName:John`.

- Fields in filter are separated with `;`: `?filter=firstName:John;lastName:Doe`.

- You can use multiple values using `,` as values separator: `?filter=firstName:John,Bob`.

- To negate the filter use `!`: `?filter=firstName:!John`. Note that you can negate multiple values like this: `?filter=firstName:!John,Bob`. This filter rule will exclude all Johns and Bobs from the response.

- You can use range filters like this: `?filter=amount:1..10`.

- You can use gte (greater than or equals) filter like this: `?filter=amount:1..`, or lte (less than or equals) than filter like this: `?filter=amount:..10`.

- You can create some [predefined values lists](https://rebilly.github.io/RebillyUserAPI/#tag/Lists) and use them in filter: `?filter=firstName:@yourListName`. You can also exclude list values: `?filter=firstName:!@yourListName`

# Expand to Include Embedded Objects
Rebilly provides the ability to pre-load additional 
objects with a request. 

You can use `?expand` param on most requests to expand
and include embedded objects within the
`_embedded` property of of the response.

The `_embedded` property contains an array of 
objects keyed by the expand parameter value(s).

You may expand multiple objects by passing them
as comma-separated to the expand value like so:

```
?_expand=recentInvoice,customer
```

And in the response, you would see:

```
"_embedded": [
    "recentInvoice": {...},
    "customer": {...}
]
```
Expand may be utilitized not only on `GET` requests but also on `PATCH`, `POST`, `PUT` requests too.


# Getting Started Guide

Rebilly's API has over 300 operations.  That's more than you'll 
need to implement your use cases.  If you have a use 
case you would like to implement, please consult us for
feedback on the best API operations for the task.

This getting started guide will demonstrate an order form use
case.  It will allow us to highlight core resources
in Rebilly that will be helpful for many other use cases
too.

## Prerequisites

* Sandbox (or live) secret and publishable key
* Created your first product and pricing plan
* Know your `websiteId` (or, if you have multiple ids, know which you want to use for the order)
* Have at least one [gateway account set up](https://help.rebilly.com/rebilly-basics/adding-a-payment-gateway)
  (your sandbox account already has one preconfigured)

#### Create Product & Pricing Plan

See our help guide to [Create a Product
& Pricing Plan](https://help.rebilly.com/rebilly-basics/create-a-product-and-a-pricing-plan)
in our user interface.  Our user interface helps the admin create their catalog.

However, we also have APIs available to accomplish these tasks (our user 
interface app only consumes our publicly available APIs).

####  Website ID

The website ID is informational and related to the organization.  Rebilly
supports multiple website and multiple organization accounts. Regardless
if your account has 1 or 100 websites, you must supply the `websiteId`
with most API requests (you'll see it in the request to create a subscription
and the request to create a transaction).

### Example Order Form

This guide will use an example where a customer is going to order
a pro plan subscription for $125/month plus (plan id is `pro`),
and a getting started guide for $5 one-time (plan id is `guide`).

## Overview

There are 4 main steps to complete the example order:

1. Create a payment token
2. Create/update a customer
3. Create/update a subscription (that's our language for the order)
4. Pay the invoice

## Create a Payment Token

In order to minimize your burden of PCI DSS compliance, you should
not let payment card data be stored or transmitted through your
servers.  The best way to minimize the burden while maximizing
the customizability is using an iframe-based solution that
already is integrated with our payment tokens API.  

We call this solution FramePay.

You will need your publishable key for use with FramePay. 
It's very important not to use your secret key, as the
key will reside within the client browser.

A payment token can be created for any kind of payment method, 
even if there are no special inputs required.  

Payment cards and bank accounts require special inputs such as
the card number or bank account number.  

You can see more in
the [FramePay docs](https://rebilly.github.io/framepay-docs/guide/).

The payment token will be supplied to the surrounding order form, 
and the value (the token id) will be used in the next API request.

### Payment tokens via FramePay

<PullRight>

### Include FramePay in your page

To get started add the `<script>` tag for FramePay to your page. 
This will expose it in the global page scope as `Rebilly`. 

By default FramePay does not inject CSS styles for the elements that 
are being generated into your form. However we provide a CSS file you 
can use to give elements a default look.
```html
<!-- CDN link to FramePay v1 -->
<script src="https://cdn.rebilly.com/framepay/v1/rebilly.js"></script>
<!-- Optional: Default CSS styles for the form elements -->
<link href="https://cdn.rebilly.com/framepay/v1/rebilly.css" rel="stylesheet">
```

&nbsp;

### Payment Card Form

FramePay injects UI elements into your form that are hosted by Rebilly 
which allows it to securely collect payment instrument data from your customers.

Start by creating your payment form as you would usually. 
Then create empty DOM elements within your form to determine 
where FramePay should mount UI elements.

```html
<form method="post" action="/process">
    <div class="field">
        <label>Payment Card</label>
        <div id="payment-card">
            <!-- FramePay will inject the 
            payment card field here -->
        </div>
        <!-- Provide an automatic way to inject the
            payment token as a hidden field -->
        <input type="hidden" 
            data-rebilly="token" name="paymentToken">
    </div>
    <button>Checkout</button>
</form>
```

&nbsp;

### JavaScript Setup

After the page has loaded you need to initialize FramePay with your Rebilly 
publishable API key and mount the payment card element at the desired location.

To collect the customer's information and the payment card data, define an event handler 
for the form `submit` event. Any `input` fields with a `data-rebilly` attribute will be 
parsed automatically and sent alongside the elements' data.

Trigger `Rebilly.createToken` to generate and inject the payment token into your form. 
The method returns a `Promise` with a single argument representing the API result of the operation. 
Validation or network errors can be caught using a `catch()` handler and displayed to the customer.

```js
// initialize with your publishable key
Rebilly.initialize({
    publishableKey: 'pk_sandbox_1234567890'
});

// mount a combined card element on 
// the #payment-card `<div>` in the form
Rebilly.card.mount('#payment-card');

// on form submit create a token
Rebilly.createToken(form)
    .then(function (token) {
        // paymentToken value
        console.log(token.id); 
        // we have a token field in the form
        // thus we can submit directly
        // to the Rebilly SDK
        form.submit();
    })
    .catch(function (error) {
        // see error.code and error.message
    });
```

The `paymentToken` value required in the next step is accessible here as `token.id`.
</PullRight>

Use the form below to test FramePay by providing a 
[publishable API key](https://app-sandbox.rebilly.com/api-keys) from your sandbox account. 

The data required for creating a payment token includes:
- the customer's billing address `firstName` and `lastName`
- the payment instrument values depending on the type (credit card or bank account)

See the [FramePay Getting Started Guide](https://rebilly.github.io/framepay-docs/guide/) for the step by step procedure to use FramePay in your forms. 


<iframe src="https://rebilly.github.io/framepay-docs/examples/walkthrough.html" border="0" frameborder="0" style="height:730px;width:100%" scrolling="no"></iframe>
 
## Preventing Duplicates

### A Note on Duplication

Important:  There are different
strategies to prevent creating duplicate customers.

#### Using the PUT request with an ID

If the customer has an identifier within your system
prior to the request to create the customer in Rebilly,
you may utilize your own identifier as long as it 
conforms to our basic requirements that it is a url-safe
string of 50 characters or less.

In this case, we recommend you utilize a PUT
request to create (or on duplicate ID update) the customer record.

#### Using GET + PUT or POST

If the customer does not have an identifier in your system,
or your system doesn't maintain identifiers, then
you may need to try to find if the customer exists 
first.  The best way to do that is to do a GET request on 
the customers resource and filter by whatever should make
that customer unique (such as their email address).

Email address is a popular such item for that, but
for some businesses, other keys make more sense, such as
name or phone number, or a combination of them.

To do this request, you need to understand how to 
generate a filter string.  

```
GET customers?filter=primaryAddress.*.email:bob@example.com
```

Here is an example to filter by name and email:

```
GET customers?filter=primaryAddress.*.email:bob@example.com;firstName:Bob;lastName:Smith
```

If there is a matching customer in the response, then
utilize that ID for the corresponding PUT request.

If there is not a matching customer, then create one
using the POST request. 

This technique requires 2 requests to implement the 
"insert on duplicate email update" type of behavior, 
where you can substitute email for any combination 
of values.

The preferred solution is the first option, of the PUT
only requests.

## Upsert a Customer

<PullRight>
We recommend usage of the `PUT` request which
behaves like "insert on duplicate id update."

Read the guide to [Preventing Duplicates](#section/Getting-Started-Guide/Preventing-Duplicates)
</PullRight>

There is a write only field in the create/update customer
request that accepts the `paymentToken`.  If supplied
it will consume the token created in the prior step,
and convert it into the default payment instrument.

It is beneficial to create the customer with 
a primary address, as that will be inherited
by default by other subordinate resources, as 
well as easily searchable.

We recommend creating the payment token with the full
customer address information so that the request to upsert
the customer is as simple as:

```
PUT customers/<id>
{
    "paymentToken": "<token id>"
}
```

Contained within the customer creation response is
an `id`.  The `id` is utilized within other
operations as the `customerId`.  It will match
the id value used in the path parameter of the `PUT`
request.

The response also contains a `defaultPaymentInstrument`.

You may want to hang on to those values (the default
payment instrument is an object hash with one value 
method and up to one additional key for specific
methods like a `paymentCardId` or `bankAccountId`).

See: [Customer Upsert API Operation](#operation/putCustomer)


## Upsert the Order
<PullRight>
#### Preventing Duplication

Just like with customers, you may use the `PUT`
request to create the order or update on
duplicate id.  

However, it may be less likely for your system
to have this ID before the order is created.

In that case, prepare to store the ID, at least
temporarily in the user's session until the 
order is successfully completed.  This will
prevent creating duplicated orders.

An order is quite simple -- it creates an 
invoice for a customer with certain items
on there.  If it's a subscription order, then
it creates an invoice at some regular schedule.

This guide shows using the PUT (upsert)
request.
</PullRight>
A **subscription** is our API term for an **order**.

You can have a subscription type `one-time-order`.

We expect to rename the endpoint in the future,
but we will maintain this endpoint available for
backwards compatibility purposes.

To create a subscription, you must know
the `customerId`, the `websiteId`, and the
list of `items` (pricing plans and quantities).

The `websiteId` is informational and can be
found in the **settings > organizations and websites**
section of the app.

This example shows us placing an order for the customer
for the "pro" plan and the "guide."
```
PUT subscriptions/<order id>
{
    "customerId": "<replace with customer id>",
    "websiteId": "<replace with website id>",
    "items": [
        {
            "planId": "pro",
            "quantity": 1
        },
        {
            "planId": "guide",
            "quantity": 1
        }
    ],
}
```

The response from the request will include a 
`recentInvoiceId` and an embedded `recentInvoice`
inside of the `_embedded` path of the object. 

We could inspect the recent invoice to find
the total, the line items, the taxes, discount,
shipping.

The result of this request for creating the order is a `pending`
subscription.  When the invoice is paid, then
the subscription will be activated and the status
will be `active`.  

If there is a free trial, simple pay the $0
invoice which will also activate the subscription.

When the subscription is `pending`, you may need
to display to the customer a preview of the total
including shipping, discounts, and taxes.  

To complete the payment, you will need to keep
track of that `recentInvoiceId`, and the total
`amount` that we want to charge the customer.

See: [Subscription Upsert API Operation](#operation/putSubscription)

## Collect the Payment

Collect the payment by creating a transaction.
This request will cause Rebilly to interact
with 3rd party gateways/processors.  

The payment *should* have a request id to 
allow us to identify and prevent duplicate
requests.  The request id must be unique
within a 24-hour period.  You should adjust 
this id when you load or reset the order 
form (for example, upon an error).

It is important to include the `recentInvoiceId`
with the transaction request so that
the invoice is marked as paid if the
transaction is approved.  This starts the
process of activating the subscription.

The transaction creation has two main paths 
it may take.  If the transaction can be
processed without end-user interaction, 
it will be.  In the case some end-user interaction
is required, the response will have a result
`unknown` and a status of `waiting-approval`
and the user must be presented with the `approvalUrl`
found in the `_links` section of the object.

These two paths enable the entire world of 
payments and payment methods.  The approval
url may be opened in an iframe or in a pop. 
From a mobile browser, a pop is more popular.

Use  [test cards within our
sandbox](https://help.rebilly.com/rebilly-basics/testing-transactions)

If the payment result is `declined` you may
present a message to the customer to retry 
with different payment information.

A sample request:
```
POST transactions
{
    "customerId": "<my customer id used above>",
    "type": "sale",
    "orderId": "<generate a unique identifier, such as a UUID>",
    "amount": 130.00,
    "currency": "USD",
    "websiteId": "example-com",
    "invoiceIds": ["<paste recentInvoiceId>"]
}
```

See: [Transaction Request API Operation](#operation/createTransaction)
