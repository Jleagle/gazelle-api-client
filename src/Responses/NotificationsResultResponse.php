<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class NotificationsResultResponse extends AbstractStruct
{
  public $torrentId;
  public $groupId;
  public $groupName;
  public $groupCategoryId;
  public $torrentTags;
  public $size;
  public $fileCount;
  public $format;
  public $encoding;
  public $media;
  public $scene;
  public $groupYear;
  public $remasterYear;
  public $remasterTitle;
  public $snatched;
  public $seeders;
  public $leechers;
  public $notificationTime;
  public $hasLog;
  public $hasCue;
  public $logScore;
  public $freeTorrent;
  public $logInDb;
  public $unread;
}
