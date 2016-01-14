<?php
namespace Jleagle\Gazelle;

use Jleagle\CurlWrapper\Curl;
use Jleagle\CurlWrapper\Header\CookieJar;
use Jleagle\Gazelle\Enums\BookmarkType;

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
    $this->_url = trim($url, '/');
  }

  /**
   * @return array
   */
  public function getIndex()
  {
    return $this->_get(
      [
        'action' => 'index',
      ]
    );
  }

  /**
   * @param int $id - id of the user to display
   *
   * @return array
   */
  public function getUser($id)
  {
    return $this->_get(
      [
        'action' => 'user',
        'id'     => $id,
      ]
    );
  }

  /**
   * @param int    $page       - page number to display
   * @param string $type       - one of: inbox or sentbox
   * @param string $sort       - if set to "unread" then unread messages come first
   * @param string $search     - filter messages by search string
   * @param string $searchType - one of: subject, message, user
   *
   * @return array
   */
  public function getInbox(
    $page = 1, $type = 'inbox', $sort = null, $search = null, $searchType = null
  )
  {
    return $this->_get(
      [
        'action'     => 'inbox',
        'page'       => $page,
        'type'       => $type,
        'sort'       => $sort,
        'search'     => $search,
        'searchtype' => $searchType,
      ]
    );
  }

  /**
   * @param int $id - id of the message to display
   *
   * @return array
   */
  public function getInboxConversation($id)
  {
    return $this->_get(
      [
        'action' => 'inbox',
        'type'   => 'viewconv',
        'id'     => $id,
      ]
    );
  }

  /**
   * @param string $type  - one of: torrents, tags, users
   * @param int    $limit - one of 10, 25, 100
   *
   * @return array
   */
  public function getTopTen($type = 'torrents', $limit = 25)
  {
    return $this->_get(
      [
        'action' => 'top10',
        'type'   => $type,
        'limit'  => $limit,
      ]
    );
  }

  /**
   * @param string $search - The search term
   * @param int    $page   - page to display
   *
   * @return array
   */
  public function searchUsers($search, $page = 1)
  {
    return $this->_get(
      [
        'action' => 'usersearch',
        'search' => $search,
        'page'   => $page,
      ]
    );
  }

  /**
   * @param string $search      - search term
   * @param string $tag         - tags to search by (comma separated)
   * @param int    $page        - page to display
   * @param int    $tags_type   - 0 for any, 1 for match all
   * @param bool   $show_filled - Include filled requests in results - true or false
   *
   * @return mixed
   */
  public function getRequests(
    $search = '', $tag = '', $page = 1, $tags_type = 0, $show_filled = false
  )
  {
    return $this->_get(
      [
        'action'      => 'requests',
        'search'      => $search,
        'page'        => $page,
        'tag'         => $tag,
        'tags_type'   => $tags_type,
        'show_filled' => $show_filled,
      ]
    );
  }

  /**
   * @param string $searchstr - string to search for
   * @param int    $page      - page to display
   *
   * @return array
   */
  public function searchTorrents($searchstr, $page = 1)
  {
    return $this->_get(
      [
        'action'    => 'browse',
        'searchstr' => $searchstr,
        'page'      => $page,
      ]
    );
  }

  /**
   * @param $type - BookmarkType
   *
   * @return array
   */
  public function getBookmarks($type = BookmarkType::TORRENTS)
  {
    return $this->_get(
      [
        'action' => 'bookmarks',
        'type'   => $type,
      ]
    );
  }

  /**
   * @param int $showunread - 1 to show only unread, 0 for all subscriptions
   *
   * @return array
   */
  public function getSubscriptions($showunread = 1)
  {
    return $this->_get(
      [
        'action'     => 'subscriptions',
        'showunread' => $showunread,
      ]
    );
  }

  /**
   * @return array
   */
  public function getForumCategories()
  {
    return $this->_get(
      [
        'action' => 'forum',
        'type'   => 'main',
      ]
    );
  }

  /**
   * @param int $forumid - id of the forum to display
   * @param int $page    - the page to display
   *
   * @return array
   */
  public function getForum($forumid, $page = 1)
  {
    return $this->_get(
      [
        'action'  => 'forum',
        'type'    => 'viewforum',
        'forumid' => $forumid,
        'page'    => $page,
      ]
    );
  }

  /**
   * @param int $threadid       - id of the thread to display
   * @param int $postid         - response will be the page including the post with this id
   * @param int $page           - page to display
   * @param int $updatelastread - set to 1 to not update the last read id
   *
   * @return array
   */
  public function getForumThread(
    $threadid, $postid = null, $page = 1, $updatelastread = 0
  )
  {
    return $this->_get(
      [
        'action'         => 'forum',
        'type'           => 'viewthread',
        'threadid'       => $threadid,
        'postid'         => $postid,
        'page'           => $page,
        'updatelastread' => $updatelastread,
      ]
    );
  }

  /**
   * @param int    $id         - artist's id
   * @param string $artistname - Artist's Name
   *
   * @return array
   */
  public function getArtist($id = null, $artistname = null)
  {
    return $this->_get(
      [
        'action'     => 'artist',
        'id'         => $id,
        'artistname' => $artistname,
      ]
    );
  }

  /**
   * @param int    $id   - torrent's id
   * @param string $hash - torrent's hash
   *
   * @return array
   */
  public function getTorrent($id = null, $hash = null)
  {
    $hash = strtoupper($hash);

    return $this->_get(
      [
        'action' => 'torrent',
        'id'     => $id,
        'hash'   => $hash,
      ]
    );
  }

  /**
   * @param int    $id   - torrent's group id
   * @param string $hash - hash of a torrent in the torrent group
   *
   * @return array
   */
  public function getTorrentGroup($id = null, $hash = null)
  {
    $hash = strtoupper($hash);

    return $this->_get(
      [
        'action' => 'torrentgroup',
        'id'     => $id,
        'hash'   => $hash,
      ]
    );
  }

  /**
   * @param int $id   - request id
   * @param int $page - page of the comments to display
   *
   * @return array
   */
  public function getRequest($id, $page = 1)
  {
    return $this->_get(
      [
        'action' => 'request',
        'id'     => $id,
        'page'   => $page,
      ]
    );
  }

  /**
   * @param int $id - collage's id
   *
   * @return array
   */
  public function getCollage($id)
  {
    return $this->_get(
      [
        'action' => 'collage',
        'id'     => $id,
      ]
    );
  }

  /**
   * @param int $page - page number to display
   *
   * @return array
   */
  public function getNotifications($page = 1)
  {
    return $this->_get(
      [
        'action' => 'notifications',
        'page'   => $page,
      ]
    );
  }

  /**
   * @param int $id    - id of artist
   * @param int $limit - maximum number of results to return (fewer might be returned)
   *
   * @return array
   */
  public function getSimilarArtists($id, $limit = 10)
  {
    return $this->_get(
      [
        'action' => 'similar_artists',
        'id'     => $id,
        'limit'  => $limit,
      ]
    );
  }

  /**
   * @return array
   */
  public function getAnnouncements()
  {
    return $this->_get(
      [
        'action' => 'announcements',
      ]
    );
  }

  /**
   * @param $url
   *
   * @return $this
   */
  public function setUrl($url)
  {
    $this->_url = $url;
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
    return Curl
      ::get($this->_url . '/ajax.php', $params)
      ->setCookies($this->_cookieJar)
      ->run()
      ->getJson();
  }
}
