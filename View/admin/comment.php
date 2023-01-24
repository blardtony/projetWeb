<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="container">
    <div class="text-center title mt-5 mb-3">Comment Admin</div>
    <div class="row spacer-content-top"></div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Game</th>
                <th scope="col">Message</th>
                <th scope="col">Posted at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($params['comments'] as $comment):?>
            <tr style="height: 50px;">
                <td class="align-middle"><?= $comment->id?></td>
                <td class="align-middle"><?= $comment->pseudo?></td>
                <td class="align-middle"><a target="_blank" class="btn btn-warning" href="/DiamondDogsProject/group/games/<?= $comment->id_game?>/gameDetails">Show</a></td>
                <td class="align-middle"><?= $comment->message ?>
                <td class="align-middle"><?= $comment->posted_at?></td>
                <td class="align-middle"><a class="btn btn-danger" href="/DiamondDogsProject/admin/comment/<?=$comment->id?>/delete">Delete</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>