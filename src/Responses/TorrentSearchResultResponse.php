<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class TorrentSearchResultResponse extends AbstractStruct
{
  public $groupId;
  public $groupName;
  public $artist;
  public $cover;
  public $tags;
  public $bookmarked;
  public $vanityHouse;
  public $groupYear;
  public $releaseType;
  public $groupTime;
  public $maxSize;
  public $totalSnatched;
  public $totalSeeders;
  public $totalLeechers;
  public $torrents;
}
