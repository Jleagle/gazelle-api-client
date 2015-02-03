gazelle-api-client
==================

[![Build Status (Scrutinizer)](https://scrutinizer-ci.com/g/Jleagle/gazelle-api-client/badges/build.png)](https://scrutinizer-ci.com/g/Jleagle/gazelle-api-client)
[![Code Quality (scrutinizer)](https://scrutinizer-ci.com/g/Jleagle/gazelle-api-client/badges/quality-score.png)](https://scrutinizer-ci.com/g/Jleagle/gazelle-api-client)
[![Latest Stable Version](https://poser.pugx.org/Jleagle/gazelle-api-client/v/stable.png)](https://packagist.org/packages/Jleagle/gazelle-api-client)

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

```php
$gazelle = new \Jleagle\Gazelle\Gazelle(
	$username,
	$password
);
```

Example API calls:

```php
// Get the forums
$forums = $gazelle->getForumMain();

// Get announcements
$announcements = $gazelle->announcements();
```
