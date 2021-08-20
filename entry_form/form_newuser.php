<p>Add a new member to your household:</p>

<p>You can add them to classes in the next screen</p>

<form id="contact" action="" method="post">
    <div class="form-group col-md-8">
        <label for="firstname"></label>
        <input type="text" class="form-control" id="firstname" name="firstname"  placeholder="First Name" required>
        <label for="lastname"></label>
        <input type="text" class="form-control" id="lastname" name="lastname"  placeholder="Last Name" required>
        <label for="age"></label>
        <select name="age" id="age" class="form-control col-sm-12 col-lg-4 col-md-6" required>
            <option value="">Age</option>
            <?= $ageoption ?>
            <option value="16">Adult</option>
        </select>
    </div>

    <div class="form-group col-md-8 mt20">
        <input type="hidden" name="nu" value="add">
        <a href="index.php" class="btn btn-secondary">Cancel</a>
        <button class="btn btn-primary" id="submitButton" data-badge="inline" name="button" value="adduser">Add</button>
    </div>
</form>
