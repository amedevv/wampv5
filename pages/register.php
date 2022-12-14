<?php
require('../helper/function.php');

$auth = new Auth($db);

if (isset($_POST['register'])) {
    $auth->register($_POST);
}


require('templates/auth_header.php');
?>
<div class="app app-auth-sign-up align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background">

    </div>
    <div class="app-auth-container">
        <div class="logo">
            <a href="index.html">MPWA</a>
        </div>
        <?php if (isset($_SESSION['alert'])) : ?>
            <div class="alert alert-<?= $_SESSION['alert']['color'] ?> alert-style-light mt-5 mb-5" role="alert">
                <?= $_SESSION['alert']['msg'] ?>
            </div>
            <?php unset($_SESSION['alert']) ?>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="auth-credentials m-b-xxl">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control m-b-md" id="username" aria-describedby="username">

                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" aria-describedby="password" value="">
                <label for="confirmpassword" class="form-label">Password</label>
                <input type="password" name="confirm" class="form-control" id="confirm" aria-describedby="confirm" value="">
            </div>

            <div class="auth-submit">
                <button type="submit" name="register" class="btn btn-primary">Daftar</button>

            </div>
        </form>
        <div class="divider"></div>
        <div class="auth-alts">
            <a href="#" class="auth-alts-google"></a>
            <a href="#" class="auth-alts-facebook"></a>
            <a href="#" class="auth-alts-twitter"></a>
        </div>
    </div>
</div>

<?php
require('templates/auth_footer.php');
?>