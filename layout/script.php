<!-- General JS Scripts -->
<script src="/assets/modules/jquery.min.js"></script>
<script src="/assets/modules/popper.js"></script>
<script src="/assets/modules/tooltip.js"></script>
<script src="/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="/assets/modules/moment.min.js"></script>
<script src="/assets/js/stisla.js"></script>
<script src="/assets/modules/sweetalert/sweetalert.min.js"></script>

<!-- Template JS File -->
<script src="/assets/js/scripts.js"></script>
<script src="/assets/js/custom.js"></script>

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