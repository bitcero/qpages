<?php
/*
Name        = Projects Page
Description = A standalone page for projects
Author      = Eduardo Cortés
Author URI  = http://eduardocortes.mx
Version     = 1.0
License     = GNU General Public License v2 or later
License URI = http://www.gnu.org/licenses/gpl-2.0.html
Standalone  = yes
*/
?>
<?php
include ('defaults.php');
?>
<!DOCTYPE html>
<html lang="<?php echo $cuSettings->lang; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $page->description != '' ? $page->description : $page->excerpt; ?>">
    <meta name="author" content="">
    <title><?php echo $page->custom_title != '' ? $page->custom_title : $page->title; ?></title>
    <link href="<?php echo RMCURL; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo QPFunctions::dynamic_style( $page, 'projects', 'css/style.css' ); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo RMCURL; ?>/css/font-awesome.min.css" type="text/css">
    <link href='<?php echo $tplSettings->heading; ?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo $tplSettings->body; ?>' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php echo XOOPS_URL; ?>/favicon.ico" type="image/x-icon" />
</head>
<body>
<div class="prj-top-line"></div>
<div class="container">

    <div class="row prj-header">
        <div class="col-xs-12 text-center-xs">
            <!-- logo image -->
            <a href="<?php echo XOOPS_URL; ?>"><img src="<?php echo $tplSettings->logo; ?>" alt="<?php echo $page->title; ?>" id="prj-logo" class="pull-left-md"></a>
            <ul class="list-inline pull-right prj-menu">
                <?php $links = explode("\n", $tplSettings->links ); ?>
                <?php foreach( $links as $link ): ?>
                <li><?php echo $link; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12" id="prj-content">

            <?php echo $page->content; ?>

        </div>

    </div>

    <div class="row" id="prj-footer">
        <div class="col-xs-6">
            <?php echo $tplSettings->copy; ?>
        </div>
        <div class="col-xs-6">
            <ul class="list-inline pull-right prj-footer-menu">
                <?php $links = explode("\n", $tplSettings->links ); ?>
                <?php foreach( $links as $link ): ?>
                    <li><?php echo $link; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>

</body>
</html>