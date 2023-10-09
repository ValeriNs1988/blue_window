<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="../assets/css/responsive.css">
    <script type="text/javascript" src="../assets/javascript/main.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Manage a to-do list</title>
</head>
<body>
<button id="scrollToTopBtn" class="scroll-to-top-btn rel" title="Scroll to Top">
    <p class="scroll-to-top-icon position-absolute"></p>
</button>

<header>
    <div class="bg-info pt-3 pb-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand text-white" href="index">ToDoList</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <div class="navbar-nav ml-auto text-white">
                            <a class="nav-item nav-link text-white" href="registration">Register</a>
                            <a class="nav-item nav-link text-white" href="login">Login</a>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="navbar-nav ml-auto">
                            <a class="nav-item nav-link text-white" href="profile">Profile</a>
                            <a class="nav-item nav-link text-white"  href="dashboard">Dashboard</a>
                            <a class="nav-item nav-link text-white" href="logout">Logout</a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

        </div>
    </div>
</header>







