<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

abstract class AbstractResultsResponse extends AbstractStruct
{
  /**
   * @var int
   */
  public $currentPage;

  /**
   * @var int
   */
  public $pages;
}
