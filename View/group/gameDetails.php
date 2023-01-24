<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row mt-5 justify-content-center">
    <div class="col-10">
        <div class="text-center title">Game Details</div>
        <div class="mb-3">
            <div class="text-center" style="margin-left:-9%;"><?=$params["game"]->host;?> - <?=$params["game"]->guest;?></div>
        </div>
        <div class="row" style="margin-top:5%;">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Date</th>
                            <th scope="col">Home</th>
                            <th scope="col">Away</th>
                            <th scope="col">Bet Score</th>
                            <th scope="col">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($params["bets"] as $bet):?>
                        <tr style="height: 50px;">
                            <td class="align-middle"><?=$bet->id?></td>
                            <td class="align-middle"><?=$bet->pseudo?></td>
                            <td class="align-middle"><?=$bet->start_at?></td>
                            <td class="align-middle"><?=$bet->host?></td>
                            <td class="align-middle"><?=$bet->guest?></td>
                            <td class="align-middle"><?=$bet->bet_host_score?>-<?=$bet->bet_guest_score?></td>
                            <td class="align-middle"><?=$bet->host_score?>-<?=$bet->guest_score?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row spacer-content-between"></div>
        <?php foreach ($params['comments'] as $key => $comment): ?>
            <div class="row spacer-content-between"></div>
            <div class="card">
                <div class="card-header">
                    From : <?= $comment->pseudo?>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p style="font-size:large;"><?= $comment->message ?></p>
                    <footer class="blockquote-footer spacer-content-between" style="font-size:small;"><?= $comment->posted_at?></footer>
                    </blockquote>
                </div>
            </div>
        <?php endforeach;?>
        <form action="/DiamondDogsProject/group/games/<?=$params["idGame"]?>/gameDetails" method="post">
            <div class="row spacer-content-top"></div>
            <div class="mb-3 spacer-content-top">
                <label for="message" class="form-label spacer-content-top" style="font-size:large;">Write a comment</label>
                <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                <button type="submit" class="btn btn-warning btn-confirm">Confirm</button>
            </div>
        </form>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>