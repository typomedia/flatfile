# Flatfile Database

Basic Object Storage System for small data.

Do not use 'Flatfile' for storing big data!

The Library is [PSR-1](https://www.php-fig.org/psr/psr-1/), [PSR-4](https://www.php-fig.org/psr/psr-4/), [PSR-12](https://www.php-fig.org/psr/psr-12/) compliant.

## Requirements

- `>= PHP 7.2`

## Install

```
composer require typomedia/flatfile
```

## Usage

```php
use Typomedia\Flatfile\Flatfile;

$data = [
    'Moretti' => [
        'name' => 'Style Ale',
        'style' => 'European Amber Lager',
        'alcohol' => '9.1%'
    ]
];

$flatfile = new Flatfile('test.json');
$key = md5(serialize($data));

$flatfile->set((object)$data, $key);
$flatfile->get($key);
$flatfile->first();
$flatfile->last();
$flatfile->keys();
$flatfile->find('name', 'Style Ale');
$flatfile->delete($key);
```