<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class ForumCategoriesResponse extends AbstractStruct
{
  public $categoryID;
  public $categoryName;

  /**
   * @var ForumCategoriesResultResponse[]
   */
  public $forums = [];
}
