<?php include_once 'layout/header.php'; ?>
<?php include_once 'config/database.php'; ?>
<?php include_once 'config/authorization.php'; ?>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <?php include_once 'layout/navbar.php'; ?>
      <?php include_once 'layout/sidebar.php'; ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <?php
            $query = "SELECT COUNT(*) as total FROM users WHERE role = 'staff'";
            $staff = $conn->query($query)->fetch_assoc();

            $query = "SELECT COUNT(*) as total FROM students";
            $students = $conn->query($query)->fetch_assoc();

            $query = "SELECT SUM(balance) as total FROM savings_accounts";
            $savings = $conn->query($query)->fetch_assoc();

            $query = "SELECT COUNT(*) as total FROM transactions";
            $transactions = $conn->query($query)->fetch_assoc();
            ?>
            <div class="col-lg-2 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-2">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Staff</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $staff['total']; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-2">
                <div class="card-icon bg-warning">
                  <i class="fas fa-user-graduate"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Siswa</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $students['total']; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Saldo</h4>
                  </div>
                  <div class="card-body">
                    IDR <?php echo number_format($savings['total'], 2, ',', '.'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Melakukan Transaksi</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $transactions['total']; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h4>5 Transaksi Terakhir</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive mb-4">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nomer Akun</th>
                      <th>Tanggal</th>
                      <th>Jenis Transaksi</th>
                      <th>Nominal</th>
                      <th>Staff</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $query = "SELECT transactions.id, transactions.transaction_date, transactions.transaction_type, transactions.amount, savings_accounts.account_number, users.username FROM transactions LEFT JOIN savings_accounts ON transactions.account_id = savings_accounts.id LEFT JOIN users ON transactions.staff_id = users.id ORDER BY transactions.id DESC LIMIT 5";

                    $data = $conn->query($query);

                    foreach ($data as $key => $value) {
                    ?>
                      <tr>
                        <td>
                          <?php echo $key + 1; ?>
                        </td>
                        <td>
                          <?php echo $value['account_number']; ?>
                        </td>
                        <td>
                          <?php echo $value['transaction_date']; ?>
                        </td>
                        <td>
                          <span class="badge badge-<?php echo $value['transaction_type'] == 'deposit' ? 'success' : 'danger'; ?>">
                            <?php echo $value['transaction_type']; ?>
                          </span>
                        </td>
                        <td>
                          <span class="currency">
                            <?php echo 'Rp' . number_format($value['amount'], 2, ',', '.'); ?>
                          </span>
                        </td>
                        <td>
                          <?php echo $value['username']; ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include_once 'layout/footer.php'; ?>
    </div>
  </div>

  <?php include_once 'layout/script.php'; ?>
</body>

</html>