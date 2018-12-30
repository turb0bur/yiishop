<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $item) : ?>
                <tr>
                    <td><?= \yii\helpers\Html::img("@web/images/products/" . $item['image'], ['alt' => $item['name'], 'height' => 80]) ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>$<?= $item['price'] ?></td>
                    <td><span data-id="<?= $id; ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Quantity:</td>
                <td><?= $session['cart.qty'] ?></td>
            </tr>
            <tr>
                <td colspan="4">Total:</td>
                <td><?= $session['cart.total'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <h3 class="text-center">The cart is empty!</h3>
<?php endif; ?>
