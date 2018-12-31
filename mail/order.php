<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($session['cart'] as $id => $item) : ?>
            <tr>
                <td><a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></td>
                <td><?= $item['qty'] ?></td>
                <td>$<?= $item['price'] ?></td>
                <td>$<?= $item['qty'] * $item['price'] ?></td>
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