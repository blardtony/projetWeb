<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row justify-content-center">
    <div class="col-12" style="font-size:large;">
        <div class="row spacer-content-top-me"></div>
        <div class="text-center mb-5 title"><?=$_SESSION['user']['pseudo']?>'s Profile</div>
        <div class="mb-3 text-center score text-warning" ><b><?=$_SESSION['user']['score']?> pts</b></div>
        <div class="row" style="margin-top:5%;">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
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
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>