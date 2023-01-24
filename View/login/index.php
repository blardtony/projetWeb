<link href="<?php echo BASE_CSS?>login.css" rel="stylesheet" type="text/css">
<div class="container mt-5">
    <div class="row spacer"></div>
    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="text-center">Connexion</h2>
            <?php
                require BASE_VIEW_PATH . 'errors/formErrors.php'
            ?>
            <form action="/DiamondDogsProject/login" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" type="text" name="email"/>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" id="password" type="password" name="password"/>
                </div>
                <div>
                    <a href="/DiamondDogsProject/reset-password">Forget Password</a>
                </div>
                <button type="submit" class="btn btn-primary btn-enter">Log in</button>
            </form>
        </div>
    </div>
</div>