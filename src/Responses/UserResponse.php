<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class UserResponse extends AbstractStruct
{
  public $username;
  public $avatar;
  public $isFriend;
  public $profileText;
  public $stats = [];
  public $ranks = [];
  public $personal = [];
  public $community = [];
}
