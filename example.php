<?php

require_once 'vendor/autoload.php';

use DutchIS\Api;

// Create a new API instance
$api = new Api('your-api-token', 'your-team-id');

// Get the current user
print_r($api->get('/v1/user'));

// Get virtual servers on team
print_r($api->get('/v1/virtualservers'));

// Create virtual servers on team
print_r($api->post('/v1/virtualservers', [
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
]));
