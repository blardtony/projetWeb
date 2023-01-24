<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row mt-5">
    <div class="col-12">
        <?php if ($params['group']): ?>
          <div class="text-center title" style="margin-bottom:5%;"><?=$params['group']->name?> Group</div>
          <table class="table mt-5">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Score</th>
                <?php if ($params['isOwner']):?>
                  <th scope="col">Action</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach($params['users'] as $user):?>
                <tr style="height: 50px;">
                  <th class="align-middle" scope="row"><?=$user->id?></th>
                  <td class="align-middle"><?=$user->pseudo?></td>
                  <td class="align-middle"><?=$user->email?></td>
                  <td class="align-middle"><?=$user->score?></td>
                  <?php if ($params['isOwner'] && $user->id !== $_SESSION['user']['id']):?>
                    <td><a class="btn btn-danger" href="#">Delete</a></td>
                  <?php else: ?>
                    <td></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
          <div class="text-center">
            <a class="btn btn-warning btn-user" href="/DiamondDogsProject/group/add-user">
                Add User
            </a>
          </div>
        <?php else: ?>
          <div class="text-center">
            <a class="btn btn-warning" href="/DiamondDogsProject/group/create">
              New Group
            </a>
          </div>
        <?php endif;?>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>