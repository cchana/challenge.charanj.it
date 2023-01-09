<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Charanjit Chana" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <link rel="icon" type="image/x-icon" href="/images/goodgearclub.png?cache=2023.110.197957278" />
    <link rel="stylesheet" type="text/css" href="/css/style.css?cache=2023.110.197957278" />
    <link rel="stylesheet" type="text/css" href="/css/fontawesome/css/all.min.css?cache=2023.110.197957278" />
    <title><?php echo $title.' – '.__TITLE; ?></title>
    <link rel="apple-touch-icon" href="/images/app-icon.png?cache=2023.110.197957278" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php echo __TITLE; ?>" />
    <meta name="application-name" content="<?php echo __TITLE; ?>" />
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#EDE5F4" />
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#180D23" />
    <link rel="manifest" href="/manifest.json">
    <meta name="robots" content="noindex" />
</head>
<body<?php

if(isset($pageId)) {
    echo ' id="'.$pageId.'"';
}

?>>

<main>

    <header>

        <nav>
            <ul>
                <li <?php if($_SERVER['REQUEST_URI'] == '/') {echo 'class="active"';} ?>><a href="/"><img src="/images/logo.png?v=<?php echo __CACHE; ?>" alt="Challenge" /></a></li>
                <li><a href="#" onclick="return refresh();">Refresh</a></li>
                <?php if(isset($_SESSION['hash'])) { ?>
                <li><a href="/compete/activity/add">Add Activity</a></li>
                <li><a href="/compete/activity">My Activity</a></li>
                <li><a href="/compete/logout">Logout <?php echo $_SESSION['user']; ?></a></li>
                <?php } ?>
            </ul>
        </nav>

        <h1><?php echo $title; ?></h1>

    </header>

    <article>

        <?php if(isset($subtitle)) { ?>
        <h2><?php echo $subtitle; ?></h2>
        <?php } ?>
