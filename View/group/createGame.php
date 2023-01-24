<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>

<div class="row mt-5 justify-content-center">
    <div class="col-6">
        <div class="text-center title">New Game</div>
        <?php
            require BASE_VIEW_PATH . 'errors/formErrors.php';
        ?>
        <form action="/DiamondDogsProject/group/games/create" method="post">
            <div class="mb-3">
                <label for="day" class="form-label">Day</label>
                <input class="form-control" id="day" type="number" name="day"/>
            </div>
            <div class="mb-3">
                <label for="host" class="form-label">Home</label>
                <select id="host" name="id_host" class="form-select">
                    <?php foreach($params['teams'] as $team):?>
                        <option value=<?=$team->id?>>
                            <?=$team->name?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="guest" class="form-label">Away</label>
                <select id="guest" name="id_guest" class="form-select">
                    <?php foreach($params['teams'] as $team):?>
                        <option value=<?=$team->id?>>
                            <?=$team->name?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="start_at" class="form-label">Date</label>
                <input class="form-control" id="start_at" type="datetime-local" name="start_at" min="<?= (new DateTime())->format('Y-m-d H:i');?>"/>
            </div>
            <button type="submit" class="btn btn-warning btn-create">Create</button>
        </form>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>
