<?php
namespace app\components;

use Yii;
use yii\authclient\clients\Twitter;
use yii\authclient\OAuthToken;
use yii\base\Component;

/**
 * @property-read array $lastTweets
 */
class TwitterClient extends Component
{
    private $apiToken;
    public $client;

    public function init()
    {
        parent::init();
        // Создаем OAuthToken
        $token = new OAuthToken([
            'token' => Yii::$app->params['twitterAccessToken'],
            'tokenSecret' => Yii::$app->params['twitterAccessTokenSecret']
        ]);

        $this->client = new Twitter([
            'accessToken' => $token,
            'consumerKey' => Yii::$app->params['twitterApiKey'],
            'consumerSecret' => Yii::$app->params['twitterApiSecret']
        ]);

    }

    public function getLastTweets()
    {
        $rawTweets = $this->client->api('search/tweets.json?q=pilulka.cz %23pilulka', 'GET');
        $tweets = [];
        for ($i = 0; $i < 100; $i++) {
            $tweets[$i] = $tweets['statuses'][$i];
        }
        return $tweets;
    }
}