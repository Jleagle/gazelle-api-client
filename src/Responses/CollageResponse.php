<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class CollageResponse extends AbstractStruct
{
  public $id;
  public $name;
  public $description;
  public $creatorID;
  public $deleted;
  public $collageCategoryID;
  public $collageCategoryName;
  public $locked;
  public $maxGroups;
  public $maxGroupsPerUser;
  public $hasBookmarked;
  public $subscriberCount;
  public $torrentGroupIDList = [];

  /**
   * @var CollageResultResponse[]
   */
  public $torrentgroups = [];
}
