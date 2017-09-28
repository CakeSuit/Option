# CakeSuit/Option plugin for CakePHP
## What is it ?
This plugin allows you to simply define options for your application with the key/value pair.
## Requirements
* CakePHP 3.4.0+
* PHP 5.6+
## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require CakeSuit/Option
```

Load plugin in config/bootstrap.php application
```
bin/cake plugin load -b CakeSuit/Option
```

If you want to use the built-in routes, load the plugin as follows
```
bin/cake plugin load -br CakeSuit/Option
```

## Migration
Now that the plugin is installed and loaded, you have to migrate the schema for the database
```
bin/cake migrations migrate -p CakeSuit/Option
```


## Database
Here is an example of what can be found in the table

| key | value | autoload |
|-----|:-----:|---------:|
|site_name|My Blog|1|
|site_description|Use CakeSuit/Option for advance settings|1|
|analytics_ua|UA-XXXXXX|0|

## Default Routes
```php
<?php
Router::plugin(
    'CakeSuit/Option',
    ['path' => '/cakesuit'],
    function (RouteBuilder $routes) {
        
        // List all
        $routes->connect(
            'options', 
            [
                'controller' => 'Options', 
                'action' => 'index'
            ]
        );
        
        // Add
        $routes->connect(
            'options', 
            [
                'controller' => 'Options', 
                'action' => 'add'
            ]
        );
        
        // Edit
        $routes->connect(
            'options/edit/:id', 
            [
                'controller' => 'Options', 
                'action' => 'edit', 
                [
                    'id' => '[0-9]+',
                    'pass' => ['id']
                ]
            ]
        );

        // Show
        $routes->connect(
            'options/view/:id', 
            [
                'controller' => 'Options', 
                'action' => 'view', 
                [
                    'id' => '[0-9]+',
                    'pass' => ['id']
                ]
            ]
        );
        
        // Delete
        $routes->connect(
            'options/delete/:id', 
            [
                'controller' => 'Options', 
                'action' => 'delete', 
                [
                    'id' => '[0-9]+',
                    'pass' => ['id']
                ]
            ]
        );
        
    }
);
```

## Warning
!!! this documentation is not finshed !!!

