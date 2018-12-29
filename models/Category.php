<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "categories".
 *
 * @property int    $id
 * @property int    $parent_id
 * @property string $name
 * @property string $keywords
 * @property string $description
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'parent_id'   => 'Parent ID',
            'name'        => 'Name',
            'keywords'    => 'Keywords',
            'description' => 'Description',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class(), ['category_id' => 'id']);
    }
}
