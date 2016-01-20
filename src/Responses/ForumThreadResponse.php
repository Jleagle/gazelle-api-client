<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class ForumThreadResponse extends AbstractStruct
{
  public $forumId;
  public $forumName;
  public $threadId;
  public $threadTitle;
  public $subscribed;
  public $locked;
  public $sticky;
  public $currentPage;
  public $pages;
  public $poll;

  /**
   * @var ForumThreadResultResponse[]
   */
  public $posts = [];
}
