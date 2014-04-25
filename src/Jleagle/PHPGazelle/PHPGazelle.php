<?php
namespace Jleagle\PHPGazelle;

use \GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Cookie\CookieJar;

class PHPGazelle
{

    private $username;
    private $password;
    private $api = 'https://what.cd/';
    private $query = array();

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

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

    public function get()
    {
        $url = http_build_query($this->query);
        $url = $this->api . 'ajax.php?' . $url;

        print_r($url);

        // Make cookie jar
        $jar = new CookieJar();

        // Make curl request
        $client = new Guzzle();
        $res = $client->post($url, [
            'cookies' => $jar,
            'body' => [
                'username' => $this->username,
                'password' => $this->password,
                'keeplogged' => 1,
                'login' => 'Login',
            ]
        ]);

        return $res->getBody();
    }

    private function add($name, $value)
    {
        $this->query[$name] = $value;
    }

}
