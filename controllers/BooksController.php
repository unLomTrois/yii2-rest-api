<?php

namespace app\controllers;

use yii\rest\ActiveController;

class BooksController extends ActiveController
{
    public $modelClass = 'app\models\Books';

    // public $serializer = [
    //     'class' => 'yii\rest\Serializer',
    //     'collectionEnvelope' => 'items',
    // ];
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

        // отключить действия "delete" и "create"
        // unset($actions['delete'], $actions['create']);

        // настроить подготовку провайдера данных с помощью метода "prepareDataProvider()"
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new \app\models\BooksSearch();

        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
