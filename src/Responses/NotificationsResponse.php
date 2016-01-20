<?php
namespace Jleagle\Gazelle\Responses;

class NotificationsResponse extends AbstractResultsResponse
{
  /**
   * @var NotificationsResultResponse[]
   */
  public $results = [];

  public $currentPages;
  public $numNew;
}
