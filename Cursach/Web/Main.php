<?php
session_start();
if(!isset($_SESSION['user_id']) || isset($_GET['logout'])){
    $_SESSION['user_id'] = null;
    header('Location: login.php');
    exit;
} else {
    include('../Bd/pdo.php');
    include('../Bd/module_global.php');
    $role = checkRoleUser($_SESSION['user_id']);
    $_SESSION['role'] = $role;
}?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/Style.css">
    <title>Главная</title>
</head>
<body>
    <div class="main-design container">
        <div class="left-part">
        <div class="logo"><img src="../data/Group.svg" alt=""></div>
        <div class="main_menu">
            <!-- <a href="Main.php"><div><img src="../data/Домашняя.svg" alt="">Главная</div></a> -->
            <a href="Group.php"><div><img src="../data/Группы.svg" alt="">Группы</div></a>
            <a href="Tables.php"><div><img src="../data/Журнал.svg" alt="">Журналы</div></a>
            <a href="?logout=1" class="logout"><div><img src="../data/Выйти.svg" alt="">Выйти</div></a>
        </div>
        </div>
        <div class="right-part">
            <div class="part_header">
                <span>Электронный журнал для учебных учреждений</span>
                <?php
                $info = getUserInfoById($_SESSION['user_id']);
                ?>
                <div class="logUserInformation">
                    <img src="../data/user_img.png" alt="" width="40">
                    <label><?php echo $info['lastname'].'. '.mb_substr($info['name'], 0, 1).'. '.mb_substr($info['surname'], 0, 1)?> </label>
                </div>
            </div>
            <div class="part_bottom">
                <div class="bottom_div">
            </div>
            </div>
        </div>
</body>
</html>