<?php include_once '../../../layout/header.php'; ?>
<?php include_once '../../../config/database.php'; ?>
<?php include_once '../../../config/authorization.php'; ?>

<?php
if (!$_GET['id']) {
    header('Location: index.php');
}

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM savings_accounts INNER JOIN students ON savings_accounts.student_id = students.id WHERE savings_accounts.id = $id");
$savingAccount = $data->fetch_assoc();

if (!$savingAccount) {
    header('Location: index.php');
}
?>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php include_once '../../../layout/navbar.php'; ?>
            <?php include_once '../../../layout/sidebar.php'; ?>
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Transactions</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
                            <div class="breadcrumb-item"><a href="/website/saving-accounts/index.php">Saving Account</a></div>
                            <div class="breadcrumb-item">Transactions</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <!-- Detail Row -->
                        <div class="row">
                            <div class="col-lg-8 col-md-6  col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Detail Saving Account</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <td style="width: 20%;"><b>Nomor Akun</b></td>
                                                <td style="width: 8%;">:</td>
                                                <td><?php echo $savingAccount['account_number']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 20%;"><b>Nama Siswa</b></td>
                                                <td style="width: 8%;">:</td>
                                                <td><?php echo $savingAccount['name']; ?></td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6  col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Saldo</h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo 'Rp' . number_format($savingAccount['balance'], 2, ',', '.'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>List Transactions</h4>
                                        <div class="card-header-form d-flex">
                                            <form class="mr-2">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Cari Nama" name="search">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <button type="button" class="btn btn-primary" id="addModal">
                                                Tambah Transaksi
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive mb-4">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Jenis Transaksi</th>
                                                        <th>Nominal</th>
                                                        <th>Staff Name</th>
                                                        <th>Detail</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $accountId = $_GET['id'];

                                                    if (!empty($_GET['search'])) {
                                                        $search = $_GET['search'];
                                                        $data = $conn->query("SELECT transactions.id, transactions.transaction_date, transactions.transaction_type, transactions.amount, users.username FROM transactions INNER JOIN users ON transactions.staff_id = users.id WHERE transactions.account_id = $accountId AND users.username LIKE '%$search%'");
                                                    } else {
                                                        $data = $conn->query("SELECT transactions.id, transactions.transaction_date, transactions.transaction_type, transactions.amount, users.username FROM transactions INNER JOIN users ON transactions.staff_id = users.id WHERE transactions.account_id = $accountId");
                                                    }

                                                    foreach ($data as $key => $value) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $key + 1; ?>
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
                                                                <?php echo 'Rp' . number_format($value['amount'], 2, ',', '.'); ?>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-primary">
                                                                    <?php echo $value['username']; ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-warning btn-sm btn-icon mb-2 editModal" data-id="<?php echo $value['id']; ?>" data-date="<?php echo $value['transaction_date']; ?>" data-type="<?php echo $value['transaction_type']; ?>" data-amount="<?php echo $value['amount']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-danger btn-sm btn-icon mb-2 deleteModal" data-id="<?php echo $value['id']; ?>" data-name="<?php echo $value['transaction_date']; ?>">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
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
            <?php include_once '../../../layout/footer.php'; ?>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="formModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Tambah Transaksi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="action_create.php" method="POST">
                    <div class="modal-body">
                        <input type="text" name="id" value="" hidden>
                        <input type="text" name="account_id" value="<?php echo $accountId; ?>" hidden>
                        <div class="form-group">
                            <label for="transaction_date">Transaction Date</label>
                            <input type="datetime-local" class="form-control" name="transaction_date" id="transaction_date" required>
                        </div>
                        <div class="form-group">
                            <label for="transaction_type">Transaction Type</label>
                            <select class="form-control" name="transaction_type" id="transaction_type" required>
                                <option value="deposit">Deposit</option>
                                <option value="withdrawal">Withdraw</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        IDR
                                    </div>
                                </div>
                                <input type="text" name="amount" class="form-control currency" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once '../../../layout/script.php'; ?>
    <script src="/assets/js/page/bootstrap-modal.js"></script>
    <script src="/assets/modules/cleave-js/dist/cleave.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cleave = new Cleave('.currency', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });

            $('.editModal').on('click', function() {
                var id = $(this).data('id');
                var date = $(this).data('date');
                var type = $(this).data('type');
                var amount = $(this).data('amount');

                // Change format date

                $('#formModal').modal('show');
                $('#formModal').find('form').attr('action', 'action_update.php');

                $('#formModal').find('[name="id"]').val(id);
                $('#formModal').find('[name="transaction_date"]').val(date);
                $('#formModal').find('[name="transaction_type"]').val(type);
                $('#formModal').find('[name="amount"]').val(amount);
            });

            $('#addModal').on('click', function() {
                $('#formModal').modal('show');
                $('#formModal').find('form').attr('action', 'action_create.php');
                $('#formModal').find('[name="transaction_date"]').val('<?php echo date('Y-m-d\TH:i'); ?>');
                $('#formModal').find('[name="transaction_type"]').val('deposit');
                $('#formModal').find('[name="amount"]').val('');
            });
            
            $('.deleteModal').click(function() {
                var id = $(this).data('id');

                var name = $(this).data('name');
                swal({
                        title: "Are you sure?",
                        text: "Once deleted you will not be able to recover data " + name + "!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location = "action_delete.php?id=" + id;
                        }
                    });
            });
        });
    </script>
</body>

</html>