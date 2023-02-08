<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Cart</title>
</head>
<body>
    <div class="wrapper">
        <?php $this->load->view('shoppingspree/extras/header.php')?>
        <div class="container remove">
            <h1>Check out</h1>
            <div id="form">
                <div>Total: <p><?= $total_amount ?></p></div>
                <table>
                    <thead>
                        <tr>
                            <th>Item name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
                    if(!empty($orders))
                    {
                        foreach($orders as $order)
                        {
?>
                        <tr>
                            <td><?= $order['name'] ?></td>
                            <td><?= $order['quantity'] ?></td>
                            <td><?= $order['price'] ?></td>
                            <td><!-- -->
                                <form action="remove" method="post" id="remove">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <input type="submit" name="submit" value="X" class="delete">
                                </form>
                                <!-- -->
                            </td>
                        </tr>
<?php
                        }
                    }
?>
                    </tbody>
                </table>
            </div>
            <h1>Billing Info</h1>
            <form action="bill" method="post" id="bill">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address">
                <label for="card_number">Card number:</label>
                <input type="text" name="card_number" id="card_number">
                <input type="submit" value="Submit Order">
            </form>
        </div>
        <?php $this->load->view('shoppingspree/extras/footer.php')?>
    </div>
</body>
</html>