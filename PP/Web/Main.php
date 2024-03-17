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
            <a href="Profile.php"><div><img src="../data/Настройки.svg" alt="">Настройки</div></a>
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
                    <h2 align=center>О нашем учебном заведении</h2>
                    <div class="description center">
    
    <p>Наше учебное заведение является одним из ведущих учебных центров в регионе. Мы предлагаем разнообразные программы обучения для студентов всех возрастов и уровней подготовки. Наши преподаватели являются высококвалифицированными специалистами в своей области и всегда стремятся к совершенствованию своих навыков и знаний.

Мы предоставляем студентам современные учебные технологии и оборудование, чтобы они могли получать качественное образование и быть конкурентоспособными на рынке труда. Наши программы обучения включают как теоретические, так и практические компоненты, что позволяет студентам применять полученные знания на практике.

Наше учебное заведение также предоставляет студентам разнообразные возможности для развития своих навыков и талантов, такие как участие в научных конференциях, спортивных соревнованиях, творческих конкурсах и других мероприятиях.

Мы стремимся создать дружелюбную и инклюзивную среду для всех студентов, независимо от их расы, пола, религии или социального статуса. Наше учебное заведение является домом для студентов со всего мира, и мы гордимся нашей многонациональной и многокультурной средой.

В целом, наше учебное заведение является идеальным местом для получения качественного образования и развития своих навыков и талантов. Мы всегда стремимся к совершенствованию и обеспечению успеха наших студентов.</p>
</div>
        </div>
        
</body>
</html>