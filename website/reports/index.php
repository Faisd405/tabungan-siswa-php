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
                        <h1>List Laporan Transaksi</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item">Laporan</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="p-4">
                                            <form>
                                                <div class="row">
                                                    <div class="form-group col-4 mr-2 mb-2">
                                                        <input type="text" class="form-control" placeholder="Cari Nomer Akun" name="search" value="<?php echo $_GET['search'] ?? ''; ?>">
                                                    </div>
                                                    <div class="form-group col-4 mr-2 mb-2">
                                                        <select class="form-control" name="transaction_type" id="transaction_type">
                                                            <option value="">Pilih Jenis Transaksi</option>
                                                            <option value="deposit" <?php echo isset($_GET['transaction_type']) && $_GET['transaction_type'] == 'deposit' ? 'selected' : ''; ?>>Deposit</option>
                                                            <option value="withdrawal" <?php echo isset($_GET['transaction_type']) && $_GET['transaction_type'] == 'withdrawal' ? 'selected' : ''; ?>>Withdraw</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-4 mr-2 mb-2">
                                                        <input type="date" class="form-control" placeholder="Cari Tanggal" name="date" value="<?php echo $_GET['date'] ?? ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary">
                                                        Search
                                                    </button>
                                                    <button type="button" class="btn btn-danger ml-2" onclick="window.location.href = 'index.php'">
                                                        Reset
                                                    </button>
                                                </div>
                                            </form>
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
                                                    $where = [];
                                                    if (isset($_GET['date']) && $_GET['date'] != '') {
                                                        $where[] = "transaction_date LIKE '%{$_GET['date']}%'";
                                                    }

                                                    if (isset($_GET['search']) && $_GET['search'] != '') {
                                                        $where[] = "account_number LIKE '%" . $_GET['search'] . "%'";
                                                    }

                                                    if (isset($_GET['transaction_type']) && $_GET['transaction_type'] != '') {
                                                        $where[] = "transaction_type = '{$_GET['transaction_type']}'";
                                                    }

                                                    $where = implode(' AND ', $where);

                                                    if ($where == '') {
                                                        $where = '1';
                                                    }

                                                    $query = "SELECT transactions.id, transactions.transaction_date, transactions.transaction_type, transactions.amount, savings_accounts.account_number, users.username FROM transactions LEFT JOIN savings_accounts ON transactions.account_id = savings_accounts.id LEFT JOIN users ON transactions.staff_id = users.id WHERE $where";

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