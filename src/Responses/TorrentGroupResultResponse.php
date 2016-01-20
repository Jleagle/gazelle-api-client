<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class TorrentGroupResultResponse extends AbstractStruct
{
  public $id;
  public $media;
  public $format;
  public $encoding;
  public $remastered;
  public $remasterYear;
  public $remasterTitle;
  public $remasterRecordLabel;
  public $remasterCatalogueNumber;
  public $scene;
  public $hasLog;
  public $hasCue;
  public $logScore;
  public $fileCount;
  public $size;
  public $seeders;
  public $leechers;
  public $snatched;
  public $freeTorrent;
  public $reported;
  public $time;
  public $description;
  public $fileList;
  public $filePath;
  public $userId;
  public $username;
}
