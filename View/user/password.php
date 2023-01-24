<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row justify-content-center">
    <div class="col-6">
        <?php
            require BASE_VIEW_PATH . 'errors/formErrors.php'
        ?>
        <div class="row spacer-content-top"></div>
        <div class="row spacer-content-top"></div>
        <div class="text-center mb-3 title spacer-content-top">Update Password</div>
        <form action="/DiamondDogsProject/user/settings/update-password" method="POST">
            <div class="mb-3 spacer-content-top">
                <label for="oldPassword" class="form-label">Old Password</label>
                <input class="form-control" id="oldPassword" type="password" name="oldPassword"/>
            </div>
            <div class="mb-3 spacer-content-top">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" id="password" type="password" name="password"/>
            </div>
            <div class="mb-3 spacer-content-top">
                <label for="passwordAgain" class="form-label">Validate Password</label>
                <input class="form-control" id="passwordAgain" type="password" name="passwordAgain"/>
            </div>
            <button type="submit" class="btn btn-warning btn-update align-center">Update</button>
        </form>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>