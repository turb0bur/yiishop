<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($product, $qty = 1)
    {
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'qty'   => $qty,
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $product->image
            ];
        }
        $_SESSION['cart.qty']   = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.total'] = isset($_SESSION['cart.total']) ? $_SESSION['cart.total'] + $qty * $product->price : $qty * $product->price;
    }

    public function recalculate($id)
    {
        if (!isset($_SESSION['cart'][$id])) {
            return false;
        } else {
            $qtySubtract   = $_SESSION['cart'][$id]['qty'];
            $totalSubtract = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];

            $_SESSION['cart.qty']   -= $qtySubtract;
            $_SESSION['cart.total'] -= $totalSubtract;
            unset($_SESSION['cart'][$id]);
        }
    }
}