<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class CollageResultResponse extends AbstractStruct
{
  public $id;
  public $name;
  public $year;
  public $categoryId;
  public $recordLabel;
  public $catalogueNumber;
  public $vanityHouse;
  public $tagList;
  public $releaseType;
  public $wikiImage;
  public $musicInfo = [];
  public $torrents = [];
}
