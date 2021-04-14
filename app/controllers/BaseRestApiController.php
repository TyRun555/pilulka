<?php

namespace app\controllers;

use Yii;
use yii\filters\ContentNegotiator;
use yii\helpers\Json;
use yii\rest\Controller;
use yii\web\Response;

class BaseRestApiController extends Controller
{
    protected $post;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ],
        ];
        return $behaviors;
    }

    public function beforeAction($action): bool
    {
        $headers = Yii::$app->response->headers;
        $headers->set('Access-Control-Allow-Origin', '*');
        $headers->set('Access-Control-Allow-Credentials', 'true');
        $headers->set('Access-Control-Max-Age', 3600);
        $headers->set('Access-Control-Allow-Methods', 'GET, OPTIONS, POST, DELETE, PUT');
        $headers->set('Access-Control-Allow-Headers', 'Content-Type, x-requested-with');
        if (Yii::$app->request->isOptions) {
            Yii::$app->response->statusCode = 200;
            return false;
        }
        $this->post = Json::decode(file_get_contents('php://input'), 1) ?? [];
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result): array
    {
        if ($action->id != 'error') {
            return $result;
        }
        return $this->actionError();
    }

    public function actionError(): array
    {
        Yii::$app->response->statusCode = 404;
        return ['error' => 'Unknown action'];
    }

}