<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Charanjit Chana" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <link rel="icon" type="image/x-icon" href="/images/goodgearclub.png?cache=<?php echo __CACHE; ?>" />
    <link rel="stylesheet" type="text/css" href="/css/style.css?cache=<?php echo __CACHE; ?>" />
    <link rel="stylesheet" type="text/css" href="/css/fontawesome/css/all.min.css?cache=<?php echo __CACHE; ?>" />
    <title><?php echo $title.' – '.__TITLE; ?></title>
    <link rel="apple-touch-icon" href="/images/app-icon.png?cache=<?php echo __CACHE; ?>" />
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
                <li><a href="/compete/activity">My Activity</a></li>
                <li><?php echo $_SESSION['user']; ?></li>
                <li><a href="/compete/logout">Logout</a></li>
                <li><input type="checkbox" id="menu" name="menu" /><label for="menu">=</label></li>
                <?php } ?>
            </ul>
        </nav>

        <div class="heading">
            <h1><?php echo $title; ?></h1>
            <?php
            $hideOn = [
                '/',
                '/compete/activity/add'
            ];
            if(!in_array($_SERVER['REQUEST_URI'], $hideOn)) { ?>
            <p><a href="/compete/activity/add" class="btn">+<span> Activity</span></a></p>
            <?php } ?>
        </div>

    </header>

    <article>

        <?php if(isset($subtitle)) { ?>
        <h2><?php echo $subtitle; ?></h2>
        <?php } ?>
