<?php
namespace Jleagle\Gazelle\Responses;

class ForumResponse extends AbstractResultsResponse
{
  public $forumName;
  public $specificRules;

  /**
   * @var ForumResultResponse[]
   */
  public $threads;
}
