<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $author_id
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['author_id'], 'default', 'value' => null],
            [['author_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'description',
            'author' => function () {

                if ($this->author_id !== null) {
                    $author = Author::find()
                        ->where(['id' => $this->author_id])
                        ->one();

                    return [
                        "name" => $author["name"],
                        "id" => $author["id"],
                    ];
                }
                return "Неизвестно";
            }
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BooksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BooksQuery(get_called_class());
    }
}
