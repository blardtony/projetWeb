
<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row mt-5 justify-content-center">
    <div class="col-6">
        <div class="text-center title">Add Score</div>
        <?php
            require BASE_VIEW_PATH . 'errors/formErrors.php'
        ?>
        <form action="/DiamondDogsProject/group/games/<?=$params["idGame"]?>/add-score" method="post">
            <div class="mb-3">
                <label for="host_score" class="form-label">Home score : <?=$params["game"]->host;?></label>
                <input class="form-control" id="host_score" type="number" name="host_score"/>
            </div>
            <div class="mb-3">
                <label for="guest_score" class="form-label">Away score : <?=$params["game"]->guest;?></label>
                <input class="form-control" id="guest_score" type="number" name="guest_score"/>
            </div>
            <button type="submit" class="btn btn-warning btn-confirm">Add</button>
        </form>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>