<?php include_once '../../layout/header.php'; ?>
<?php include_once '../../config/authorization.php'; ?>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php include_once '../../layout/navbar.php'; ?>
            <?php include_once '../../layout/sidebar.php'; ?>
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Users</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Datamaster</a></div>
                            <div class="breadcrumb-item"><a href="index.php">Users</a></div>
                            <div class="breadcrumb-item">Create</div>
                        </div>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Create Users</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <form method="POST" action="action_create.php">
                                            <div class="form-group row mb-4">
                                                <label for="username" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" name="username" id="username" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="role" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <select class="form-control" name="role" id="role">
                                                        <?php
                                                        if ($_SESSION['user']['role'] == 'admin') { ?>
                                                        <option value="staff">Staff</option>
                                                        <?php } ?>
                                                        <option value="siswa">Siswa</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group row mb-4">
                                                <label for="password" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="password" class="form-control" name="password" id="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label for="password_confirmation" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Confirmation</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                                </div>
                                            </div>
                                            <!-- JUSTIFY END -->
                                            <div class="form-group row mb-4">
                                                <label for="justify" class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                <div class="col-sm-12 col-md-7">
                                                    <button type="submit" class="btn btn-primary">Create</button>
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