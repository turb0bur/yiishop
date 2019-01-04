<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter'    => false
            ],
            [
                'attribute' => 'category_id',
                'value'     => 'category.name'
            ],
            'name',
//            'content:ntext',
            'price',
            //'keywords',
            //'description',
            //'image',
            [
                'attribute' => 'hit',
                'format'    => 'html',
                'value'     => function ($data) {
                    return !$data->hit ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>';
                }
            ],
            [
                'attribute' => 'new',
                'format'    => 'html',
                'value'     => function ($data) {
                    return !$data->new ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>';
                }
            ],
            [
                'attribute' => 'sale',
                'format'    => 'html',
                'value'     => function ($data) {
                    return !$data->sale ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
