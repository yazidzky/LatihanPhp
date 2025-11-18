<?php
include "service/database.php"; // Koneksi database dari sini
session_start();

if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
    exit();
}

$login_error = "";
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hash_password = hash('sha256', $password);

    $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hash_password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["username"] = $data["username"];
        $_SESSION["is_login"] = true;
        header("location: dashboard.php");
        exit();
    } else {
        $login_error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BukuTamu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "layout/header.php" ?>

    <main>
        <div class="card">
            <h2 style="text-align:center; margin-bottom: 1.5rem; color: var(--primary-color);">Login</h2>

            <?php if ($login_error): ?>
                <div style="background-color: #FEE2E2; color: var(--danger-color); padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <?= $login_error ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <input type="text" placeholder="Username" name="username" required autofocus />
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" name="password" required />
                </div>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>

            <p style="text-align:center; margin-top: 1.5rem; color: var(--text-light);">
                Belum punya akun? <a href="register.php" style="color: var(--primary-color);">Daftar di sini</a>
            </p>
        </div>
    </main>

    <?php include "layout/footer.php" ?>
</body>

</html>