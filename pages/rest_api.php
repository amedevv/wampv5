<?php
require('../helper/function.php');

$auth = new Auth($db);
$home = new Home($db);

if (!$auth->isLogin()) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $home->addDevice($_POST);
}
if (isset($_POST['delete'])) {
    $home->deleteDevice($_POST['deviceId']);
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Method</th>
                                    <th scope="col">POST</th>
                                </tr>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">JSON / Urlencoded</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-description">Rest Api </p>
                            <div class="example-container">
                                <div class="example-content">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#SendMsg" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Pesan Text</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#SendImg" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                                Pesan Gambar
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#SendButton" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Pesan Button </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#SendDocument" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Pesan Dokumen </button>
                                        </li>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#Webhook" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">webhook</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade active show" id="SendMsg" role=" tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="alert alert-secondary">ENDPOINT : <?= URL_WA ?>send-message</div>
                                            <table class="table">
                                                <thead>
                                                    <th scope="col">Parameter</th>
                                                    <th scope="col">Deskripsi</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>api_key</td>
                                                        <td><span class="badge badge-secondary"><?= $_SESSION['login']['api_key'] ?></span></td>
                                                    </tr>
                                                    <tr>

                                                        <td>sender</td>
                                                        <td>Nomor pengirim/ device ( Gunakan kode negara ) </td>

                                                    </tr>
                                                    <tr>

                                                        <td>number</td>
                                                        <td>Nomor tujuan </td>

                                                    </tr>
                                                    <tr>
                                                        <th>message</th>
                                                        <td>Pesan nya</td>

                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="SendImg" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="alert alert-secondary">ENDPOINT : <?= URL_WA ?>send-image</div>
                                            <table class="table">
                                                <thead>
                                                    <th scope="col">Parameter</th>
                                                    <th scope="col">Deskripsi</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>api_key</td>
                                                        <td><span class="badge badge-secondary"><?= $_SESSION['login']['api_key'] ?></span></td>
                                                    </tr>
                                                    <tr>

                                                        <td>sender</td>
                                                        <td>Nomor pengirim/ device ( Gunakan kode negara ) </td>

                                                    </tr>
                                                    <tr>

                                                        <td>number</td>
                                                        <td>Nomor tujuan </td>

                                                    </tr>
                                                    <tr>
                                                        <th>message</th>
                                                        <td>Pesan nya</td>

                                                    </tr>
                                                    <tr>
                                                        <th>url</th>
                                                        <td>Link gambar , ( extensi JPG,PNG,JPEG )</td>

                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="SendButton" role="tabpanel" aria-labelledby="pills-contact-tab">
                                            <div class="alert alert-secondary">ENDPOINT : <?= URL_WA ?>send-button</div>
                                            <table class="table">
                                                <thead>
                                                    <th scope="col">Parameter</th>
                                                    <th scope="col">Deskripsi</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>api_key</td>
                                                        <td><span class="badge badge-secondary"><?= $_SESSION['login']['api_key'] ?></span></td>
                                                    </tr>
                                                    <tr>

                                                        <td>sender</td>
                                                        <td>Nomor pengirim/ device ( Gunakan kode negara ) </td>

                                                    </tr>
                                                    <tr>

                                                        <td>number</td>
                                                        <td>Nomor tujuan </td>

                                                    </tr>
                                                    <tr>
                                                        <th>message</th>
                                                        <td>Pesan nya</td>

                                                    </tr>
                                                    <tr>
                                                        <th>footer</th>
                                                        <td>Pesan di bawah button ( singkat )</td>

                                                    </tr>
                                                    <tr>
                                                        <th>button1</th>
                                                        <td>Nama tombol pertama</td>

                                                    </tr>
                                                    <tr>
                                                        <th>button2</th>
                                                        <td>Nama tombol ke 2</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="SendDocument" role="tabpanel" aria-labelledby="pills-contact-tab">
                                            <div class="alert alert-secondary">ENDPOINT : <?= URL_WA ?>send-document</div>
                                            <table class="table">
                                                <thead>
                                                    <th scope="col">Parameter</th>
                                                    <th scope="col">Deskripsi</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>api_key</td>
                                                        <td><span class="badge badge-secondary"><?= $_SESSION['login']['api_key'] ?></span></td>
                                                    </tr>
                                                    <tr>

                                                        <td>sender</td>
                                                        <td>Nomor pengirim/ device ( Gunakan kode negara ) </td>

                                                    </tr>
                                                    <tr>

                                                        <td>number</td>
                                                        <td>Nomor tujuan </td>

                                                    </tr>
                                                    <tr>
                                                        <th>url</th>
                                                        <td>Link dokumen ( EXTENSI PDF, DOC,DOCX ,XLS ATAU XLSX )</td>

                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="Webhook" role="tabpanel" aria-labelledby="pills-contact-tab">
                                            <div class="alert alert-secondary">
                                                <!-- HTML generated using highlightmycode -->
                                                <div style="background: #ffffff; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;">
                                                    <pre style="margin: 0; line-height: 125%"><span style="color: #507090">&lt;?php</span>

<span style="color: #808080">// ------------------------------------------------------------------//</span>
<span style="color: #007020">header</span>(<span style="background-color: #fff0f0">&#39;content-type: application/json&#39;</span>);
<span style="color: #906030">$data</span> <span style="color: #303030">=</span> json_decode(<span style="color: #007020">file_get_contents</span>(<span style="background-color: #fff0f0">&#39;php://input&#39;</span>), <span style="color: #008000; font-weight: bold">true</span>);
<span style="color: #007020">file_put_contents</span>(<span style="background-color: #fff0f0">&#39;whatsapp.txt&#39;</span>, <span style="background-color: #fff0f0">&#39;[&#39;</span> <span style="color: #303030">.</span> <span style="color: #007020">date</span>(<span style="background-color: #fff0f0">&#39;Y-m-d H:i:s&#39;</span>) <span style="color: #303030">.</span> <span style="background-color: #fff0f0">&quot;]</span><span style="color: #606060; font-weight: bold; background-color: #fff0f0">\n</span><span style="background-color: #fff0f0">&quot;</span> <span style="color: #303030">.</span> json_encode(<span style="color: #906030">$data</span>) <span style="color: #303030">.</span> <span style="background-color: #fff0f0">&quot;</span><span style="color: #606060; font-weight: bold; background-color: #fff0f0">\n\n</span><span style="background-color: #fff0f0">&quot;</span>, FILE_APPEND);
<span style="color: #906030">$message</span> <span style="color: #303030">=</span> <span style="color: #906030">$data</span>[<span style="background-color: #fff0f0">&#39;message&#39;</span>]; <span style="color: #808080">// ini menangkap pesan masuk</span>
<span style="color: #906030">$from</span> <span style="color: #303030">=</span> <span style="color: #906030">$data</span>[<span style="background-color: #fff0f0">&#39;from&#39;</span>]; <span style="color: #808080">// ini menangkap nomor pengirim pesan</span>


<span style="color: #008000; font-weight: bold">if</span> (<span style="color: #007020">strtolower</span>(<span style="color: #906030">$message</span>) <span style="color: #303030">==</span> <span style="background-color: #fff0f0">&#39;hai&#39;</span>) {
    <span style="color: #906030">$result</span> <span style="color: #303030">=</span> [
        <span style="background-color: #fff0f0">&#39;mode&#39;</span> <span style="color: #303030">=&gt;</span> <span style="background-color: #fff0f0">&#39;chat&#39;</span>, <span style="color: #808080">// mode chat = chat biasa</span>
        <span style="background-color: #fff0f0">&#39;pesan&#39;</span> <span style="color: #303030">=&gt;</span> <span style="background-color: #fff0f0">&#39;hai juga&#39;</span>
    ];
} <span style="color: #008000; font-weight: bold">else</span> <span style="color: #008000; font-weight: bold">if</span> (<span style="color: #007020">strtolower</span>(<span style="color: #906030">$message</span>) <span style="color: #303030">==</span> <span style="background-color: #fff0f0">&#39;hallo&#39;</span>) {
    <span style="color: #906030">$result</span> <span style="color: #303030">=</span> [
        <span style="background-color: #fff0f0">&#39;mode&#39;</span> <span style="color: #303030">=&gt;</span> <span style="background-color: #fff0f0">&#39;reply&#39;</span>, <span style="color: #808080">// mode reply = reply pessan</span>
        <span style="background-color: #fff0f0">&#39;pesan&#39;</span> <span style="color: #303030">=&gt;</span> <span style="background-color: #fff0f0">&#39;Halo juga&#39;</span>
    ];
} <span style="color: #008000; font-weight: bold">else</span> <span style="color: #008000; font-weight: bold">if</span> (<span style="color: #007020">strtolower</span>(<span style="color: #906030">$message</span>) <span style="color: #303030">==</span> <span style="background-color: #fff0f0">&#39;gambar&#39;</span>) {
    <span style="color: #906030">$result</span> <span style="color: #303030">=</span> [
        <span style="background-color: #fff0f0">&#39;mode&#39;</span> <span style="color: #303030">=&gt;</span> <span style="background-color: #fff0f0">&#39;picture&#39;</span>, <span style="color: #808080">// type picture = kirim pesan gambar</span>
        <span style="background-color: #fff0f0">&#39;data&#39;</span> <span style="color: #303030">=&gt;</span> [
            <span style="background-color: #fff0f0">&#39;caption&#39;</span> <span style="color: #303030">=&gt;</span> <span style="background-color: #fff0f0">&#39;webhook picture&#39;</span>,
            <span style="background-color: #fff0f0">&#39;url&#39;</span> <span style="color: #303030">=&gt;</span> <span style="background-color: #fff0f0">&#39;https://seeklogo.com/images/W/whatsapp-logo-A5A7F17DC1-seeklogo.com.png&#39;</span>
        ]
    ];
}
<span style="color: #008000; font-weight: bold">print</span> json_encode(<span style="color: #906030">$result</span>);
</pre>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-secondary">


                                        <!-- HTML generated using highlightmycode -->
                                        <div style="background: #ffffff; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;">
                                            <pre style="margin: 0; line-height: 125%"><span style="color: #808080">// respon sukses</span>
{
  <span style="background-color: #fff0f0">&quot;status&quot;</span> <span style="color: #303030">:</span> <span style="color: #008000; font-weight: bold">true</span>,
  <span style="background-color: #fff0f0">&quot;msg&quot;</span> <span style="color: #303030">:</span> <span style="background-color: #fff0f0">&quot;Pesan Berhasil dikirim&quot;</span>
}

<span style="color: #808080">// respon gagal</span>
{
  <span style="background-color: #fff0f0">&quot;status&quot;</span> <span style="color: #303030">:</span> <span style="color: #008000; font-weight: bold">false</span>,
  <span style="background-color: #fff0f0">&quot;msg&quot;</span> <span style="color: #303030">:</span> <span style="background-color: #fff0f0">&quot;Pesan nya&quot;</span>
}

<span style="color: #808080">// pesan pesan jika gagal</span>
 <span style="color: #808080">// &quot;Parameter salah&quot;</span>
 <span style="color: #808080">// &quot;Api key salah&quot;</span>
<span style="color: #808080">// &quot;Harap scan sebelum menggunakan code QR&quot;</span>
</pre>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    require('templates/footer.php');
    ?>