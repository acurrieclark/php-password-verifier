# Password Checker [![Build Status](https://travis-ci.org/acurrieclark/php-password-verifier.svg?branch=master)](https://travis-ci.org/acurrieclark/php-password-verifier)
A framework agnostic password checker for PHP.

## Installation
```
$ composer require acurrieclark/php-password-verifier
```

## Usage

``` php
// include autoloader if you haven't already
include_once('vendor/autoload.php');

use acurrieclark\PhpPasswordVerifier\Pusher;

// create an instance
$passwordVerifier = new Verifier();

// default options are permissive, so  each constraint needs to be set as required
$passwordVerifier->setMinLength(8);

// constraints can also be chained
$passwordVerifier->setMaxLength(128)->setCheckContainsNumbers(true);

// check the password meets the requirements set (min length 8, max length 128, contains numbers)

$validPassword = $passwordVerifier->checkPassword("passwordToCheck");
```

## Class Methods

### Setting Password Constraints

##### setMinLength(int $length)
Set the minimum required length of the password

##### setMaxLength(int $length)
Set the maximum allowed length of the password

##### setCheckContainsLetters(boolean $value)
Set the flag to check that the password contains at least one letter

##### setCheckContainsCapitals(boolean $value)
Set the flag to check that the password contains at least one *capital* letter

##### setCheckContainsNumbers(boolean $value)
Set the flag to check that the password contains at least one number

##### setCheckContainsNumbers(boolean $value)
Set the flag to check that the password contains at least one number

##### setCheckContainsSpecialChrs(boolean $value)
Set the flag to check that the password contains at least one special character from ``{}()[]#,:;^.?!|&_`~@$%/\\=+-*"'``

##### setCheckBlacklist(boolean $value)
Set the flag to check if the password matches one of the 10000 most popular passwords from https://github.com/danielmiessler/SecLists

### Checking the Password

##### checkPassword(string $password)
Verify the password based on the constraints imposed. Returns boolean.

##### getErrors()
Returns an array of errors relating to the verified password

### Checking the Password

##### getSpecialChrs()
**Static:** Returns an array of the special characters used to check against when `setCheckContainsSpecialChrs(true)` has been set. Handy if you want to warn your users which characters they need to include.

## License
The MIT License (MIT). Please see the [License File](LICENSE) for more information.
