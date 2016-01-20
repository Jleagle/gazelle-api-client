<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class IndexResponse extends AbstractStruct
{
  public $username;
  public $id;
  public $authkey;
  public $passkey;
  public $notifications = [];
  public $userstats = [];
}
