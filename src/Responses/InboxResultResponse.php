<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class InboxResultResponse extends AbstractStruct
{
  public $convId;
  public $subject;
  public $unread;
  public $sticky;
  public $forwardedId;
  public $forwardedName;
  public $senderId;
  public $username;
  public $avatar;
  public $donor;
  public $warned;
  public $enabled;
  public $date;
}
