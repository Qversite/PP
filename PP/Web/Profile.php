<?php
session_start();

if(!isset($_SESSION['user_id']) || isset($_GET['logout'])){
    $_SESSION['user_id'] = null;
    header('Location: login.php');
    exit;
} else {
    include('../Bd/pdo.php');
    include('../Bd/brain.php');
    $role = checkRoleUser($_SESSION['user_id']);
    $_SESSION['role'] = $role;
    $info = getUserInfoById($_SESSION['user_id']);
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['error_message'] = 'Новый пароль и подтверждение нового пароля не совпадают';
        header('Location: profile.php');
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $user_info = getUserInfoById($user_id);

    if (!password_verify($old_password, $user_info['password'])) {
        echo 'Старый пароль неверен';
        exit;
    }

    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('UPDATE users SET password = :new_password WHERE id = :user_id');
    $stmt->execute(['new_password' => $new_password_hash, 'user_id' => $user_id]);

    echo 'Пароль успешно изменен';
    header('Location: login.php');
    exit;
}
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .form-group {
            text-align: center;
        }

        .form-control {
            display: block;
            margin: 0 auto;
            width: 250px;    
        }

        .profile-container {
            margin-top: 50px;
            text-align: center;
        }
        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-info {
            margin-top: 20px;
        }
        .profile-info h2 {
            font-size: 24px;
        }
        .profile-info p {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container profile-container">
        <img class="profile-image" src="../img/user_img.png" alt="Profile Image">
        <div class="profile-info">
            <h2><?php echo $info['name'].' '.$info['surname']; ?></h2>
            <?php if(isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
            <?php endif; ?>
            <form method="post" action="profile.php">
                <div class="form-group">
                    <label for="old_password">Старый пароль</label>
                    <input type="password" class="form-control" id="old_password" name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Новый пароль</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Подтверждение нового пароля</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Сменить пароль</button>
            </form><br>
            <a href="main.php"><div>Вернуться</div></a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>