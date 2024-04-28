<?php session_start(); ?>

<?php include('../server/connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="decription" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Home</title>


    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/style.css">



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media(min-width:768px) {
            .bd-placeholder-img-lg {
                font: size 3.5rem;
            }
        }

        .edit {
            background-color: #104C64;
            color: white;
        }

        .delete {
            background-color: #ae445a;
            color: white;
        }

        .edit-image {
            background-color: #f39f5a;
        }

        .text {
            color: rgb(72, 55, 55);

        }

        .text:hover {
            color: black;
        }

        .link {
            font-weight: bold;
            color: #0f969c;
        }

        .link:hover {
            color: rgb(72, 55, 55);
        }

        .bg-header {
            background-color: rgb(72, 55, 55);
        }
    </style>
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-header flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">Blondie</a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                    <a class="nav-link px-3" href="logout.php?logout=1">Sign Out</a>

                <?php } ?>
            </div>
        </div>
    </header>