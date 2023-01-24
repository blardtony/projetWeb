<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row mt-5">
    <div class="col-12">
        <div class="text-center title" style="margin-left:-7%;">Your Ligue</div>
        <div class="accordion" id="accordionGames" style="margin-top:-4%;">
            <?php foreach ($params['games'] as $key => $games): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingday<?= $key; ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#day<?= $key; ?>" aria-expanded="false" aria-controls="day<?= $key; ?>">
                            Day <?= $key; ?>
                        </button>
                    </h2>
                    <div id="day<?= $key; ?>" class="accordion-collapse collapse " aria-labelledby="headingday<?= $key; ?>" data-bs-parent="#accordionGames">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Home</th>
                                    <th scope="col">Away</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Bet Score</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($games as $game):?>
                                <tr style="height: 50px;">
                                    <td class="align-middle"><?=$game->id?></td>
                                    <td class="align-middle"><?=$game->start_at?></td>
                                    <td class="align-middle"><?=$game->host?></td>
                                    <td class="align-middle"><?=$game->guest?></td>
                                    <td class="align-middle"><?=$game->host_score?>-<?=$game->guest_score?></td>
                                    <td class="align-middle"><?=$game->bet_score_host?>-<?=$game->bet_score_guest?></td>
                                    <td class="align-middle">
                                            <a href="/DiamondDogsProject/group/games/<?=$game->id?>/gameDetails/" class="btn btn-info">Details</a>
                                        <?php if ((new DateTime)->format('Y-m-d H:i:s') < ($game->start_at) && !$game->bet_score_guest):?>
                                            <a href="/DiamondDogsProject/group/games/<?=$game->id?>/bet/" class="btn btn-info">Bet</a>
                                        <?php endif; ?>
                                        <?php if ((new DateTime)->format('Y-m-d H:i:s') >= ($game->start_at) && $params['isOwner'] && (is_null($game->host_score) || is_null($game->guest_score))):?>
                                            <a href="/DiamondDogsProject/group/games/<?=$game->id?>/add-score" class="btn btn-warning">Score</a>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="row spacer-content-top"></div>
    <div class="row">
            <?php if ($params['isOwner']):?>
                <a href="/DiamondDogsProject/group/games/create" class="btn btn-warning btn-add">Add Game</a>
            <?php endif;?>
    </div>  
</div>

<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>
