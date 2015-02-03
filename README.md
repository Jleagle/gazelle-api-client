gazelle-api-client
==================

A helper class to access the API on [Gazelle](https://github.com/WhatCD/Gazelle/wiki/JSON-API-Documentation) sites

### Installation

Add Gazelle to composer and run `composer update`:

```json
"require": {
    "jleagle/gazelle-api-client": "*"
}
```

### Usage

Instantiate the class using your website username and password:

$gazelle = new \Jleagle\Gazelle\Gazelle(
	$username,
	$password
);

Example API calls:

```php
// Get the forums
$forums = $gazelle->getForumMain();

// Get announcements
$announcements = $gazelle->announcements();
```
