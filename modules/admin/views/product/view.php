<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category',
                'label'     => 'Category',
                'value'     => $model->category->name
            ],
            'name',
            'content:html',
            'price',
            'keywords',
            'description',
            'image',
            [
                'attribute' => 'hit',
                'format'    => 'html',
                'value'     => function ($model) {
                    return !$model->hit ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>';
                }
            ],
            [
                'attribute' => 'new',
                'format'    => 'html',
                'value'     => function ($model) {
                    return !$model->new ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>';
                }
            ],
            [
                'attribute' => 'sale',
                'format'    => 'html',
                'value'     => function ($model) {
                    return !$model->sale ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>';
                }
            ],
        ],
    ]) ?>

</div>
