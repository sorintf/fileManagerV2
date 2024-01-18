<!DOCTYPE html>
<html lang="ro">

<!-- [Head] start -->
<head>
    <title>Basic CMS</title>

    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Basic CMS to start off any custom implementation">
    <meta name="author" content="Two & From">

    <!-- [Favicon] icon -->
    <link rel="icon" href="/admin_files/assets/images/favicon.svg" type="image/x-icon">
    <!-- [Font] Family -->
    <link rel="stylesheet" href="/admin_files/assets/fonts/inter/inter.css" id="main-font-link" />

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="/admin_files/assets/fonts/tabler-icons.min.css" />

    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="/admin_files/assets/fonts/feather.css" />

    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="/admin_files/assets/fonts/fontawesome.css" />

    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="/admin_files/assets/fonts/material.css" />


    <?php if ($adminFunctions->dataTable): ?>
        <!-- data tables css -->
        <link rel="stylesheet" href="/admin_files/assets/css/plugins/dataTables.bootstrap5.min.css">
    <?php endif ?>

    <?php if ($adminFunctions->pageSel2): ?>
        <!-- select2 css -->
        <link rel="stylesheet" href="/admin_files/assets/css/plugins/select2.min.css">
    <?php endif ?>

    <?php if ($adminFunctions->fileUploader): ?>
        <!-- fileUpdloader (uppy) css -->
        <link rel="stylesheet" href="/admin_files/assets/css/plugins/uppy.min.css">
    <?php endif ?>


    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="/admin_files/assets/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="/admin_files/assets/css/style-preset.css" />


    <link rel="stylesheet" href="/admin_files/assets/css/custom.css?v=<?php echo $adminFunctions->version; ?>" />
</head>
<!-- [Head] end -->

<!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->