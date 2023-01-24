<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row mt-5 justify-content-center">
    <div class="col-6">
        <h2 class="text-center title">Add User</h2>
            <?php
                require BASE_VIEW_PATH . 'errors/formErrors.php'
            ?>
            <form action="/DiamondDogsProject/group/add-user" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" type="email" name="email"/>
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-warning btn-confirm" style="margin-left:-9%;">Send Invite</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>