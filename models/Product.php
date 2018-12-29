<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int    $id
 * @property int    $category_id
 * @property string $name
 * @property string $content
 * @property double $price
 * @property string $keywords
 * @property string $description
 * @property string $image
 * @property string $hit
 * @property string $new
 * @property string $sale
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id'], 'integer'],
            [['content', 'hit', 'new', 'sale'], 'string'],
            [['price'], 'number'],
            [['name', 'keywords', 'description', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'category_id' => 'Category ID',
            'name'        => 'Name',
            'content'     => 'Content',
            'price'       => 'Price',
            'keywords'    => 'Keywords',
            'description' => 'Description',
            'image'       => 'Image',
            'hit'         => 'Hit',
            'new'         => 'New',
            'sale'        => 'Sale',
        ];
    }

    public function getImage()
    {
        return '@web/images/products/' . $this->image;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
