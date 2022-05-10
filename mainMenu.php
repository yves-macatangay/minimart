<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-secondary">
        <div class="container-fluid">
          <span class="navbar-brand text-light">MiniMart Catalog</span>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
             <!-- <a class="nav-link active" aria-current="page" href="#">Dashboard</a> -->
                <a class="nav-link text-light" href="products.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="sections.php">Sections</a>
              </li>
            </ul>
            <span class="navbar-text">
                <a href="profile.php" class="text-decoration-none text-secondary fw-bold"><i class="fa-solid fa-user p-1"></i>Welcome <?= $_SESSION['fullname'] ?></a>
                <a href="logout.php" class="text-decoration-none text-secondary"><i class="fa-solid fa-user p-1 ms-1"></i>Logout</a>
            </span>
          </div>
        </div>
      </nav>
   