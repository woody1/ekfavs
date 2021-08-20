
    <form id="contact" action="" method="post">

                    <?php  if ((validate_name(clean($_POST['firstname'])) === FALSE) and ($_POST['nb'] == 'cc')) {  ?>
                <div class="form-group alert-danger col-md-8">
                    <label for="firstname">Please check as First Name can only be letters.</label>
                    <?php }else{ ?>
                <div class="form-group col-md-8">
                    <label for="firstname">First Name</label>
                    <?php }  ?>
                    <input class="form-control" id="firstname" name="firstname" required value="<?= clean($_POST['firstname']) ?>">
                </div>

                    <?php  if ((validate_name(clean($_POST['lastname'])) === FALSE) and ($_POST['nb'] == 'cc')){  ?>
                <div class="form-group alert-danger col-md-8">
                    <label for="lastname">Please check as Last Name can only be letters.</label>
                    <?php $send = 'no';}else{ ?>
                <div class="form-group col-md-8">
                    <label for="lastname">Last Name</label>
                    <?php }  ?>
                    <input class="form-control" id="lastname" name="lastname" required value="<?= clean($_POST['lastname']) ?>">
                </div>


                    <?php  if ($email_lable) {  ?>
                <div class="form-group col-md-8 <?= $alert_warning ?>">
                    <label for="email"><?= $email_lable  ?></label>
                    <?php $send = 'no';}else{ ?>
                <div class="form-group col-md-8">
                    <label for="email">Email address</label>
                    <?php } ?>
                    <input type="email" class="form-control" id="email" name="email" value="<?= clean($_POST['email']) ?>" required>
                </div>


                    <div class="form-group col-md-8 mt20">
                        <input type="hidden" name="nb" value="cc">
                        <button class="btn btn-primary" id="submitButton" data-badge="inline" >Submit</button>
                    </div>
                    <!-- <button class="g-recaptcha g-recaptcha btn btn-primary" id="submitButton" data-sitekey="6LcicCwUAAAAAGsDoTDcRE7kQxcS6QJNLGhmvEJg" data-callback="captchaSubmit" data-badge="inline" >Submit</button> -->
                </div>
    </form>

    <div class="form-group">
      <b>  <a href="<?= _ROOT ?>signin/">Already have an account? Click here</a></b>
    </div>

