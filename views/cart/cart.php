<?php

use yii\bootstrap\ActiveForm;

?>

<div class="container">
    <?php if (!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id => $item) : ?>
                    <tr>
                        <td><?= \yii\helpers\Html::img("@web/images/products/" . $item['image'], ['alt' => $item['name'], 'height' => 80]) ?></td>
                        <td><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td>$<?= $item['price'] ?></td>
                        <td>$<?= $item['qty'] * $item['price'] ?></td>
                        <td><span data-id="<?= $id; ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">Quantity:</td>
                    <td><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="5">Total:</td>
                    <td><?= $session['cart.total'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($order, 'name'); ?>
                <?= $form->field($order, 'email'); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($order, 'phone'); ?>
                <?= $form->field($order, 'address'); ?>
            </div>
        </div>
        <?= \yii\helpers\Html::submitButton('Check out', ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
        <hr>
    <?php else : ?>
        <h3 class="text-center">The cart is empty!</h3>
    <?php endif; ?>
</div>