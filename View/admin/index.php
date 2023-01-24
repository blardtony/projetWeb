<?php require BASE_VIEW_PATH . 'group/dashboardHeader.php';?>
<div class="row justify-content-center spacer-content-top"></div>
<div class="row justify-content-center" style="margin-top:1%;">
    <div class="col-12">
        <div class="mb-6 text-center title">Admin</div>
            <div class="mb-3">
                <div class="row justify-content-center">
                    <a class="btn btn-warning btn-settings" href="/DiamondDogsProject/admin/user">
                        Manage Users
                    </a>
                </div>
            </div>
            <div class="mb-3">
                <div class="row justify-content-center spacer-content-between">
                    <a class="btn btn-warning btn-settings" href="/DiamondDogsProject/admin/comment">
                        Manage Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require BASE_VIEW_PATH . 'group/dashboardFooter.php';?>