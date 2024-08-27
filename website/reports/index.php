<?php include_once '../../layout/header.php'; ?>
<?php include_once '../../config/database.php'; ?>
<?php include_once '../../config/authorization.php'; ?>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php include_once '../../layout/navbar.php'; ?>
            <?php include_once '../../layout/sidebar.php'; ?>
            <div class="main-content">
                <section class="section">

                    <div class="section-header">
                        <h1>Laporan</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item">Laporan</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>List Laporan Transaksi</h4>
                                        <div class="card-header-form d-flex">
                                            <form class="mr-2 d-flex">
                                                <div class="input-group mr-2">
                                                    <input type="date" class="form-control" placeholder="Cari Tanggal" name="date" value="<?php echo $_GET['date'] ?? ''; ?>">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Cari Nama" name="search" value="<?php echo $_GET['search'] ?? ''; ?>">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div>
                                            
                                        </div>
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
                                                    if (!empty($_GET['search'])) {
                                                        $search = $_GET['search'];
                                                        $data = $conn->query("SELECT * FROM transactions LEFT JOIN savings_accounts ON transactions.account_id = savings_accounts.id LEFT JOIN users ON transactions.staff_id = users.id WHERE savings_accounts.account_number LIKE '%$search%'");
                                                    } else {
                                                        $data = $conn->query("SELECT * FROM transactions LEFT JOIN savings_accounts ON transactions.account_id = savings_accounts.id LEFT JOIN users ON transactions.staff_id = users.id");
                                                    }

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
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include_once '../../layout/footer.php'; ?>
        </div>
    </div>

    <?php include_once '../../layout/script.php'; ?>
</body>

</html>