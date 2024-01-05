<h1 align="center">Parser</h1>

Our Parser package is using [erusev/parsedown](https://github.com/erusev/parsedown) 

## Requirement

- composer
- laravel >= 8.x

## Installation

```shell
$ composer require adnan/parser
```

### Add this in service provider config>app.php in 'providers' =>

```php
<?php

Adnan\Parser\ParsedownServiceProvider::class,

```


## Usage Example



### Using Helper
```php
<?php

{{ parsedown('## h2') }}
```

### Using blade
```php
<?php

@parsedown('## h2');
```
## Customization 
It can be done in config markdown.php

## Developed in
IB ARTS Pvt Ltd
