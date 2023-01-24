<link href="<?php echo BASE_CSS?>login.css" rel="stylesheet" type="text/css">
<div class="container mt-5">
    <div class="row spacer"></div>
    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="text-center">Reset Password</h2>
            <?php
                require BASE_VIEW_PATH . 'errors/formErrors.php'
            ?>
            <form action="/DiamondDogsProject/reset-password" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" type="text" name="email"/>
                </div>
                <button type="submit" class="btn btn-primary btn-enter">Reset</button>
            </form>
        </div>
    </div>
</div>