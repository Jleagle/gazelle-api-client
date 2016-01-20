<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class ArtistResponse extends AbstractStruct
{
  public $id;
  public $name;
  public $notificationsEnabled;
  public $hasBookmarked;
  public $image;
  public $body;
  public $vanityHouse;
  public $tags;
  public $similarArtists;
  public $statistics;
  public $torrentgroup;
  public $requests;
}
