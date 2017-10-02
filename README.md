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

## Database
Here is an example of what can be found in the table

| key | value | autoload |
|-----|:-----:|---------:|
|site_name|My Blog|1|
|site_description|Use CakeSuit/Option for advance settings|1|
|analytics_ua|UA-XXXXXX|0|

## How to us ?
Recover all data marked autoload
```php
<?php
// Load the Model if necessary
$this->loadModel('Options');

// Fetch all data marked autoload
$options = $this->Options->find('autoload');
echo $options->site_name; // = 'My Blog'
echo $options->site_description; // = 'Use CakeSuit/Option for advance settings'
echo $options->analytics_ua; // = null (this value does not exist)
```

Recover data by keys
```php
<?php
// Load the Model if necessary
$this->loadModel('Options');
$options = $this->Options->find('keys', [
    'keys' => ['analytics_ua', 'site_description']
]);
echo $options->site_name; // = null
echo $options->site_description; // = 'Use CakeSuit/Option for advance settings'
echo $options->analytics_ua; // = 'UA-XXXXXX'
```

Check if empty data
```php
<?php
$this->loadModel('Options');
$options = $this->Options->find('keys', [
    'keys' => ['no_existe_value']
]);
$options->isEmpty(); // = true
```

Count data
```php
<?php
$this->loadModel('Options');
$options = $this->Options->find('autoload');
echo $options->count(); // = 2
```

## ...

If you encounter any difficulties, do not hesitate to contact me. 
Thank you.

***C@kesuit***

