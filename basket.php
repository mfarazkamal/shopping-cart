<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Dummy product data
$products = [
    'R01' => ['name' => 'Red Widget', 'price' => 32.95],
    'G01' => ['name' => 'Green Widget', 'price' => 24.95],
    'B01' => ['name' => 'Blue Widget', 'price' => 07.95],
];

// Handle add or remove from cart
if (isset($_POST['update_cart'])) {
    $product_code = $_POST['product_code'];
    $action = $_POST['action'];
    if ($action == 'add') {
        $_SESSION['cart'][$product_code]++;
    } elseif ($action == 'remove') {
        $_SESSION['cart'][$product_code]--;
        if ($_SESSION['cart'][$product_code] <= 0) {
            unset($_SESSION['cart'][$product_code]);
        }
    }
}

// Calculate total items and total price
$total_items = array_sum($_SESSION['cart']);
$total_price = 0;

foreach ($_SESSION['cart'] as $code => $quantity) {
    if (isset($products[$code])) {
        $total_price += $products[$code]['price'] * $quantity;
    }
}

// Apply special offer: Buy one red widget, get the second half price
if (isset($_SESSION['cart']['R01'])) {
    $red_widget_quantity = $_SESSION['cart']['R01'];
    $discounted_widgets = floor($red_widget_quantity / 2);
    $total_price -= $discounted_widgets * ($products['R01']['price'] / 2);
}

// Calculate delivery charge
$delivery_charge = 0;
if ($total_price < 50) {
    $delivery_charge = 4.95;
} elseif ($total_price < 90) {
    $delivery_charge = 2.95;
}

$total_price_with_delivery = $total_price + $delivery_charge;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .cart {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .cart-items, .payment-summary {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-items {
            flex: 0 0 60%;
        }
        .payment-summary {
            flex: 0 0 30%;
        }
        .cart-item-header, .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .cart-item-header {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .cart-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .cart-item-details {
            flex: 1;
            margin-left: 10px;
        }
        .cart-item-price, .cart-item-quantity, .cart-item-total, .cart-item-actions {
            flex: 0 0 15%;
            text-align: center;
        }
        .payment-summary h3 {
            margin-top: 0;
        }
        .payment-summary div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
        }
        .checkout-btn {
            display: block;
            width: 80%;
            margin: 1rem auto;
            background: #28a745;
            color: white;
            text-align: center;
            padding: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.1em;
            cursor: pointer;
        }
        .update-btn {
            background: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cart">
            <div class="cart-items">
                <h2>Shopping Cart</h2>
                <div class="cart-item-header">
                    <div class="cart-item-details">Product</div>
                    <div class="cart-item-price">Unit Price</div>
                    <div class="cart-item-quantity">Quantity</div>
                    <div class="cart-item-total">Total Price</div>
                    <div class="cart-item-actions">Actions</div>
                </div>
                <?php foreach ($_SESSION['cart'] as $code => $quantity) : ?>
                    <?php if (isset($products[$code])) : ?>
                    <div class="cart-item">
                        <div class="cart-item-details">
                            <h4><?php echo $products[$code]['name']; ?></h4>
                            <p>Code: <?php echo $code; ?></p>
                        </div>
                        <div class="cart-item-price">$<?php echo number_format($products[$code]['price'], 2); ?></div>
                        <div class="cart-item-quantity"><?php echo $quantity; ?></div>
                        <div class="cart-item-total">$<?php echo number_format($products[$code]['price'] * $quantity, 2); ?></div>
                        <div class="cart-item-actions">
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="product_code" value="<?php echo $code; ?>">
                                <input type="hidden" name="action" value="add">
                                <button type="submit" name="update_cart" class="update-btn">+</button>
                            </form>
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="product_code" value="<?php echo $code; ?>">
                                <input type="hidden" name="action" value="remove">
                                <button type="submit" name="update_cart" class="update-btn">-</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="payment-summary">
                <h3>Payment Summary</h3>
                <div>
                    <span>Subtotal</span>
                    <span>$<?php echo number_format($total_price, 2); ?></span>
                </div>
                <div>
                    <span>Delivery Charge</span>
                    <span>$<?php echo number_format($delivery_charge, 2); ?></span>
                </div>
                <div class="total">
                    <span>Total</span>
                    <span>$<?php echo number_format($total_price_with_delivery, 2); ?></span>
                </div>
                <a href="#" class="checkout-btn">Proceed to Checkout</a>
            </div>
        </div>

        <div class="productPage">
            <p>Go to <a href="index.php">Products</a> Page</p>
        </div>
    </div>
</body>
</html>
