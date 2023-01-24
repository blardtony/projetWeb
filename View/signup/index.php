<link href="<?php echo BASE_CSS?>signup.css" rel="stylesheet" type="text/css">
<div class="container mt-5">
    <div class="row spacer"></div>
    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="text-center">Sign Up</h2>
            <?php
                require BASE_VIEW_PATH . 'errors/formErrors.php'
            ?>
            <form action="/DiamondDogsProject/signup" method="POST">
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Pseudo</label>
                    <input class="form-control" id="pseudo" type="text" name="pseudo"  required/>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" type="text" name="email" value="<?php echo $_GET['email'] ?>" required/>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" id="password" type="password" name="password"  required/>
                </div>

                <div class="mb-3">
                    <label for="validate_password" class="form-label">Validate Password</label>
                    <input class="form-control" id="validate_password" type="password" name="validate_password"  required/>
                </div>

                <button type="submit" class="btn btn-primary btn-enter">Send</button>
            </form>
        </div>
    </div>
</div>