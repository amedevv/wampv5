<?php
class Auth
{

    private $db;
    public $error;
    public $sesi;
    function __construct($db)
    {
        $this->db = $db;
    }



    public function login($username, $password)
    {
        $user = filter_var(mysqli_real_escape_string($this->db, $username), FILTER_SANITIZE_STRING);
        $pass = filter_var(mysqli_real_escape_string($this->db, $password), FILTER_SANITIZE_STRING);

        $check = mysqli_query($this->db, "SELECT * FROM account WHERE username = '$user' ");
        if (mysqli_num_rows($check) > 0) {
            $datauser = mysqli_fetch_assoc($check);

            if (password_verify($pass, $datauser['password'])) {
                $_SESSION['login'] = $datauser;
                $this->sesi = $_SESSION['login'];
                header('Location: home.php');
                exit;
            } else {

                $_SESSION['alert'] = ['color' => 'danger', 'msg' => 'Username Atau Password Salah!'];
                header('Location: login.php');
                exit;
            }
        } else {
            $_SESSION['alert'] = ['color' => 'danger', 'msg' => 'Username Atau Password Salah!'];
            header('Location: login.php');
            exit;
        }
    }


    public function register($post)
    {
        $username = filter_var(mysqli_real_escape_string($this->db, $post['username']), FILTER_SANITIZE_STRING);
        $password = filter_var(mysqli_real_escape_string($this->db, $post['password']), FILTER_SANITIZE_STRING);
        $password2 = filter_var(mysqli_real_escape_string($this->db, $post['confirm']), FILTER_SANITIZE_STRING);

        $check = mysqli_query($this->db, "SELECT * FROM account WHERE username = '$username' ");
        if (mysqli_num_rows($check) > 0) {
            $_SESSION['alert'] = ['color' => 'danger', 'msg' => 'Username Sudah Di Gunakan!'];
        } else if ($password != $password2) {
            $_SESSION['alert'] = ['color' => 'danger', 'msg' => 'Konfirmasi password tidak sesuai'];
        } else {


            $apikey =  apikey();
            $newpass = password_hash($password, PASSWORD_DEFAULT);
            if (mysqli_query($this->db, "INSERT INTO account VALUES ('','$username','$newpass','$apikey','2','100')")) {
                $_SESSION['alert'] = ['color' => 'success', 'msg' => 'Daftar berhasil, silahkan login'];
                header('Location: login.php');
                exit;
            };
        }
    }

    public function isLogin()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
            return true;
        }
        return false;
    }


    public function changechunk($chunk)
    {
        $username = $_SESSION['login']['username'];
        if (mysqli_query($this->db, "UPDATE account SET chunk = '$chunk' WHERE username = '$username' ") === true) {
            setFlashMsg('success', 'Maksimal kirim pesan masal berhasil diubah');
            back('pengaturan.php');
        }
    }
    public function getNewKey()
    {
        $username = $_SESSION['login']['username'];
        $newkey = apikey();
        if (mysqli_query($this->db, "UPDATE account SET api_key = '$newkey' WHERE username = '$username'") === true) {
            setFlashMsg('success', 'Berhasil ubah api key');
            back('pengaturan.php');
        }
    }
    // 
    public function changepass($post)
    {
        $username = $_SESSION['login']['username'];
        if (strlen($post['newpass']) < 6) {
            setFlashMsg('danger', 'Password minimal 6 karakter!');
            back('pengaturan.php');
        }
        if ($post['newpass'] != $post['confnewpass']) {
            setFlashMsg('danger', 'Konfirmasi kata sandi tidak sesuai!');
            back('pengaturan.php');
        }
        $cek = mysqli_query($this->db, "SELECT * FROM account WHERE username = '$username'");
        if (mysqli_num_rows($cek) > 0) {
            $oldpasss = mysqli_fetch_array($cek)['password'];
            if (password_verify($post['oldpass'], $oldpasss)) {
                $newpassword = password_hash($post['newpass'], PASSWORD_DEFAULT);
                if (mysqli_query($this->db, "UPDATE account SET password = '$newpassword' WHERE username = '$username' ") === true) {
                    setFlashMsg('success', 'Ganti kata sandi berhasil');
                    session_destroy();
                    back('login.php');
                }
                setFlashMsg('danger', 'Kesalahan system!');
                back('pengaturan.php');
            }
            setFlashMsg('danger', 'Kata sandi lama tidak sesuai!');
            back('pengaturan.php');
        }
    }


    public function logout()
    {
        session_destroy();
        back('login.php');
    }
}
