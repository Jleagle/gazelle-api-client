<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class TorrentGroupResponse extends AbstractStruct
{
  /**
   * @var TorrentGroupInfoResponse
   */
  public $group;
  /**
   * @var TorrentGroupResultResponse[]
   */
  public $torrents;
}
