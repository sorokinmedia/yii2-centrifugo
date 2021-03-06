# Yii2 Centrifugo Component

[![Total Downloads](https://img.shields.io/packagist/dt/sorokinmedia/yii2-centrifugo.svg)](https://packagist.org/packages/sorokinmedia/yii2-centrifugo)

There is a wrapper for [Centrifugo](https://github.com/centrifugal/centrifugo) client based on [PHPCent](https://github.com/centrifugal/phpcent)

## Installation
Run command in shell
```shell
> php composer.phar require "sorokinmedia/yii2-centrifugo"
```
or add this line in to the `require` section of the `composer.json` file in your project 
```json
"sorokinmedia/yii2-centrifugo": "*"
```

## Setup
Add into your config file as following
```php
'components' => [
	...
	'centrifugo' => [
		'class'  => \sorokinmedia\centrifugo\Client::class,
		'host'   => 'http://localhost:8000/api',
		'secret' => 'very-long-secret-key',
		'apikey' => 'very-long-api-ket'
 	],
	...
]
```

## Usage
publish message
```php
Yii::$app->centrifugo->publish('test', ['message' => 'hello world']);
```
generate jwt token
```php
Yii::$app->centrifugo->generateConnectionToken('5', 0, ['user_id' => 5]);
```
