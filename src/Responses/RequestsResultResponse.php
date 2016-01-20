<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class RequestsResultResponse extends AbstractStruct
{
  public $requestId;
  public $requestorId;
  public $requestorName;
  public $timeAdded;
  public $lastVote;
  public $voteCount;
  public $bounty;
  public $categoryId;
  public $categoryName;
  public $artists = [];
  public $title;
  public $year;
  public $image;
  public $description;
  public $recordLabel;
  public $catalogueNumber;
  public $releaseType;
  public $bitrateList;
  public $formatList;
  public $mediaList;
  public $logCue;
  public $isFilled;
  public $fillerId;
  public $fillerName;
  public $torrentId;
  public $timeFilled;
}
