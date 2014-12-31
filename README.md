PHPGazelle
==========

A PHP wrapper class for [Gazelle](https://github.com/WhatCD/Gazelle/wiki/JSON-API-Documentation), the popular BitTorrent private tracker framework.

## Installation

Add PHPGazelle to your `composer.json`:

    {
        "require": {
            "jleagle/gazelle-api-client": "dev-master"
        }
    }


Update composer to download the package

    $ php composer.phar update jleagle/gazelle-api-client

Enable the package:
```php
$gazelle = new \Jleagle\PHPGazelle\PHPGazelle(
	$username,
	$password
);
```

## Examples

Each API parameter can be added by chaining methods.
Just end the chain with get().

`https://what.cd/ajax.php?action=inbox&page=1&type=inbox&sort=unread`

is the same as

`$gazelle->inbox()->page(1)->type('inbox')->sort('unread')->get();`

#### Inbox

```php
$inbox = $gazelle->inbox()->get();

$conversation = $gazelle->inbox()->type('viewconv')->id(123)->get();
```

#### Torrents

```php
$torrent = $gazelle->torrent()->id(31421250)->get();

$group = $gazelle->torrentgroup()->id(72710033)->get();
```

#### Forums

```php
$forums = $gazelle->forum()->type('main')->get();

$forum = $gazelle->forum()->type('viewforum')->forumid(7)->get();

$thread = $gazelle->forum()->type('viewthread')->threadid(117192)->get();
```
