<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row mt-5 justify-content-center">
    <div class="col-6">
        <div class="text-center title">Add Bet</div>
            <?php
                require BASE_VIEW_PATH . 'errors/formErrors.php'
            ?>
            <form action="/DiamondDogsProject/group/create" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input class="form-control" id="name" type="text" name="name"/>
                </div>
                <button type="submit" class="btn btn-warning btn-confirm">Create</button>
            </form>
        </div>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>