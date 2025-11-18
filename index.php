<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BukuTamu - Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "layout/header.php" ?>

    <main>
        <div class="hero">
            <h2>Selamat Datang di BukuTamu Digital</h2>
            <p>Silakan login atau register untuk melanjutkan</p>
            <?php if (!isset($_SESSION['is_login'])): ?>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="login.php" class="btn btn-primary" style="width:auto;">Login</a>
                    <a href="register.php" class="btn btn-primary" style="width:auto; background-color: var(--success-color);">
                        Register
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include "layout/footer.php" ?>
</body>

</html>