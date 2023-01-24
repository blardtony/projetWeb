<link href="<?php echo BASE_CSS?>token.css" rel="stylesheet" type="text/css">
<div class="container-fluid">
    <div class="row spacer"></div>
    <div class="row">
        <div class="col">   
            <?php if ($params['user']): ?>
                <h2>Your account is activated.</h2>
                <div>
                    <a class="btn btn-primary" href="/DiamondDogsProject/login">Se connecter</a>
                </div>
            <?php else : ?>
                <h5>5 minutes are passed.</h5>
            <?php endif;?>
        </div>
    </div>
</div>