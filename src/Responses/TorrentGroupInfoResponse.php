<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class TorrentGroupInfoResponse extends AbstractStruct
{
  public $wikiBody;
  public $wikiImage;
  public $id;
  public $name;
  public $year;
  public $recordLabel;
  public $catalogueNumber;
  public $releaseType;
  public $categoryId;
  public $categoryName;
  public $time;
  public $vanityHouse;
  public $isBookmarked;
  public $musicInfo = [];
  public $tags = [];
}
