<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class TopTenResultResponse extends AbstractStruct
{
  public $torrentId;
  public $groupId;
  public $artist;
  public $groupName;
  public $groupCategory;
  public $groupYear;
  public $remasterTitle;
  public $format;
  public $encoding;
  public $hasLog;
  public $hasCue;
  public $media;
  public $scene;
  public $year;
  public $tags = [];
  public $snatched;
  public $seeders;
  public $leechers;
  public $data;
  public $size;
  public $wikiImage;
  public $releaseType;
}
