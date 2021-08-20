
<p>Please select the categories you would like to enter.

<?php if($userdata['role'] == 1){    ?>
    <br><a href="/adminarea/">Or go to the <b>admin area</b>.</a>
<?php } ?>


</p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Classes Entered</th>
            <th scope="col">Update</th>
        </tr>
        </thead>

        <tbody>

        <?= $listusers->list ?>

        <?php if($userdata['scarecrow'] == 1 ){?>

            <tr>
                <td>
                    <p><b>Scarecrow</b></p>

                </td>
                <td colspan="2">
                    <b>Scarecrow's Name:</b> <?= $contact['scarecrow_name']?>
                    <br><b>Location:</b> <?= $contact['home_name_number']?>  <?= $contact['home_street']?> <?= $contact['home_postcode']?>
                    <br><b>Number:</b> <?= $contact['id']?>
                </td>

                <td><form id='contact' action='scarecrow.php' method='post'>
                        <input type='hidden' name='memberid' value='<?= $userdata['id'] ?>'>
                        <button class='btn btn-outline-info'  name='button' value='scarecrow'>Edit</button>
                    </form></td>
            </tr>

        <?php } ?>

        <tr>
            <td>
                <form id="contact" action="" method="post">
                    <button class="btn btn-outline-primary" name="button" value="new"> <i class="fa fa-plus"></i> new household member</button>
                </form>
            </td>
            <td>

            </td>
            <td>

              <?php if($userdata['scarecrow'] == 0 ){?>
                <form id='contact' action='scarecrow.php' method='post'>
                    <input type='hidden' name='memberid' value='<?= $userdata['id'] ?>'>
                    <button class='btn btn-outline-info'  name='button' value='scarecrow'><i class="fa fa-male"></i> Enter your scarecrow</button>
                </form>
                <?php } ?>
            </td>
            <td></td>
        </tr>

        </tbody>
    </table>

<div class="col-md-9">

    <?php

    switch (TRUW) {

        case $listusers->total_cost > 0 and $owed == 0:
            $topay =  "<h4>You are all paid up.</h4>";
            $hidden  = "hidden";
            break;
        case $owed == 0:
            $topay =  "<h5>Fees will be calculated when applicable.</h5>";
            $hidden  = "hidden";
            break;
        case $owed > 0:
            $topay =  "
            <h5>You have now registered your classes. You can either pay with PayPal or when you collect your Exhibitors Cards. </h5>
            <h5>Total amount to pay £" . number_format((float)$owed, 2, '.', '') . "</h5>";

            break;
        case $owed < 0:
            $topay =  "<h5>You are in credit by £" . number_format((float)abs($owed), 2, '.', '') . "</h5>
            <p>You can select more clases.</p>";
            $hidden  = "hidden";
            break;
    }
      ?>



<form>
    <h4>Payment:</h4>


    <?= $topay ?>
    <div class="row" id="paypalbutton" <?= $hidden ?>>
        <div id="paypal-button-container" class="col-lg-12 pb-3 align-center" >
        </div>

    </div>
    <input type="hidden" id="cart_total" name="cart_total" value="<?= $listusers->total_cost  ?>" />
    <input type="hidden" id="total_amount" name="total_amount" value="<?= $listusers->total_cost ?>" />
    <input type="hidden" id="shop_id" name="shop_id" value="<?= $userdata['id']  ?>" />

</form>



</div>