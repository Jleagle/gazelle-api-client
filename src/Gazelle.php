<?php
namespace Jleagle\Gazelle;

use Jleagle\CurlWrapper\Curl;
use Jleagle\CurlWrapper\Exceptions\CurlException;
use Jleagle\CurlWrapper\Exceptions\CurlInvalidJsonException;
use Jleagle\CurlWrapper\Header\CookieJar;
use Jleagle\Gazelle\Enums\GazelleApiStatus;
use Jleagle\Gazelle\Enums\GazelleMessagesSort;
use Jleagle\Gazelle\Enums\GazelleMessagesType;
use Jleagle\Gazelle\Enums\GazelleRequestsShowFilled;
use Jleagle\Gazelle\Enums\GazelleRequestsTagsType;
use Jleagle\Gazelle\Enums\GazelleTopTenType;
use Jleagle\Gazelle\Exceptions\GazelleApiFailureException;
use Jleagle\Gazelle\Responses\AnnouncementsBlogResultResponse;
use Jleagle\Gazelle\Responses\AnnouncementsResponse;
use Jleagle\Gazelle\Responses\AnnouncementsResultResponse;
use Jleagle\Gazelle\Responses\ArtistResponse;
use Jleagle\Gazelle\Responses\BookmarkArtistResponse;
use Jleagle\Gazelle\Responses\BookmarkTorrentResponse;
use Jleagle\Gazelle\Responses\CollageResponse;
use Jleagle\Gazelle\Responses\CollageResultResponse;
use Jleagle\Gazelle\Responses\ForumCategoriesResponse;
use Jleagle\Gazelle\Responses\ForumCategoriesResultResponse;
use Jleagle\Gazelle\Responses\ForumResponse;
use Jleagle\Gazelle\Responses\ForumResultResponse;
use Jleagle\Gazelle\Responses\ForumThreadResponse;
use Jleagle\Gazelle\Responses\ForumThreadResultResponse;
use Jleagle\Gazelle\Responses\InboxConversationResponse;
use Jleagle\Gazelle\Responses\InboxConversationResultResponse;
use Jleagle\Gazelle\Responses\InboxResponse;
use Jleagle\Gazelle\Responses\InboxResultResponse;
use Jleagle\Gazelle\Responses\IndexResponse;
use Jleagle\Gazelle\Responses\NotificationsResponse;
use Jleagle\Gazelle\Responses\NotificationsResultResponse;
use Jleagle\Gazelle\Responses\RequestResponse;
use Jleagle\Gazelle\Responses\RequestsResponse;
use Jleagle\Gazelle\Responses\RequestsResultResponse;
use Jleagle\Gazelle\Responses\SimilarArtistsResponse;
use Jleagle\Gazelle\Responses\SimilarArtistsResultResponse;
use Jleagle\Gazelle\Responses\SubscriptionResponse;
use Jleagle\Gazelle\Responses\TopTenResponse;
use Jleagle\Gazelle\Responses\TopTenResultResponse;
use Jleagle\Gazelle\Responses\TorrentGroupInfoResponse;
use Jleagle\Gazelle\Responses\TorrentGroupResponse;
use Jleagle\Gazelle\Responses\TorrentGroupResultResponse;
use Jleagle\Gazelle\Responses\TorrentResponse;
use Jleagle\Gazelle\Responses\TorrentResultResponse;
use Jleagle\Gazelle\Responses\TorrentSearchResponse;
use Jleagle\Gazelle\Responses\TorrentSearchResultResponse;
use Jleagle\Gazelle\Responses\UserResponse;
use Jleagle\Gazelle\Responses\UserSearchResponse;
use Jleagle\Gazelle\Responses\UserSearchResultResponse;
use Packaged\Helpers\Arrays;

class Gazelle
{
  /**
   * @var string
   */
  protected $_username;

  /**
   * @var string
   */
  protected $_password;

  /**
   * @var string
   */
  protected $_url;

  /**
   * @var CookieJar
   */
  protected $_cookieJar;

  /**
   * @param string $username
   * @param string $password
   * @param string $url
   */
  public function __construct($username, $password, $url = 'https://what.cd')
  {
    $this->_username = $username;
    $this->_password = $password;
    $this->setUrl($url);
  }

  /**
   * @return IndexResponse
   */
  public function getIndex()
  {
    $response = $this->_get(
      [
        'action' => 'index',
      ]
    );

    return new IndexResponse($response);
  }

  /**
   * @param int $userId - id of the user to display
   *
   * @return UserResponse
   */
  public function getUser($userId)
  {
    $response = $this->_get(
      [
        'action' => 'user',
        'id'     => $userId,
      ]
    );

    return new UserResponse($response);
  }

  /**
   * @param int    $page       - page number to display
   * @param string $type       - GazelleMessagesType
   * @param string $sort       - GazelleMessagesSort
   * @param string $search     - filter messages by search string
   * @param string $searchType - GazelleMessagesSearchType
   *
   * @return InboxResponse
   */
  public function getInbox(
    $page = 1,
    $type = GazelleMessagesType::INBOX,
    $sort = GazelleMessagesSort::NONE,
    $search = null,
    $searchType = null
  )
  {
    $response = new InboxResponse(
      $this->_get(
        [
          'action'     => 'inbox',
          'page'       => $page,
          'type'       => $type,
          'sort'       => $sort,
          'search'     => $search,
          'searchtype' => $searchType,
        ]
      )
    );

    foreach($response->messages as $k => $message)
    {
      $response->messages[$k] = new InboxResultResponse($message);
    }

    return $response;
  }

  /**
   * @param int $conversationId - id of the message to display
   *
   * @return InboxConversationResponse
   */
  public function getInboxConversation($conversationId)
  {
    $response = new InboxConversationResponse(
      $this->_get(
        [
          'action' => 'inbox',
          'type'   => 'viewconv',
          'id'     => $conversationId,
        ]
      )
    );

    foreach($response->messages as $k => $conversation)
    {
      $response->messages[$k] = new InboxConversationResultResponse(
        $conversation
      );
    }

    return $response;
  }

  /**
   * @param string $type  - GazelleTopTenType
   * @param int    $limit - one of 10, 100, 250
   *
   * @return TopTenResponse[]
   */
  public function getTopTen($type = GazelleTopTenType::TORRENTS, $limit = 10)
  {
    $response = $this->_get(
      [
        'action' => 'top10',
        'type'   => $type,
        'limit'  => $limit,
      ]
    );

    foreach($response as $k => $section)
    {
      $response[$k] = new TopTenResponse($section);

      foreach($response[$k]->results as $k2 => $result)
      {
        $response[$k]->results[$k2] = new TopTenResultResponse($result);
      }
    }

    return $response;
  }

  /**
   * @param string $search - The search term
   * @param int    $page   - page to display
   *
   * @return UserSearchResponse
   */
  public function getUsers($search, $page = 1)
  {
    $response = new UserSearchResponse(
      $this->_get(
        [
          'action' => 'usersearch',
          'search' => $search,
          'page'   => $page,
        ]
      )
    );

    foreach($response->results as $k => $user)
    {
      $response->results[$k] = new UserSearchResultResponse($user);
    }

    return $response;
  }

  /**
   * @param string   $search     - search term
   * @param int      $page       - page to display
   * @param string[] $tags       - tags to search
   * @param int      $tagsType   - GazelleRequestsTagsType
   * @param bool     $showFilled - GazelleRequestsShowFilled
   *
   * @return RequestsResponse
   */
  public function getRequests(
    $search = '',
    $page = 1,
    $tags = [],
    $tagsType = GazelleRequestsTagsType::ANY,
    $showFilled = GazelleRequestsShowFilled::HIDE_FILLED
  )
  {
    $tags = implode(',', $tags);

    $response = new RequestsResponse(
      $this->_get(
        [
          'action'      => 'requests',
          'search'      => $search,
          'page'        => $page,
          'tag'         => $tags,
          'tags_type'   => $tagsType,
          'show_filled' => $showFilled,
        ]
      )
    );

    foreach($response->results as $k => $request)
    {
      $response->results[$k] = new RequestsResultResponse($request);
    }

    return $response;
  }

  /**
   * @param string $searchString - string to search for
   * @param int    $page         - page to display
   *
   * @return TorrentSearchResponse
   */
  public function getTorrents($searchString, $page = 1)
  {
    $response = new TorrentSearchResponse(
      $this->_get(
        [
          'action'    => 'browse',
          'searchstr' => $searchString,
          'page'      => $page,
        ]
      )
    );

    foreach($response->results as $k => $torrent)
    {
      $response->results[$k] = new TorrentSearchResultResponse($torrent);
    }

    return $response;
  }

  /**
   * @return BookmarkArtistResponse[]
   */
  public function getArtistBookmarks()
  {
    $response = $this->_get(
      [
        'action' => 'bookmarks',
        'type'   => 'artists',
      ]
    );

    $response = Arrays::value($response, 'artists', []);

    foreach($response as $k => $bookmark)
    {
      $response[$k] = new BookmarkArtistResponse($bookmark);
    }

    return $response;
  }

  /**
   * @return BookmarkTorrentResponse[]
   */
  public function getTorrentBookmarks()
  {
    $response = $this->_get(
      [
        'action' => 'bookmarks',
        'type'   => 'torrents',
      ]
    );

    $response = Arrays::value($response, 'bookmarks', []);

    foreach($response as $k => $bookmark)
    {
      $response[$k] = new BookmarkTorrentResponse($bookmark);
    }

    return $response;
  }

  /**
   * @param bool $showUnread - 1 to show only unread, 0 for all subscriptions
   *
   * @return SubscriptionResponse[]
   */
  public function getSubscriptions($showUnread = true)
  {
    $response = $this->_get(
      [
        'action'     => 'subscriptions',
        'showunread' => $showUnread ? 1 : 0,
      ]
    );

    $response = Arrays::value($response, 'threads', []);

    foreach($response as $k => $item)
    {
      $response[$k] = new SubscriptionResponse($item);
    }

    return $response;
  }

  /**
   * @return ForumCategoriesResponse[]
   */
  public function getForumCategories()
  {
    $response = $this->_get(
      [
        'action' => 'forum',
        'type'   => 'main',
      ]
    );

    $response = Arrays::value($response, 'categories', []);

    foreach($response as $k => $section)
    {
      $response[$k] = new ForumCategoriesResponse($section);

      foreach($response[$k]->forums as $k2 => $result)
      {
        $response[$k]->forums[$k2] = new ForumCategoriesResultResponse($result);
      }
    }

    return $response;
  }

  /**
   * @param int $forumId - id of the forum to display
   * @param int $page    - the page to display
   *
   * @return ForumResponse
   */
  public function getForum($forumId, $page = 1)
  {
    $response = new ForumResponse(
      $this->_get(
        [
          'action'  => 'forum',
          'type'    => 'viewforum',
          'forumid' => $forumId,
          'page'    => $page,
        ]
      )
    );

    foreach($response->threads as $k => $message)
    {
      $response->threads[$k] = new ForumResultResponse($message);
    }

    return $response;
  }

  /**
   * @param int  $threadId       - id of the thread to display
   * @param int  $postId         - response will be the page including the post with this id
   * @param int  $page           - page to display
   * @param bool $updateLastRead - set to 1 to not update the last read id
   *
   * @return ForumThreadResponse
   */
  public function getForumThread(
    $threadId, $postId = null, $page = 1, $updateLastRead = false
  )
  {
    $response = new ForumThreadResponse(
      $this->_get(
        [
          'action'         => 'forum',
          'type'           => 'viewthread',
          'threadid'       => $threadId,
          'postid'         => $postId,
          'page'           => $page,
          'updatelastread' => $updateLastRead ? 1 : 0,
        ]
      )
    );

    foreach($response->posts as $k => $message)
    {
      $response->posts[$k] = new ForumThreadResultResponse($message);
    }

    return $response;
  }

  /**
   * @param int    $artistId   - artist's id
   * @param string $artistName - Artist's Name
   *
   * @return ArtistResponse
   */
  public function getArtist($artistId = null, $artistName = null)
  {
    return new ArtistResponse(
      $this->_get(
        [
          'action'     => 'artist',
          'id'         => $artistId,
          'artistname' => $artistName,
        ]
      )
    );
  }

  /**
   * @param int    $torrentId - torrent's id
   * @param string $hash      - torrent's hash
   *
   * @return TorrentResponse
   */
  public function getTorrent($torrentId = null, $hash = null)
  {
    if($hash)
    {
      $hash = strtoupper($hash);
    }

    $response = new TorrentResponse(
      $this->_get(
        [
          'action' => 'torrent',
          'id'     => $torrentId,
          'hash'   => $hash,
        ]
      )
    );

    $response->group = new TorrentGroupInfoResponse($response->group);
    $response->torrent = new TorrentResultResponse($response->torrent);

    return $response;
  }

  /**
   * @param int    $groupId - torrent's group id
   * @param string $hash    - hash of a torrent in the torrent group
   *
   * @return TorrentGroupResponse
   */
  public function getTorrentGroup($groupId = null, $hash = null)
  {
    if($hash)
    {
      $hash = strtoupper($hash);
    }

    $response = new TorrentGroupResponse(
      $this->_get(
        [
          'action' => 'torrentgroup',
          'id'     => $groupId,
          'hash'   => $hash,
        ]
      )
    );

    $response->group = new TorrentGroupInfoResponse($response->group);

    foreach($response->torrents as $k => $request)
    {
      $response->torrents[$k] = new TorrentGroupResultResponse($request);
    }

    return $response;
  }

  /**
   * @param int $requestId - request id
   * @param int $page      - page of the comments to display
   *
   * @return RequestResponse
   */
  public function getRequest($requestId, $page = 1)
  {
    return new RequestResponse(
      $this->_get(
        [
          'action' => 'request',
          'id'     => $requestId,
          'page'   => $page,
        ]
      )
    );
  }

  /**
   * @param int $collageId - collage's id
   *
   * @return CollageResponse
   */
  public function getCollage($collageId)
  {
    $response = new CollageResponse(
      $this->_get(
        [
          'action' => 'collage',
          'id'     => $collageId,
        ]
      )
    );

    foreach($response->torrentgroups as $k => $request)
    {
      $response->torrentgroups[$k] = new CollageResultResponse($request);
    }

    return $response;
  }

  /**
   * @param int $page - page number to display
   *
   * @return NotificationsResponse
   */
  public function getNotifications($page = 1)
  {
    $response = new NotificationsResponse(
      $this->_get(
        [
          'action' => 'notifications',
          'page'   => $page,
        ]
      )
    );

    foreach($response->results as $k => $request)
    {
      $response->results[$k] = new NotificationsResultResponse($request);
    }

    return $response;
  }

  /**
   * @param int $artistId - id of artist
   * @param int $limit    - maximum number of results to return (fewer might be returned)
   *
   * @return SimilarArtistsResponse
   */
  public function getSimilarArtists($artistId, $limit = 10)
  {
    $response = $this->_get(
      [
        'action' => 'similar_artists',
        'id'     => $artistId,
        'limit'  => $limit,
      ]
    );

    $return = new SimilarArtistsResponse();
    foreach($response as $artist)
    {
      $return->items[] = new SimilarArtistsResultResponse($artist);
    }
    return $return;
  }

  /**
   * @return AnnouncementsResponse
   */
  public function getAnnouncements()
  {
    $response = new AnnouncementsResponse(
      $this->_get(
        [
          'action' => 'announcements',
        ]
      )
    );

    foreach($response->announcements as $k => $request)
    {
      $response->announcements[$k] = new AnnouncementsResultResponse($request);
    }

    foreach($response->blogPosts as $k => $request)
    {
      $response->blogPosts[$k] = new AnnouncementsBlogResultResponse($request);
    }

    return $response;
  }

  /**
   * @param $url
   *
   * @return $this
   */
  public function setUrl($url)
  {
    $this->_url = trim($url, '/');
    return $this;
  }

  /**
   * @param CookieJar $cookieJar
   *
   * @return $this
   */
  public function setCookieJar(CookieJar $cookieJar)
  {
    $this->_cookieJar = $cookieJar;
    return $this;
  }

  /**
   * @return CookieJar
   */
  public function getCookieJar()
  {
    return $this->_cookieJar;
  }

  /**
   * @param array $params
   *
   * @return mixed
   *
   * @throws GazelleApiFailureException
   * @throws CurlException
   * @throws CurlInvalidJsonException
   */
  protected function _get($params = [])
  {
    // Go and get a session cookie
    if(!$this->_cookieJar instanceof CookieJar)
    {
      $login = Curl
        ::post(
          $this->_url . '/login.php',
          [
            'username' => $this->_username,
            'password' => $this->_password,
          ]
        )
        ->run();

      $this->_cookieJar = $login->getCookies();
    }

    // Make the request
    $response = Curl
      ::get($this->_url . '/ajax.php', $params)
      ->setCookies($this->_cookieJar)
      ->run()
      ->getJson();

    if(isset($response['status']))
    {
      if($response['status'] != GazelleApiStatus::SUCCESS)
      {
        throw new GazelleApiFailureException();
      }
      return $response['response'];
    }
    else
    {
      return $response;
    }
  }
}
