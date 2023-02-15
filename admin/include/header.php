<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">ระบบหลังบ้าน</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php
        if ($_SESSION == NULL) {
          ?>
          <button class="btn btn-outline-primary" type="submit" onclick="window.location.href='login.php'">เข้าสู่ระบบ</button>
          <?php
        }else{
          ?>
          <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"><?php echo "<i class='bi bi-people'></i> ".$result_tb_user[3].' '.$result_tb_user[4].' '; ?></button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><button class="dropdown-item" type="button" onclick="window.location.href='admin/profile.php'">ข้อมูลส่วนตัว</button></li>
              <?php
              if ($_SESSION["user_level"] == "admin") {
                ?>
                <li><button class="dropdown-item" type="button" onclick="window.location.href='admin/index.php'">ระบบหลังบ้าน</button></li>
                <?php
              }
              ?>
              <hr>
              <li><button class="dropdown-item" type="button" onclick="window.location.href='../logout.php'">ออกจากระบบ</button></li>
            </ul>
          </div>
          <?php
        }
        ?>
</header>
