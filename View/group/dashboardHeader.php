<link href="<?php echo BASE_CSS?>dashboard.css" rel="stylesheet" type="text/css">
<div class="container-fluid ">
    <div class="row justify-content-center">
        <div class="col-2 bg-white border-dark">
            <?php
                $group = array("group","group/add-user")
            ?>
            <div class="row spacer-menu-top">
            </div>  
            <div class="row justify-content-center">
                <a class='btn btn-light btn-menu btn-ranking' <?php echo in_array($_GET['url'],$group) ? "style='background-color:#4f93f828;'" : ""?> href='/DiamondDogsProject/group'>Group</a>
            </div>
            <?php if ($_SESSION['user']['id_group']):?>
                <div class="row justify-content-center">
                    <a class='btn btn-light btn-menu btn-match' <?php echo strpos($_GET['url'],'group/games') !== false ? "style='background-color:#4f93f828;'" : ""?> href='/DiamondDogsProject/group/games'>Matches</a>
                </div>
            <?php endif;?>
            <div class="row justify-content-center">
                <a class='btn btn-light btn-menu btn-profil' <?php echo $_GET['url'] == 'user/me' ? "style='background-color:#4f93f828;'" : ""?> href='/DiamondDogsProject/user/me'>Me</a>
            </div>
            <div class="row spacer-menu-between">
            </div>
            <?php if ($_SESSION['user']['admin']): ?>
                <div class="row justify-content-center">
                    <a class='btn btn-light btn-menu btn-setting' <?php echo strpos($_GET['url'],'admin') !== false ? "style='background-color:#4f93f828;'" : ""?> href='/DiamondDogsProject/admin'>Admin</a>
                </div>
            <?php endif;?>
            <div class="row justify-content-center">
                <a class='btn btn-light btn-menu btn-setting' <?php echo strpos($_GET['url'],'user/settings') !== false ? "style='background-color:#4f93f828;'" : ""?> href='/DiamondDogsProject/user/settings'>Settings</a>
            </div>
            <div class="row justify-content-center">
                <a class='btn btn-light btn-menu btn-logout' href='/DiamondDogsProject/logout'>Log out</a>
            </div>
            <div class="row spacer-menu-end">
            </div>
        </div>    
        <div class="col-6 bg-white">
            <div class="row spacer-content-top">
            </div>
            <div class="row justify-content-center">
                <!-- here -->