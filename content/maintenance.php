<?php
/**
 * Custom error page rather than database connection error
 * source: http://alexphelps.github.io/server-error-pages/
 * modifications: Onni Hakala / Geniem Oy
 */

// Prevent direct access
defined( 'ABSPATH' ) or die();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="503 Maintenance">
    <meta name="author" content="">
    <title>Site en maintenance</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <style>
        body {
            padding-top: 20px;
        }

        /* Layout */
        .jumbotron {
            font-size: 21px;
            font-weight: 200;
            line-height: 2.1428571435;
            color: inherit;
            padding: 10px 0px;
        }

        /* Everything but the jumbotron gets side spacing for mobile-first views */
        .masthead, .body-content, {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Main marketing message and sign up button */
        .jumbotron {
            text-align: center;
            background-color: transparent;
        }

        .jumbotron .btn {
            font-size: 21px;
            padding: 14px 24px;
        }

        /* Colors */
        .green {
            color: #5cb85c;
        }

        .orange {
            color: #f0ad4e;
        }

        .red {
            color: #d9534f;
        }
    </style>
    <script type="text/javascript">
        function loadDomain() {
            var display = document.getElementById("display-domain");
            display.innerHTML = document.domain;
        }
    </script>
</head>
<body onload="javascript:loadDomain();">
<!-- Page Content -->
<div class="container">
    <!-- Jumbotron -->
    <div class="jumbotron">
        <h1><i class="fa fa-exclamation-triangle orange"></i> Maintenance</h1>
        <p class="lead">Maintenance en cours sur <em><span
                        id="display-domain"><?php echo $_SERVER['HTTP_HOST']; ?></span></em>, nous revenons très vite.
        </p>
        <a href="javascript:document.location.reload(true);" class="btn btn-default btn-lg text-center"><span
                    class="green"> Recharger la page</span></a>
    </div>
</div>
<!-- End Page Content -->
<!--Scripts-->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>

