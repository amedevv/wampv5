<?php


class Home
{
    private $db;
    function __construct($db)
    {
        $this->db = $db;
    }

    public function allDevices()
    {

        $own = $_SESSION['login']['username'];
        $data = mysqli_query($this->db, "SELECT * FROM device WHERE pemilik = '$own' ORDER BY id DESC ");
        $result = [];
        if (mysqli_num_rows($data) > 0) {
            while ($d = mysqli_fetch_array($data)) {
                $result[] = $d;
            }
        }
        return $result;
    }

    public function checkStatus($nomord)
    {
        $check = mysqli_query($this->db, "SELECT connect FROM device WHERE nomor = '$nomord' ");
        return mysqli_fetch_array($check);
    }

    public function getApikey()
    {
        $username = $_SESSION['login']['username'];
        $check = mysqli_query($this->db, "SELECT api_key FROM account WHERE username = '$username' ");
        $d = mysqli_fetch_array($check)['api_key'];
        return $d;
    }

    public function addDevice($post)
    {
        $user = $_SESSION['login']['username'];
        $sender = filter_var(mysqli_real_escape_string($this->db, $_POST['sender']), FILTER_SANITIZE_STRING);
        $urlwebhook = filter_var(mysqli_real_escape_string($this->db, $post['urlwebhook']), FILTER_SANITIZE_URL);
        $cek = mysqli_query($this->db, "SELECT * FROM device WHERE nomor = '$sender'");
        if (mysqli_num_rows($cek) > 0) {
            setFlashMsg('danger', 'Sender tersebut sudah ada!');
            back('home.php');
        }
        if (mysqli_query($this->db, "INSERT INTO device VALUES (null,'$user','$sender','$urlwebhook','0')")) {
            setFlashMsg('success', 'Berhasil di tambahkan');
            back('home.php');
        }
    }

    public function contactByUser()
    {

        $own = $_SESSION['login']['username'];
        $data = mysqli_query($this->db, "SELECT * FROM nomor WHERE make_by = '$own' ORDER BY id DESC ");
        $result = [];
        if (mysqli_num_rows($data) > 0) {
            while ($d = mysqli_fetch_array($data)) {
                $result[] = $d;
            }
        }
        return $result;
    }

    public function deleteDevice($id)
    {

        mysqli_query($this->db, "DELETE FROM device WHERE id = '$id'");
        setFlashMsg('success', 'Berhasil dihapus');
        back('home.php');
    }

    public function getInfo($colom)
    {
        $username = $_SESSION['login']['username'];
        $db = mysqli_query($this->db, "SELECT * FROM account WHERE username ='$username'");
        return mysqli_fetch_array($db)[$colom];
    }

    //blast
    public function deleteBlast()
    {
        $username = $_SESSION['login']['username'];
        if (mysqli_query($this->db, "DELETE FROM blast WHERE make_by = '$username'") === true) {
            setFlashMsg('success', 'Berhasil hapus semua daftar Blast');
            back('blast.php');
        }
    }

    public function getContact()
    {
        $username = $_SESSION['login']['username'];
        $c = mysqli_query($this->db, "SELECT * FROM nomor WHERE make_by = '$username'");
        return mysqli_num_rows($c);
    }

    public function getTotalBlast($status)
    {

        $username = $_SESSION['login']['username'];
        $c = mysqli_query($this->db, "SELECT * FROM blast WHERE make_by = '$username' AND status = '$status'");
        return mysqli_num_rows($c);
    }
    public function getTotalSchedule($status)
    {

        $username = $_SESSION['login']['username'];
        $c = mysqli_query($this->db, "SELECT * FROM schedule WHERE make_by = '$username' AND status = '$status'");
        return mysqli_num_rows($c);
    }
}
