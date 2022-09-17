<?php
require('../helper/function.php');

$auth = new Auth($db);
$home = new Home($db);

if (!$auth->isLogin()) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['changepass'])) {
    $auth->changePass($_POST);
}
if (isset($_POST['changechunk'])) {
    $auth->changechunk($_POST['chunk']);
}
if (isset($_POST['generatekey'])) {
    $auth->getNewKey();
}

require('templates/header.php');
require('templates/sidebar.php');
?>

<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <h2 class="my-5">Rest API</h2>
            <?php if (isset($_SESSION['alert'])) : ?>
                <div class="alert alert-<?= $_SESSION['alert']['color'] ?> alert-style-light mt-5" role="alert">
                    <?= $_SESSION['alert']['msg'] ?>
                </div>
                <?php unset($_SESSION['alert']) ?>
            <?php endif; ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-description">Pengaturan</p>
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <form action="" method="POST">

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">API Key</span>

                                            <input type="text" class="form-control" value="<?= $home->getInfo('api_key'); ?>" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                            <button type="submit" name="generatekey" class="btn btn-primary">Generate baru</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-7">

                                    <form action="" class="d-inline" method="POST">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Maksimal Pesan Masal</span>
                                            <input type="text" name="chunk" class="form-control" value="<?= $home->getInfo('chunk'); ?>" aria-label="Username" aria-describedby="basic-addon1">
                                            <button type="submit" name="changechunk" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <p class="card-description mt-5"> Ubah Kata Sandi </p>
                            <form action="" method="POST">

                                <input type="password" name="oldpass" class="form-control form-control-rounded" aria-describedby="..." placeholder="kata sandi lama">
                                <input type="password" name="newpass" class="form-control form-control-solid-bordered form-control-rounded mt-3" aria-describedby="..." placeholder="Kata sandi baru">
                                <input type="password" name="confnewpass" class="form-control form-control-solid-bordered form-control-rounded mt-3" aria-describedby="..." placeholder="Konfirmasi Kata sandi">
                                <button type="submit" name="changepass" class="btn btn-primary mt-5">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require('templates/footer.php');
    ?>