<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class AnnouncementsResultResponse extends AbstractStruct
{
  public $newsId;
  public $title;
  public $bbBody;
  public $body;
  public $newsTime;
}
