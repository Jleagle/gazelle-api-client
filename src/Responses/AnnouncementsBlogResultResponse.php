<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class AnnouncementsBlogResultResponse extends AbstractStruct
{
  public $blogId;
  public $author;
  public $title;
  public $bbBody;
  public $body;
  public $blogTime;
  public $threadId;
}
