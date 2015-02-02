<?php
namespace Jleagle\Gazelle;

use \GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class Gazelle
{

    private $username;
    private $password;
    private $loggedIn = false;
    private $api;
    private $query = array();
    private $cookieJar;

    /**
     * @param $username
     * @param $password
     * @param string $api
     */
    public function __construct($username, $password, $api = 'https://what.cd/')
    {
        $this->username = $username;
        $this->password = $password;
        $this->api = $api;
        $this->cookieJar = new CookieJar();
    }

    /**
     * @param $method
     * @param array $value
     * @return $this
     */
    public function __call($method, $value = array())
    {
        if (!empty($value)){ $value = $value[0]; }

        if (empty($this->query)){
            $this->add('action', $method);
        }else{
            $this->add($method, $value);
        }

        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get()
    {
        if (!$this->loggedIn){
            $this->login();
        }

        $url = $this->api . 'ajax.php?' . http_build_query($this->query);

        $client = new Client();
        $res = $client->get($url, array(
            'cookies' => $this->cookieJar
        ));

        if ($res->getStatusCode() == 200)
        {
            return $this->parse($res->getBody());
        }
        else
        {
            throw new \Exception('Invalid server response.');
        }

    }

    /**
     * @param $name
     * @param $value
     */
    private function add($name, $value)
    {
        $this->query[$name] = $value;
    }

    /**
     * @throws \Exception
     */
    private function login()
    {
        $url = $this->api . 'login.php';

        $client = new Client();
        $res = $client->post($url, array(
            'cookies' => $this->cookieJar,
            'body' => array(
                'username' => $this->username,
                'password' => $this->password,
                'keeplogged' => 1,
                'login' => 'Login',
            )
        ));

        if ($res->getStatusCode() == 200)
        {
            $this->loggedIn = true;
        }
        else
        {
            throw new \Exception('Can\'t login.');
        }
    }

    /**
     * @param $body
     * @return array
     * @throws \Exception
     */
    private function parse($body)
    {
        $array = json_decode($body, true);

        if ($array['status'] == 'success')
        {
            return $array['response'];
        }
        else
        {
            throw new \Exception($array['status']);
        }
    }
}
