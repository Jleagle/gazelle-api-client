<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class SimilarArtistsResultResponse extends AbstractStruct
{
  public $id;
  public $name;
  public $score;
}
