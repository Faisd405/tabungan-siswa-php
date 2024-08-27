<!-- General JS Scripts -->
<script src="/tabungan-siswa-web/assets/modules/jquery.min.js"></script>
<script src="/tabungan-siswa-web/assets/modules/popper.js"></script>
<script src="/tabungan-siswa-web/assets/modules/tooltip.js"></script>
<script src="/tabungan-siswa-web/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="/tabungan-siswa-web/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="/tabungan-siswa-web/assets/modules/moment.min.js"></script>
<script src="/tabungan-siswa-web/assets/js/stisla.js"></script>
<script src="/tabungan-siswa-web/assets/modules/sweetalert/sweetalert.min.js"></script>

<!-- Template JS File -->
<script src="/tabungan-siswa-web/assets/js/scripts.js"></script>
<script src="/tabungan-siswa-web/assets/js/custom.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['success'])) { ?>
            swal({
                title: "Success",
                text: `<?php echo $_SESSION['success']; ?>`,
                icon: "success",
            });

        <?php
        }
        unset($_SESSION['success']);
        ?>

        <?php if (isset($_SESSION['error'])) { ?>
            swal({
                title: "Error",
                text: `<?php echo $_SESSION['error']; ?>`,
                icon: "error",
            });
        <?php
        }
        unset($_SESSION['error']);
        ?>
    });
</script>