<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItem;
use Yii;

class CartController extends AppController
{
    public function actionAdd()
    {
        $id      = Yii::$app->request->get('id');
        $qty     = (int)Yii::$app->request->get('qty');
        $qty     = !$qty ? 1 : $qty;
        $product = Product::findOne($id);

        if (empty($product)) return false;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);

        if (!Yii::$app->request->isAjax) {
            Yii::$app->session->setFlash('success', 'Product was successfully added!');

            return $this->redirect(Yii::$app->request->getReferrer());
        }
        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.total');

        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        $id      = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalculate($id);

        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionGetCart()
    {
        $session = Yii::$app->session;
        $session->open();

        $this->layout = false;

        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Cart');
        $order = new Order();

        if ($order->load(Yii::$app->request->post())) {
            $order->quantity = $session['cart.qty'];
            $order->total    = $session['cart.total'];

            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Order successfully accepted. Our manager will write you as soon as the order will be processed');

                Yii::$app->mailer->compose('order', compact('session'))
                    ->setFrom(['turb0bur@ukr.net' => 'YiiShop'])
                    ->setTo([$order->email, Yii::$app->params['adminEmail']])
                    ->setSubject('Order')
                    ->send();

                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.total');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Oops! Something went wrong...');
            }
        }

        return $this->render('cart', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $order_item               = new OrderItem();
            $order_item->order_id     = $order_id;
            $order_item->product_id   = $id;
            $order_item->product_name = $item['name'];
            $order_item->quantity     = $item['qty'];
            $order_item->price        = $item['price'];
            $order_item->save();
        }
    }
}