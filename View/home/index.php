<link href="<?php echo BASE_CSS?>home.css" rel="stylesheet" type="text/css">
<?php
    require BASE_VIEW_PATH . 'errors/formErrors.php'
?>
<div class="container-fluid justify-content-center text">
    <h1>
        <div class="row text-center">
            <div class="col h1"><b>Enter the game</b></div>
        </div>
    </h1>
    <h2>
        <div class="row text-center">
            <div class="col h2">MonPetitProno, the free & funky forecasting game to <span style="text-decoration:line-through;">stress out</span> have fun with your colleagues and friends</div>
        </div>
    </h2>
    <div class="row spacer"></div>
    <form class="row" action="/DiamondDogsProject/signup">
            <div class="col"></div>
            <div class="col d-flex">
                <label for="email" class="form-label"></label>
                <input class="form-control input-text" id="email" type="text" name="email" placeholder="Your email address..." required/>
                <button type="submit" class="btn btn-primary btn-sign">Sign up</button>
            </div>
            <div class="col"></div>
    </form>
    <div class="full-image">
    </div>
    <div class="row spacer"></div>
</div>
