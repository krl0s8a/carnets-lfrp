<?php
Assets::add_css(
        array(
            'styles/theme.css',
            'styles/style.css'
        )
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?php
        echo isset($toolbar_title) ? "{$toolbar_title} : " : '';
        echo (class_exists('Settings_lib') ? settings_item('site.title') : 'Futuro SRL');
        ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo(isset($meta_description) ? $meta_description : ''); ?>">
    <meta name="author" content="<?php echo(isset($meta_author) ? $meta_author : ''); ?>">
    <link rel="shortcut icon" href="<?php echo site_url('assets/images/icon.png'); ?>">
    <?php echo Assets::css(null, true); ?>  
    <script type="text/javascript" src="<?= site_url('assets/js/jquery-2.0.3.min.js') ?>"></script>
    <script type="text/javascript" src="<?= site_url('assets/js/jquery-migrate-1.2.1.min.js') ?>"></script>
    <noscript><style type="text/css">#loading { display: none; }</style></noscript>
    <script type="text/javascript">
        $(window).load(function () {
            $("#loading").fadeOut("slow");
        });
    </script>  
</head>
<body>
    <noscript>
        <div class="global-site-notice noscript">
            <div class="notice-inner">
                <p><strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript enabled in
                    your browser to utilize the functionality of this website.</p>
            </div>
        </div>
    </noscript>
    <form><input type="hidden" id="base_url" value="<?php echo base_url(); ?>"></form>
    <div id="loading"></div>
    <div id="app_wrapper">