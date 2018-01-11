# Signature
**A port of Philip Browns [Signature-php](https://github.com/philipbrown/signature-php)**
**A PHP 5.4+ port of the [Signature](https://github.com/mloughran/signature) ruby gem**

[![Build Status](https://travis-ci.org/jmashore/signature-hmac.png?branch=master)](https://travis-ci.org/jmashore/signature-hmac)
[![Code Coverage](https://scrutinizer-ci.com/g/jmashore/signature-hmac/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jmashore/signature-hmac/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jmashore/signature-hmac/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jmashore/signature-hmac/?branch=master)

## Installation
Add `jmashore/signature-hmac` as a requirement to `composer.json`:
```bash
$ composer require jmashore/signature-hmac
```

## What is HMAC-SHA authentication?
HMAC-SHA authentication allows you to implement very simple key / secret authentication for your API using hashed signatures.

## Making a request
```php
use jmashore\Signature\Token;
use jmashore\Signature\Request;

$data    = ['name' => 'Philip Brown'];
$token   = new Token('abc123', 'qwerty');
$request = new Request('POST', 'users', $data);

$auth = $request->sign($token);

$http->post('users', array_merge($auth, $data));

```

## Authenticating a response
```php
use jmashore\Signature\Auth;
use jmashore\Signature\Token;
use jmashore\Signature\Guards\CheckKey;
use jmashore\Signature\Guards\CheckVersion;
use jmashore\Signature\Guards\CheckTimestamp;
use jmashore\Signature\Guards\CheckSignature;
use jmashore\Signature\Exceptions\SignatureException;

$auth  = new Auth('POST', 'users', $_POST, [
	new CheckKey,
	new CheckVersion,
	new CheckTimestamp,
	new CheckSignature
]);

$token = new Token('abc123', 'qwerty');

try {
    $auth->attempt($token);
}

catch (SignatureException $e) {
    // return 4xx
}
```

## Changing the default HTTP request prefix
By default, this package uses `auth_*` in requests. You can change this behaviour when signing and and authenticating requests:
```php
// default, the HTTP request uses auth_version, auth_key, auth_timestamp and auth_signature
$request->sign($token);
// the HTTP request now uses x-version, x-key, x-timestamp and x-signature
$request->sign($token, 'x-');
```

If you changed the default, you will need to authenticate the request accordingly:
```php
$auth->attempt($token, 'x-');
```
