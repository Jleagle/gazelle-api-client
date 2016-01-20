<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class InboxConversationResponse extends AbstractStruct
{
  public $convId;
  public $subject;
  public $sticky;

  /**
   * @var InboxConversationResultResponse[]
   */
  public $messages = [];
}
