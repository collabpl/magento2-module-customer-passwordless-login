# Magento 2 Customer PasswordLess Login Extension

The Collab_CustomerPasswordLessLogin module allows You to use its service in order to create an account
or login frontend user without the need of a password. Useful for integrations with 3rd party authenticatators
like Google, Facebook and theirs services like Facebook Login, Google One Tap etc.

## Basic usage

```php
<?php
...
use Collab\CustomerPasswordLessLogin\Service\LoginWithoutPassword;
...
public function __construct(
    protected LoginWithoutPassword $loginWithoutPassword
) {
}
...
$this->loginWithoutPassword->login([
    'email' => $payload['email'],
    'firstName' => $payload['given_name'],
    'lastName' => $payload['family_name']
]);
...
```

Service's login method accepts an array with the following keys:
- email
- firstName
- lastName

## Installation details
```bash
composer collab/module-customer-passwordless-login
bin/magento setup:upgrade
```
