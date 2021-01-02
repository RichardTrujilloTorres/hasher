# Laravel Custom Harsher 


## Introduction

Expand upon Laravel out-of-the-box supported hashing drivers by simply specifying them through
configuration.

## Installation

```shell
composer req cymatica/hasher --prefer-dist
```

## Usage

To use the hasher globally (i.e. on authentication password), set the driver in the hashing config file:
```
'driver' => 'sha512',
```

To retrieve an instance, instead:
```
$md5Hasher = app()->make('hash.md5');
$hashedString = $md5Hasher->make('some test string');
...
```


## Drivers

Supported drivers:
- SHA512
- SHA256
- SHA1
- MD5
