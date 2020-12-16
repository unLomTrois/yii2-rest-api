<?php

namespace app\models;

use yii\db\ActiveRecord;

class Books extends ActiveRecord
{
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['id', 'title', 'author'],
        ];
    }

    public function rules()
    {
        return [
            [['id', 'title', 'author'], 'safe'],
        ];
    }
}
