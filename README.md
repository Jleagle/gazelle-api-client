# gazelle-api-client

A helper class to access the API on [Gazelle](https://github.com/WhatCD/Gazelle/wiki/JSON-API-Documentation) sites

### Usage

Instantiate the class using your website username and password:

```php
$gazelle = new Gazelle(USER, PASS);
```

Example API calls:

```php
$gazelle->getIndex();
$gazelle->getInbox();
$gazelle->getTopTen();
$gazelle->getRequests();
$gazelle->getArtistBookmarks();
$gazelle->getTorrentBookmarks();
$gazelle->getSubscriptions();
$gazelle->getForumCategories();
$gazelle->getNotifications();
$gazelle->getAnnouncements();
```
