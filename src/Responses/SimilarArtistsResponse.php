<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class SimilarArtistsResponse extends AbstractStruct
{
  /**
   * @var SimilarArtistsResultResponse[]
   */
  public $items = [];
}
