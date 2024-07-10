<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle add to cart action
if (isset($_POST['add_to_cart'])) {
    $product_code = $_POST['product_code'];
    if (isset($_SESSION['cart'][$product_code])) {
        $_SESSION['cart'][$product_code]++;
    } else {
        $_SESSION['cart'][$product_code] = 1;
    }
}

// Calculate total items in cart
$total_items = array_sum($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
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

        .cart-indicator {
            background: #064615;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 1.1em;
            cursor: pointer;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .product-item {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            flex: 0 0 30%;
            box-sizing: border-box;
        }

        .product-item img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .product-item h4,
        .product-item p,
        .product-item span {
            margin: 10px 0;
        }

        .add-to-cart-btn {
            display: block;
            width: 60%;
            margin: 1em auto;
            background: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            cursor: pointer;
        }

        .cart-link {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="cart-indicator">
        <a href="basket.php" class="cart-link"> Items in Cart: <span id="cart-count"><?php echo $total_items; ?></span></a>
        </div>
        <h2>Products</h2>
        <div class="product-list">
            <div class="product-item">
                <img src="https://htmlcolorcodes.com/assets/images/colors/dark-red-color-solid-background-1920x1080.png" alt="Product 1">
                <h4>Red Widget</h4>
                <p>Product Code: R01</p>
                <span>Price: $32.95</span>
                <form method="post" action="">
                    <input type="hidden" name="product_code" value="R01">
                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
            <div class="product-item">
                <img src="https://htmlcolorcodes.com/assets/images/colors/dark-green-color-solid-background-1920x1080.png" alt="Product 2">
                <h4>Green Widget</h4>
                <p>Product Code: G01</p>
                <span>Price: $24.95</span>
                <form method="post" action="">
                    <input type="hidden" name="product_code" value="G01">
                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
            <div class="product-item">
                <img src="https://htmlcolorcodes.com/assets/images/colors/baby-blue-color-solid-background-1920x1080.png" alt="Product 3">
                <h4>Blue Widget</h4>
                <p>Product Code: B01</p>
                <span>Price: $07.95</span>
                <form method="post" action="">
                    <input type="hidden" name="product_code" value="B01">
                    <button type="submit" name="add_to_cart" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
            <!-- Add more products as needed -->
        </div>
    </div>

</body>

</html>