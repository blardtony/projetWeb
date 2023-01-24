<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row justify-content-center">
    <div class="col-6">
        <?php
            require BASE_VIEW_PATH . 'errors/formErrors.php'
        ?>
        <div class="row spacer-content-top"></div>
        <div class="row spacer-content-top"></div>

        <div class="text-center mb-3 title spacer-content-top">Update Pseudo</div>
        <form action="/DiamondDogsProject/user/settings/update-pseudo" method="POST">
            <div class="mb-3 spacer-content-top">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input class="form-control" id="pseudo" type="text" name="pseudo" value="<?= $_SESSION['user']['pseudo']?>"/>
            </div>

            <button type="submit" class="btn btn-warning btn-update align-center">Update</button>
        </form>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>