<?php if (isset($_SESSION['errors'])):?>
    <?php foreach ($_SESSION['errors'] as $errors):?>
        <?php foreach ($errors as $error):?>

            <div class="alert alert-danger">
                <?php foreach ($error as $message):?>
                    <li><?=$message?></li>
                <?php endforeach;?>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif; ?>