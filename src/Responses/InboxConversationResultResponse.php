<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class InboxConversationResultResponse extends AbstractStruct
{
  public $messageId;
  public $senderId;
  public $senderName;
  public $sentDate;
  public $avatar;
  public $bbBody;
  public $body;
}
