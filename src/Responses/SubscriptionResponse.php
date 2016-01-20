<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class SubscriptionResponse extends AbstractStruct
{
  public $forumId;
  public $forumName;
  public $threadId;
  public $threadTitle;
  public $postId;
  public $lastPostId;
  public $locked;
  public $new;
}
