<?php
namespace Jleagle\Gazelle\Responses;

use Jleagle\Helpers\Abstracts\AbstractStruct;

class AnnouncementsResponse extends AbstractStruct
{
  /**
   * @var AnnouncementsResultResponse[]
   */
  public $announcements;
  /**
   * @var AnnouncementsBlogResultResponse[]
   */
  public $blogPosts;
}
