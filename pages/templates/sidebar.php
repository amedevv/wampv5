<?php
$self = explode('/', $_SERVER['SCRIPT_NAME']);
$page = end($self);
?>
<div class="app align-content-stretch d-flex flex-wrap">
    <div class="app-sidebar">
        <div class="logo">
            <a href="home.php" class="logo-icon"><span class="logo-text">MPWA</span></a>
            <div class="sidebar-user-switcher user-activity-online">
                <a href="#">
                    <img src="../assets/images/avatars/avatar.png">
                    <span class="activity-indicator"></span>
                    <span class="user-info-text"><?= $_SESSION['login']['username'] ?><br></span>
                </a>
            </div>
        </div>
        <div class="app-menu">
            <ul class="accordion-menu">
                <li class="sidebar-title">
                    Apps
                </li>
                <li class="<?= $page == 'home.php' ? 'active-page' : '' ?>">
                    <a href="home.php" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
                </li>
                <li class="<?= $page == 'autoresponder.php' ? 'active-page' : '' ?>">
                    <a href="autoresponder.php" class=""><i class="material-icons-two-tone">message</i>Auto Respons</a>
                </li>
                <li class="<?= $page == 'numbers.php' ? 'active-page' : '' ?>">
                    <a href="numbers.php" class=""><i class="material-icons-two-tone">contacts</i>Kontak/Nomor</a>
                </li>
                <li class="<?= $page == 'messages.php' ? 'active-page' : '' ?>">
                    <a href="messages.php" class=""><i class="material-icons-two-tone">send</i>Test Pesan</a>
                </li>
                <li class="<?= $page == 'blast.php' ? 'active-page' : '' ?>">
                    <a href="blast.php" class=""><i class="material-icons-two-tone">notifications</i>Blast Message</a>
                </li>
                <li class="<?= $page == 'schedule.php' ? 'active-page' : '' ?>">
                    <a href="schedule.php" class=""><i class="material-icons-two-tone">schedule</i>Pesan terjadwal</a>
                </li>
                <li class="sidebar-title">
                    Other
                </li>
                <li>
                    <a href="rest_api.php"><i class="material-icons-two-tone">api</i>Rest API</a>
                </li>
                <li>
                    <a href="pengaturan.php"><i class="material-icons-two-tone">settings</i>Pengaturan</a>
                </li>
                <li>
                    <a href="logout.php"><i class="material-icons-two-tone">logout</i>Logout</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="app-container">
        <div class="search">
            <form>
                <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
            </form>
            <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
        </div>
        <div class="app-header">
            <nav class="navbar navbar-light navbar-expand-lg">
                <div class="container-fluid">
                    <div class="navbar-nav" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                            </li>

                            <li class="nav-item dropdown hidden-on-mobile">
                                <a class="nav-link dropdown-toggle" href="#" id="exploreDropdownLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons-outlined">explore</i>
                                </a>

                            </li>
                        </ul>

                    </div>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link active" href="#">Applications</a>
                            </li>

                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link nav-notifications-toggle" id="notificationsDropDown" href="#" data-bs-toggle="dropdown">4</a>
                                <div class="dropdown-menu dropdown-menu-end notifications-dropdown" aria-labelledby="notificationsDropDown">
                                    <h6 class="dropdown-header">Notifications</h6>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>