<link href="<?php echo BASE_CSS?>token.css" rel="stylesheet" type="text/css">
<div class="container-fluid">
    <div class="row spacer"></div>
    <div class="row mb-3 justify-content-center">
        <div class="col-6">
        <h2 class="text-center">Verifier votre compte</h2>
            <?php
                require BASE_VIEW_PATH . 'errors/formErrors.php'
            ?>
            <form action="/DiamondDogsProject/email-verify" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" id="email" type="text" name="email"/>
                </div>

                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>