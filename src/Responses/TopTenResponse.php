<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class TopTenResponse extends AbstractStruct
{
  public $caption;
  public $tag;
  public $limit;

  /**
   * @var TopTenResultResponse[]
   */
  public $results = [];
}
