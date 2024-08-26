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
                        <h1>Student</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
                            <div class="breadcrumb-item">Student</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>List Student</h4>
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
                                                        <th>

                                                        </th>
                                                        <th>NIS</th>
                                                        <th>Nama</th>
                                                        <th>Nama Orangtua</th>
                                                        <th>Kelas</th>
                                                        <th>Tanggal Lahir</th>
                                                        <th>Alamat</th>
                                                        <th style="width: 12%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    if (!empty($_GET['search'])) {
                                                        $search = $_GET['search'];
                                                        $data = $conn->query("SELECT * FROM students WHERE name LIKE '%$search%'");
                                                    } else {
                                                        $data = $conn->query("SELECT * FROM students");
                                                    }

                                                    foreach ($data as $key => $value) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $key + 1; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['nis']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['name']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['parent_name']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['class']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['date_of_birth']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['address']; ?>
                                                            </td>
                                                            <td style="width: 12%">
                                                                <a href="edit.php?id=<?php echo $value['id']; ?>" class="btn btn-warning btn-sm btn-icon">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-danger btn-sm btn-icon">
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