<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;

class AuthorController extends ActiveController
{
    public $modelClass = "app\models\Author";

    public function behaviors()
    {

        return [
            [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }


    public function actions()
    {
        $actions = parent::actions();

        // настроить подготовку провайдера данных с помощью метода "prepareDataProvider()"
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new \app\models\AuthorSearch();

        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
