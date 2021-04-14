<?php

namespace app\controllers;

use app\controllers\base\BaseRestApiController;
use DateTime;
use DateTimeZone;
use stdClass;
use Yii;
use yii\web\View;

class TweetsController extends BaseRestApiController
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function verbs()
    {
        return [
            'last-html' => ['GET', 'OPTIONS'],
            'last-json' => ['GET', 'OPTIONS'],
        ];
    }

    /**
     * Sun Feb 25 18:11:01 +0000 2018
     * @return array
     */
    public function actionLastHtml()
    {
        $tweets = Yii::$app->twitterClient->getLastTweets();
        $view = new View();
        $response = [];
        foreach ($tweets as $tweet) {
            $response[] = $view->render('tweet');
        }
        return $response;
    }

    public function actionLastJson()
    {

        $rawTweets = Yii::$app->twitterClient->api('search/tweets.json?q=pilulka.cz %23pilulka', 'GET');
        $tweets = [];
        for ($i = 0; $i < 100; $i++) {
            $tweets[$i] = $tweets['statuses'][$i];
        }
        return $tweets;
    }

}
