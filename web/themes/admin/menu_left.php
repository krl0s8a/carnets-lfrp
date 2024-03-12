<?php
$boletos = class_exists('tariffs') || class_exists('abonos') || class_exists('collections') || class_exists('tickets') || class_exists('assignments') || class_exists('scrolls');
$education = class_exists('passengers') || class_exists('schools');
$traffic = class_exists('routes') || class_exists('services') || class_exists('cities') || class_exists('trips') || class_exists('lines');

$business = class_exists('points') || class_exists('buses') || class_exists('employees');
$operations = class_exists('purchases');
$financial = class_exists('salaries');
$rrhh = class_exists('rrhh');
$reports = class_exists('activities');
$settings = class_exists('users') || class_exists('roles') || class_exists('permissions') || class_exists('settings') || class_exists('backup') || class_exists('activities');
$developer = class_exists('sysinfo');
$uri2 = $this->uri->segment(2);
?>
<div class="sidebar-nav nav-collapse collapse navbar-collapse" id="sidebar_menu">
    <ul class="nav main-menu">
        <li class="mm_welcome">
            <a href="<?= site_url('welcome') ?>">
                <i class="fa fa-dashboard"></i>
                <span class="text">
                    <?= lang('dashboard'); ?>
                </span>
            </a>
        </li>
         <!-- Terceros -->
        <li class="mm_societe <?php echo class_exists('cards') ? 'active' : ''; ?>">
            <a href="<?= site_url('cards') ?>">
                <i class="fa fa-building"></i>
                <span class="text">
                    Carnets
                </span>
            </a>
        </li>
        <!-- Jugadores -->
        <li id="submenu_customers" class="<?php echo class_exists('players') ? 'active' : ''; ?>">
            <a class="submenu" href="<?= site_url('players'); ?>">
                <i class="fa fa-users"></i><span class="text">
                    Jugadores
                </span>
            </a>
        </li>
        <!-- Equipos -->
        <li id="submenu_customers" class="<?php echo class_exists('teams') ? 'active' : ''; ?>">
            <a class="submenu" href="<?= site_url('teams'); ?>">
                <i class="fa fa-users"></i><span class="text">
                    Equipos
                </span>
            </a>
        </li>
       
        <!-- Settings -->
        <li class="mm_settings <?php echo $settings ? 'active' : ''; ?>">
            <a class="dropmenu" href="#">
                <i class="fa fa-cogs"></i>
                <span class="text">
                    Ajustes
                </span>
                <span class="chevron closed"></span>
            </a>
            <ul <?php echo $settings ? 'style="display:block"' : ''; ?>>
                <li id="submenu_activities" class="<?php echo class_exists('activities') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('activities'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('activities') ?>
                        </span>
                    </a>
                </li>
                <li id="submenu_settings" class="<?php echo class_exists('settings') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('settings'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('setting') ?>
                        </span>
                    </a>
                </li>
                <li id="submenu_permissions" class="<?php echo class_exists('permissions') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('permissions'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('permissions') ?>
                        </span>
                    </a>
                </li>
                <li id="submenu_roles" class="<?php echo class_exists('roles') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('roles'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('roles') ?>
                        </span>
                    </a>
                </li>
                <li id="submenu_users" class="<?php echo class_exists('users') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('users'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('users'); ?>
                        </span>
                    </a>
                </li>
                <li style="display:none;" id="submenu_backup"
                    class="<?php echo class_exists('backup') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('backup'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('backup'); ?>
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Reports -->
        <li class="mm_reports <?php echo $reports ? 'active' : ''; ?>" style="display:none;">
            <a class="dropmenu" href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span class="text">
                    <?= lang('reports'); ?>
                </span>
                <span class="chevron closed"></span>
            </a>
            <ul <?php echo $reports ? 'style="display:block"' : ''; ?>>
                <li id="sb_activities" class="<?php echo class_exists('activities') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('activities') ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('activities') ?>
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="mm_developer <?php echo $developer ? 'active' : ''; ?>">
            <a class="dropmenu" href="#">
                <i class="fa fa-wrench"></i>
                <span class="text"> Desarrollo </span>
                <span class="chevron closed"></span>
            </a>
            <ul <?php echo $developer ? 'style="display:block"' : ''; ?>>
                <li id="submenu_settings" class="<?php echo class_exists('sysinfo') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('sysinfo'); ?>">
                        <i class="fa fa-minus"></i><span class="text"> Informacion sistema</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<a href="#" id="main-menu-act" class="full visible-md visible-lg">
    <i class="fa fa-angle-double-left"></i>
</a>