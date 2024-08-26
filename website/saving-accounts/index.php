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
                        <h1>Saving Accounts</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
                            <div class="breadcrumb-item">Saving Accounts</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>List Saving Accounts</h4>
                                        <div class="card-header-form d-flex">
                                            <form class="mr-2">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Cari Nama" name="search">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="create.php" class="btn btn-primary">ADD</a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive mb-4">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Siswa</th>
                                                        <th>Nomer Akun</th>
                                                        <th>Saldo</th>
                                                        <th style="width: 12%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    if (!empty($_GET['search'])) {
                                                        $search = $_GET['search'];
                                                        $data = $conn->query("SELECT * FROM savings_accounts INNER JOIN students ON savings_accounts.student_id = students.id WHERE students.name LIKE '%$search%'");
                                                    } else {
                                                        $data = $conn->query("SELECT * FROM savings_accounts INNER JOIN students ON savings_accounts.student_id = students.id");
                                                    }

                                                    foreach ($data as $key => $value) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $key + 1; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['name']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['account_number']; ?>
                                                            </td>
                                                            <td>
                                                                <span class="currency">
                                                                    <?php echo 'Rp' . number_format($value['balance'], 2, ',', '.'); ?>
                                                                </span>
                                                            </td>
                                                            <td style="width: 12%">
                                                                <a href="edit.php?id=<?php echo $value['id']; ?>" class="btn btn-warning btn-sm btn-icon mb-2">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-danger btn-sm btn-icon mb-2">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
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