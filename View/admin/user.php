<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="container">
    <div class="text-center title mt-5 mb-3">User admin</div>
    <div class="row spacer-content-top"></div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($params['users'] as $user):?>
            <tr style="height: 50px;">
                <td class="align-middle"><?=$user->id?></td>
                <td class="align-middle"><?=$user->pseudo?></td>
                <td class="align-middle"><?=$user->email?></td>
                <td class="align-middle"><?= $user->active ?>
                <td>
                    <?php if ($user->active): ?>
                        <a href="/DiamondDogsProject/admin/user/<?=$user->id?>/deactivate" class="btn btn-danger">Désactiver</a>
                    <?php else:?>
                        <a href="/DiamondDogsProject/admin/user/<?=$user->id?>/activate" class="btn btn-info">Activer</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>