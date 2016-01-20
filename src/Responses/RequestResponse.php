<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class RequestResponse extends AbstractStruct
{
  public $requestId;
  public $requestorId;
  public $requestorName;
  public $isBookmarked;
  public $requestTax;
  public $timeAdded;
  public $canEdit;
  public $canVote;
  public $minimumVote;
  public $voteCount;
  public $lastVote;
  public $topContributors = [];
  public $totalBounty;
  public $categoryId;
  public $categoryName;
  public $title;
  public $year;
  public $image;
  public $bbDescription;
  public $musicInfo = [];
  public $catalogueNumber;
  public $releaseType;
  public $releaseName;
  public $bitrateList = [];
  public $formatList = [];
  public $mediaList = [];
  public $logCue;
  public $isFilled;
  public $fillerId;
  public $fillerName;
  public $torrentId;
  public $timeFilled;
  public $tags = [];
  public $comments = [];
  public $commentPage;
  public $commentPages;
  public $recordLabel;
  public $oclc;
}
