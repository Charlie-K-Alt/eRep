<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
            <?php include_once('includes/sidesbar.php'); ?>
        <!-- fin Sidebar -->
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <!-- entête -->
                <?php include_once('includes/entete.php'); ?>
                <!-- fin entête -->

            <!-- Content -->
                <div id="blocMatiere"></div>
                <div id="blocApprenant"></div>
                <div id="blocNiveau"></div>
                <div id="blocRepetiteur"></div>
                <div id="blocUtilisateur"></div>
                <?php include_once('matiere.html.twig'); ?>
            <!-- Fin Content -->
        </div>
            <!-- footer -->
            <?php include_once('includes/footer.php'); ?>
            <!-- fin footer -->

    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>