
# Simple PHP Shopping Cart

This project implements a simple shopping cart using PHP sessions. It includes two main files: index.php for displaying the product listing and basket.php for managing the shopping cart and checkout process.

# Files
1. index.php
- Description: This file displays a list of products that users can add to their shopping cart. It also shows the total number of items currently in the cart.
### Key Features:
- Initializes the cart session if not already set.
- Handles adding products to the cart.
- Displays products with their images, names, codes, and prices.
- Provides an "Add to Cart" button for each product.
- Shows a cart indicator with a link to the basket.php page.

2. basket.php
- This file manages the shopping cart. It displays the items in the cart, allows users to update quantities, and calculates the total price, including any discounts and delivery charges.
### Key Features:
- Initializes the cart session if not already set.
- Contains dummy product data for Red Widget, Green Widget, and Blue Widget.
- Handles updating the cart (adding/removing items).
- Calculates total items, total price, and applies special offers (e.g., buy one red widget, get the second half price).
- Calculates delivery charges based on the total price.
- Displays the cart items, their details, quantities, and total prices.
- Provides buttons to increase or decrease the quantity of each item.
- Shows a payment summary with subtotal, delivery charge, and total price.
- Provides a link to proceed to checkout and a link to go back to the product listing page.

### Special Offers
- Red Widget Discount: Buy one red widget, get the second half price. This offer is applied in the basket.php file.

### Delivery Charges
 - If the total price is less than $50, a delivery charge of $4.95 is applied.
- If the total price is between $50 and $90, a delivery charge of $2.95 is applied.
- If the total price is $90 or more, delivery is free.

### Usage
- Viewing Products: Open index.php to see the list of products. Each product has an "Add to Cart" button.
- Adding to Cart: Click the "Add to Cart" button to add a product to the cart. The cart indicator at the top will update with the total number of items.
- Viewing Cart: Click on the cart indicator or open basket.php to view the items in the cart.
- Updating Cart: In the cart page, you can increase or decrease the quantity of each product. The total price will update accordingly.
- Checkout: Click the "Proceed to Checkout" button on the cart page to simulate the checkout process.