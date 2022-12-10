# APIModule

## Description #

Simple application to help on the development of API's

## Setup ##

To run:

- Add ROOT_PATH constant to your configuration files with your project's root path as value;
- Add a routing file "ROOT_PATH/config/routes.php";
- Add require to your composer
- Add .htaccess file along with your index with the following content:
```xml

    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteRule ^(.*)$ index.php?endpoint=/$1 [L,QSA]
    </IfModule>
```
- Call
```php
    Bootstrap::handle();
```
from your index file

## Routing ##

Routes on routes.php file should follow the following example:

```php
    return [
        'GET' => [
            '/classes' => ['Class' => '\API\Controller\StudioClassController', 'Method' => 'get'],
            '/bookings' => ['Class' => '\API\Controller\BookingController', 'Method' => 'get']
        ],
        'POST' => [
            '/classes' => ['Class' => '\API\Controller\StudioClassController', 'Method' => 'add'],
            '/bookings' => ['Class' => '\API\Controller\BookingController', 'Method' => 'add']
        ]
    ];
```