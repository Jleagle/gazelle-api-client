<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class TorrentResponse extends AbstractStruct
{
  /**
   * @var TorrentGroupResponse
   */
  public $group;
  /**
   * @var TorrentResultResponse
   */
  public $torrent;
}
