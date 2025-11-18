<?php
include "service/database.php";
session_start();

if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
    exit();
}

$register_message = "";
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hash_password = hash('sha256', $password);

    try {
        $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hash_password);
        $stmt->execute();
        $register_message = "success";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Integrity constraint violation (duplicate entry)
            $register_message = "exists";
        } else {
            $register_message = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BukuTamu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "layout/header.php" ?>

    <main>
        <div class="card">
            <h2 style="text-align:center; margin-bottom: 1.5rem; color: var(--primary-color);">Register</h2>

            <?php if ($register_message === "success"): ?>
                <div style="background-color: #D1FAE5; color: var(--success-color); padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    Registrasi berhasil! Silakan <a href="login.php" style="color: var(--primary-color);">login</a>.
                </div>
            <?php elseif ($register_message === "error"): ?>
                <div style="background-color: #FEE2E2; color: var(--danger-color); padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    Registrasi gagal, silakan coba lagi.
                </div>
            <?php elseif ($register_message === "exists"): ?>
                <div style="background-color: #FEF3C7; color: #D97706; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    Username sudah digunakan, silakan pilih yang lain.
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <div class="form-group">
                    <input type="text" placeholder="Username" name="username" required autofocus />
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" name="password" required />
                </div>
                <button type="submit" name="register" class="btn btn-primary">Register</button>
            </form>

            <p style="text-align:center; margin-top: 1.5rem; color: var(--text-light);">
                Sudah punya akun? <a href="login.php" style="color: var(--primary-color);">Login di sini</a>
            </p>
        </div>
    </main>

    <?php include "layout/footer.php" ?>
</body>

</html>