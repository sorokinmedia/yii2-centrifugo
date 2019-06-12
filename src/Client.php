<?php

namespace sorokinmedia\centrifugo;

use phpcent\Client as CentrifugoClient;
use yii\base\Model;

/**
 * Class Centrifugo
 * @package yii2\centrifugo
 * @property string $host
 * @property string $_secret write-only
 * @property string $_apikey write-only
 * @property CentrifugoClient $_client read-only
 * @mixin CentrifugoClient
 */
class Client extends Model
{
    public $host;
    protected $_secret;
    protected $_apikey;
    protected $_client;

    /**
     * @param string $value
     */
    public function setSecret(string $value): void
    {
        $this->_secret = $value;
    }

    /**
     * @param $value
     */
    public function setApikey(string $value): void
    {
        $this->_apikey = $value;
    }

    /**
     * @param string $name
     * @param array $params
     * @return mixed
     */
    public function __call($name, $params)
    {
        $client = $this->getClient();
        if (method_exists($client, $name)) {
            return call_user_func_array([$client, $name], $params);
        }
        return parent::__call($name, $params);
    }

    /**
     * @return CentrifugoClient
     */
    public function getClient(): CentrifugoClient
    {
        if (null === $this->_client) {
            $this->initClient();
        }
        return $this->_client;
    }

    /**
     * initialize client
     */
    public function initClient(): void
    {
        $this->_client = new CentrifugoClient($this->host);
        $this->_client->setSecret($this->_secret);
        $this->_client->setApikey($this->_apikey);
    }
}
