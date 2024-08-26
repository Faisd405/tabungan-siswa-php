<?php include_once '../../layout/header.php'; ?>
<?php include_once '../../config/database.php'; ?>
<?php include_once '../../config/authorization.php'; ?>

<?php

if (!$_GET['id']) {
    header('Location: index.php');
}

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM savings_accounts WHERE id = $id");
$savingAccount = $data->fetch_assoc();

if (!$savingAccount) {
    header('Location: index.php');
}
?>

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
                            <div class="breadcrumb-item"><a href="index.php">Saving Accounts</a></div>
                            <div class="breadcrumb-item">Edit</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Edit Saving Accounts</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <form method="POST" action="action_create.php">
                                            <div class="form-group row mb-4">
                                                <label for="student_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Siswa</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <?php
                                                    $students = mysqli_query($conn, "SELECT id,name FROM students");
                                                    ?>
                                                    <select class="form-control" name="student_id" id="student_id" required>
                                                        <option value="">Pilih Siswa</option>
                                                        <?php while ($student = mysqli_fetch_assoc($students)) : ?>
                                                            <option value="<?= $student['id'] ?>" <?php if ($student['id'] == $savingAccount['id']) echo 'selected' ?>><?= $student['name'] ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="balance" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Saldo Awal</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                IDR
                                                            </div>
                                                        </div>
                                                        <input type="text" name="balance" class="form-control currency" required value="<?= $savingAccount['balance'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- JUSTIFY END -->
                                            <div class="form-group row mb-4">
                                                <label for="justify" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                <div class="col-sm-12 col-md-7">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <a href="index.php" class="btn btn-danger">Cancel</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php include_once '../../layout/footer.php'; ?>
    </div>
    </div>

    <?php include_once '../../layout/script.php'; ?>
    <script src="/assets/modules/cleave-js/dist/cleave.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cleave = new Cleave('.currency', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });
    </script>
</body>

</html>