<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class UserSearchResultResponse extends AbstractStruct
{
  public $userId;
  public $username;
  public $donor;
  public $warned;
  public $enabled;
  public $class;
  public $avatar;
}
