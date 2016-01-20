<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class ForumThreadResultResponse extends AbstractStruct
{
  public $postId;
  public $addedTime;
  public $bbBody;
  public $body;
  public $editedUserId;
  public $editedTime;
  public $editedUsername;
  public $author = [];
}
