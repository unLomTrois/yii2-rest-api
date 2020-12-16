<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Books;

class BooksController extends ActiveController
{
    public $modelClass = 'app\models\Books';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

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
        Yii::debug(Yii::$app->request->queryParams);
        return $searchModel->search(\Yii::$app->request->queryParams);
    
        // подготовить и вернуть провайдер данных для действия "index"
    }
}
