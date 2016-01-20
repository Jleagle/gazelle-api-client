<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class ForumResultResponse extends AbstractStruct
{
  public $topicId;
  public $title;
  public $authorId;
  public $authorName;
  public $locked;
  public $sticky;
  public $postCount;
  public $lastID;
  public $lastTime;
  public $lastAuthorId;
  public $lastAuthorName;
  public $lastReadPage;
  public $lastReadPostId;
  public $read;
}
