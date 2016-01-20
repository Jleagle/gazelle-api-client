<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class BookmarkTorrentResponse extends AbstractStruct
{
  public $id;
  public $name;
  public $year;
  public $recordLabel;
  public $catalogueNumber;
  public $tagList;
  public $releaseType;
  public $vanityHouse;
  public $image;
  public $torrents = [];
}
