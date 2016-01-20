<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class ForumCategoriesResultResponse extends AbstractStruct
{
  public $forumId;
  public $forumName;
  public $forumDescription;
  public $numTopics;
  public $numPosts;
  public $lastPostId;
  public $lastAuthorId;
  public $lastPostAuthorName;
  public $lastTopicId;
  public $lastTime;
  public $specificRules;
  public $lastTopic;
  public $read;
  public $locked;
  public $sticky;
}
