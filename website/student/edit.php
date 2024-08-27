<?php include_once '../../layout/header.php'; ?>
<?php include_once '../../config/database.php'; ?>
<?php include_once '../../config/authorization.php'; ?>

<?php

if (!$_GET['id']) {
    header('Location: index.php');
}

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM students WHERE id = $id");
$student = $data->fetch_assoc();

if (!$student) {
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
                        <h1>Student</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
                            <div class="breadcrumb-item"><a href="index.php">Student</a></div>
                            <div class="breadcrumb-item">Edit</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Edit Student</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <form method="POST" action="action_update.php">
                                            <input type="hidden" name="id" value="<?php echo $student['id'] ?>">
                                            <div class="form-group row mb-4">
                                                <label for="user_id" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">
                                                    Pengguna (Optional)
                                                </label>
                                                <div class="col-sm-12 col-md-7">
                                                    <?php
                                                    $users = mysqli_query($conn, "SELECT id,username FROM users WHERE role='siswa'");
                                                    ?>
                                                    <select class="form-control" name="user_id" id="user_id">
                                                        <option value="">Pilih Siswa</option>
                                                        <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                                                            <option value="<?= $user['id'] ?>" <?php echo $student['user_id'] == $user['id'] ? 'selected' : '' ?>><?= $user['username'] ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="nis" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIS</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" name="nis" id="nis" value="<?php echo $student['nis'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $student['name'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="parent_name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Parent Name</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" name="parent_name" id="parent_name" value="<?php echo $student['parent_name'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="class" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Class</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" name="class" id="class" value="<?php echo $student['class'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="date_of_birth" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Birth Date</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php echo $student['date_of_birth'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="address" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <textarea class="form-control" name="address" id="address" required><?php echo $student['address'] ?></textarea>
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
</body>

</html>