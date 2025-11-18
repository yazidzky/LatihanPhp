<?php
session_start();

if (!isset($_SESSION["is_login"])) {
    header("location: index.php");
    exit();
}

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BukuTamu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "layout/header.php" ?>

    <main>
        <div class="card welcome-card">
            <h1>Selamat Datang, <?= htmlspecialchars($_SESSION["username"]) ?>! 🎉</h1>
            <p style="color: var(--text-light); font-size: 1.2rem; margin-bottom: 2rem;">
                Anda berhasil login ke dalam sistem.
            </p>
            <form action="dashboard.php" method="POST" style="max-width: 200px; margin: 0 auto;">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </main>

    <?php include "layout/footer.php" ?>
</body>

</html>