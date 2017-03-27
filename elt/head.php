<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Retrouvez toutes les informations de la M2L sur ce site!"/>
    <link href="css/style.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Crete+Round" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"/>
    <link rel="icon" type="image/png" href="images/favicon.ico" />
    <meta name="theme-color" content="#ffffff">
    <?php
        if(isset($redirect)) {
    ?>
    <meta http-equiv="refresh" content="<?php if(isset($timeLimit)) echo $timeLimit; ?>" URL="<?php if(isset($urlRedirect)) echo $urlRedirect; ?>">
    <?php
        }
    ?>
    <title>Maison des ligues - <?php echo $title; ?></title>
</head>