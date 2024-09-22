// Data validation
<?php
	$product_description = filter_input(INPUT_POST, 'product_description');
	$list_price = filter_input(INPUT_POST, 'list_price');
	$discount_percent = filter_input(INPUT_POST, 'discount_percent');

    if ($product_description === null || $list_price === false || $discount_percent === false) {
        echo "Please provide valid inputs.";
        exit();
    }
	
        $discount = $list_price * $discount_percent * .01;
        $discount_price = $list_price - $discount;

        // Sales tax calculation (8%)
        $sales_tax_rate = 8; // 8%
        $sales_tax = $discount_price * ($sales_tax_rate / 100);
        $total_price = $discount_price + $sales_tax;
        
        $list_price_f = "$".number_format($list_price, 2);
        $discount_percent_f = $discount_percent."%";
        $discount_f = "$".number_format($discount, 2);
        $discount_price_f = "$".number_format($discount_price, 2);
        $sales_tax_f = "$".number_format($sales_tax, 2);
        $total_price_f = "$".number_format($total_price, 2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br>

        <label>List Price:</label>
        <span><?php echo $list_price_f; ?></span><br>

        <label>Discount Percent:</label>
        <span><?php echo $discount_percent_f; ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_f; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_f; ?></span><br>

        <!--sales tax and total price -->
        <label>Sales Tax Rate:</label>
        <span><?php echo $sales_tax_rate."%"; ?></span><br>

        <label>Sales Tax Amount:</label>
        <span><?php echo $sales_tax_f; ?></span><br>

        <label>Total Price (after tax):</label>
        <span><?php echo $total_price_f; ?></span><br>
    </main>
</body>
</html>