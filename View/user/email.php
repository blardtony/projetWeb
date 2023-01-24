<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row justify-content-center">
    <div class="col-6">
        <?php
            require BASE_VIEW_PATH . 'errors/formErrors.php'
        ?>
        <div class="row spacer-content-top"></div>
        <div class="row spacer-content-top"></div>

        <div class="text-center mb-3 title spacer-content-top">Update Email</div>
        <form action="/DiamondDogsProject/user/settings/update-email" method="POST">
            <div class="mb-3 spacer-content-top">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" id="email" type="text" name="email" value="<?= $_SESSION['user']['email']?>"/>
            </div>

            <button type="submit" class="btn btn-warning btn-update align-center">Update</button>
        </form>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>