<nav class="navbar">
  <div class="nav-container">
    <a href="index.php" class="logo">BukuTamu</a>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <?php if(isset($_SESSION['is_login'])): ?>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li>
        <form action="dashboard.php" method="POST" style="margin: 0">
          <button
            type="submit"
            name="logout"
            class="btn btn-danger"
            style="padding: 0.5rem 1rem"
          >
            Logout (<?= htmlspecialchars($_SESSION['username']) ?>)
          </button>
        </form>
      </li>
      <?php else: ?>
      <li><a href="login.php">Login</a></li>
      <li><a href="register.php">Register</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
