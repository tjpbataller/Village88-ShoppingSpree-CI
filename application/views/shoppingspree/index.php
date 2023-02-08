<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Shopping Spree</title>
</head>
<body>
    <div class="wrapper">
        <?php $this->load->view('shoppingspree/extras/header.php')?>
        <div class="container">
<?php
            foreach($products as $product)
            {
?>
            <form action="add" method="post"><!--
            ---><img src="<?= $product['image']?>" alt="This is the tshirt"><!--
            ---><label for=""><?= $product['name'] ?></label><!-- 
            ---><p><?= $product['price']?></p><!--
            ---><input type="hidden" name="id" value="<?= $product['id'] ?>"><!--
            ---><input type="number" name="quantity" min="0" class="number"><!--
            ---><input type="submit" value="Buy"><!--
        ---></form>
<?php
            }
?>
        </div>
        <?php $this->load->view('shoppingspree/extras/footer.php')?>
    </div>
</body>
</html>