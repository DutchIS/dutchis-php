# DutchIS PHP Wrapper
This is a is a lightweight wrapper for the DutchIS API.

Compatible with PHP 7.4, 8.0, 8.1, 8.2.

## Example
```php
<?php

require_once 'vendor/autoload.php';
use DutchIS\Api;

// Create a new API instance
$api = new Api('your-api-token', 'your-team-uuid');

// Get the current user
print_r( $api->get('/v1/user') );

// Get virtual servers on team
print_r( $api->get('/v1/virtualservers') );

// Create virtual servers on team
print_r( $api->post('/v1/virtualservers', [
    "hostname" => "php-server",
    "class" => "performance",
    "os" => "ubuntu2204",
    "username" => "username",
    "password" => "password",
    "sshkeys" => [
        "your-ssh-uuid"
    ],
    "cores" => 2,
    "memory" => 4,
    "network" => 1,
    "disk" => 50
]) );

?>
```
