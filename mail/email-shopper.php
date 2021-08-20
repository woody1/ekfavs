<!doctype html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>ORDER CONFIRMATION</title>

    <style>
        body { font-family: 'Open Sans', sans-serif;
            color:#000000;}

        thead { background-color:#DEDCDC;}

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 5px;
            text-align: left;
            font-size:14px;
        }

        tr:hover {background-color: #f5f5f5}

        p {font-size:14px;}

        .small {font-size:10px;}

        .wrapper {
            display: flex;
        }
        .left {
            flex: 0 0 65%;
        }
        .right {
            flex: 1;
        }

    </style>

</head>

<body>

<div class="wrapper">

<div class="left">
<p>ORDER CONFIRMATION<br>
</p>
<p>Thank you <?= ucfirst($firstname) ." " . ucfirst($lastname) ?> for placing an order with <?= $company_name ?>.<br>
</p>

<p>Your order number is <?= $checkout->last_id ?></p>
<p>Details of your purchase are listed below. If you have any queries please contact <?= CONTACT_EMAIL ?> </p>
</div>
<div class="right">

    <img src="https://gbgjewellers.co.uk/images/sidelogo.png" width="100px">

</div>

</div>

<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <thead>
    <tr>
        <td width="50%">Invoice Address</td>
        <td width="50%">Delivery Address</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= $firstname ." " . $lastname ?></td>
        <td><?= $shiptoname ?></td>

    </tr>
    <tr>
        <td><?= $street ?></td>
        <td><?= $shiptostreet ?></td>
    </tr>
    <tr>
        <td><?= $street2 ?></td>
        <td><?= $shiptostreet2 ?></td>
    </tr>

    <tr>
        <td><?= $city ?></td>
        <td><?= $shiptocity ?></td>
    </tr>
    <tr>
        <td><?= $state ?></td>
        <td><?= $shiptostate ?></td>
    </tr>
    <tr>
        <td><?= $zip ?></td>
        <td><?= $shiptozip ?></td>
    </tr>
    <tr>
        <td><?= $countrycode ?></td>
        <td><?= $shiptocountry ?></td>
    </tr>
    </tbody>
</table>

<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <thead>
    <tr>
        <td>Email Address</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= $email ?></td>
    </tr>
    </tbody>
</table>

<p>&nbsp;</p>

<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <thead>
    <tr>
        <td width="62%">Item</td>
        <td width="18%">Qty</td>
        <td width="20%">Total</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?= $product_list->product_list ?>
    </tr>

    </tbody>
</table>

</p>
<table width="250" border="0" cellpadding="0">

    <thead>
    <tr>
        <td colspan="3">Totals</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td width="120">Products total: </td>
        <td width="10">&pound;</td>
        <td width="20" align="right"><?= number_format((($itemamt)),2, '.', '')  ?></td>
    </tr>
    <tr>
        <td>Delivery: </td>
        <td>&pound;</td>
        <td align="right"><?=  number_format(($shippingamt),2, '.', '') ?></td>
    </tr>

    <tr>
        <td>VAT element: @ <?= CURRENT_VAT ?> %</td>
        <td>&pound;</td>
        <td align="right"><?=  number_format(($VAT),2, '.', '') ?></td>
    </tr>
    <tr>
        <td>Total: </td>
        <td>&pound;</td>
        <td align="right"><?= number_format(($total_amount),2, '.', '') ?></td>
    </tr>
    </tbody>
</table>

<p>VAT Registraion number: <?= $vat_reg_number ?> </p>

<p class="small">This email and any files transmitted with it are confidential and intended solely for the individual or entity to whom they are addressed. If you have received this email in error, destroy it immediately. </p>
</body>
</html>
