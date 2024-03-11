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
        <!-- Boletos -->
        <li class="mm_tickets <?php echo $boletos ? 'active' : ''; ?>">
            <a class="dropmenu" href="#">
                <i class="fa fa-credit-card"></i>
                <span class="text"> Boletos </span>
                <span class="chevron closed"></span>
            </a>
            <ul <?php echo $boletos ? 'style="display: block;"' : ''; ?>>
                <!-- Abonos -->
                <li id="sb_abonos" class="<?php echo class_exists('abonos') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('abonos'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('abonos'); ?>
                        </span>
                    </a>
                </li>
                <!-- Asignacion de boletos  -->
                <li id="sb_assignments" class="<?php echo class_exists('assignments') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('assignments'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('assignments') ?>
                        </span>
                    </a>
                </li>
                <li id="sb_scrolls" class="<?php echo class_exists('scrolls') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('scrolls'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('scrolls'); ?>
                        </span>
                    </a>
                </li>
                <li id="sb_tickets" class="<?php echo class_exists('tickets') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('tickets'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('ticket_types'); ?>
                        </span>
                    </a>
                </li>
                <li id="sb_collections" style="display: none;"
                    class="<?php echo class_exists('collections') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('collections'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('collection') ?>
                        </span>
                    </a>
                </li>
                <!--Tarifa de abonos-->
                <li id="sb_tariffs" class="<?php echo class_exists('tariffs') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('tariffs'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('tariffs'); ?>
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Trafico -->
        <li class="mm_traffic <?php echo $traffic ? 'active' : ''; ?>">
            <a class="dropmenu" href="#">
                <i class="fa fa-random"></i>
                <span class="text">
                    <?= lang('traffic'); ?>
                </span>
                <span class="chevron closed"></span>
            </a>
            <ul <?php echo $traffic ? 'style="display:block"' : ''; ?>>
                <li id="sb_trips" class="<?php echo class_exists('trips') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?php echo site_url('trips'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('trips'); ?>
                        </span>
                    </a>
                </li>
                <li id="sb_services" class="<?php echo class_exists('services') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?php echo site_url('services'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('services'); ?>
                        </span>
                    </a>
                </li>
                <li id="sb_routes" class="<?php echo class_exists('routes') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?php echo site_url('routes'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('routes'); ?>
                        </span>
                    </a>
                </li>
                <li id="sb_lines" class="<?php echo class_exists('lines') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?php echo site_url('lines'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('lines'); ?>
                        </span>
                    </a>
                </li>
                <li id="sb_trips" class="<?php echo class_exists('cities') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?php echo site_url('cities'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('cities'); ?>
                        </span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- schools -->
        <li id="submenu_customers" class="<?php echo class_exists('schools') ? 'active' : ''; ?>">
            <a class="submenu" href="<?= site_url('schools'); ?>">
                <i class="fa fa-university"></i><span class="text">
                    <?= lang('schools'); ?>
                </span>
            </a>
        </li>
        <!-- Customers -->
        <li id="submenu_customers" class="<?php echo class_exists('passengers') ? 'active' : ''; ?>">
            <a class="submenu" href="<?= site_url('passengers'); ?>">
                <i class="fa fa-users"></i><span class="text">
                    <?= lang('passengers'); ?>
                </span>
            </a>
        </li>
        <!-- Terceros -->
        <li class="mm_societe <?php echo class_exists('societe') ? 'active' : ''; ?>">
            <a href="<?= site_url('societe') ?>">
                <i class="fa fa-building"></i>
                <span class="text">
                    <?= lang('people'); ?>
                </span>
            </a>
        </li>
        <!-- Empresa -->
        <li class="mm_corporate <?php echo $business ? 'active' : ''; ?>">
            <a class="dropmenu" href="#">
                <i class="fa fa-th-large"></i>
                <span class="text">
                    <?= lang('company'); ?>
                </span>
                <span class="chevron closed"></span>
            </a>
            <ul <?php echo $business ? 'style="display:block"' : ''; ?>>
                <li id="sb_employees" class="<?php echo class_exists('employees') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('employees'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('employees'); ?>
                        </span>
                    </a>
                </li>
                <!-- Puntos de venta -->
                <li id="sb_points" class="<?php echo class_exists('points') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('points'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('points') ?>
                        </span>
                    </a>
                </li>
                <!-- Vehiculos -->
                <li id="sb_buses" class="<?php echo class_exists('buses') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('buses'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('buses'); ?>
                        </span>
                    </a>
                </li>
            </ul>
        </li>


        <!-- Bancos y cajas -->
        <li class="mm_bank <?php echo class_exists('banks') ? 'active' : ''; ?>">
            <a href="<?= site_url('banks') ?>">
                <i class="fa fa-bank"></i>
                <span class="text">
                    <?php echo lang('banks') ?>
                </span>
            </a>
        </li>
        <!-- Operaciones -->
        <li class="mm_business <?php echo $operations ? 'active' : ''; ?>" style="display:none;">
            <a class="dropmenu" href="#">
                <i class="fa fa-star"></i>
                <span class="text">
                    <?= lang('operations') ?>
                </span>
                <span class="chevron closed"></span>
            </a>
            <ul <?php echo $operations ? 'style="display:block"' : ''; ?>>
                <!-- Puntos de venta -->
                <li id="sb_purchases" class="<?php echo class_exists('purchases') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('purchases'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?php echo lang('purchases') ?>
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Financiera -->
        <li class="mm_financial <?php echo $financial ? 'active' : ''; ?>">
            <a class="dropmenu" href="#">
                <i class="fa fa-dollar"></i>
                <span class="text"> Financiera </span>
                <span class="chevron closed"></span>
            </a>
            <ul <?php echo $financial ? 'style="display:block"' : ''; ?>>
                <!-- Sueldos -->
                <li iid="sb_salary" class="<?php echo class_exists('salaries') ? 'active' : ''; ?>">
                    <a class="submenu" href="<?= site_url('salaries'); ?>">
                        <i class="fa fa-minus"></i><span class="text">
                            <?= lang('salary') ?>
                        </span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Notifications -->
        <li class="mm_notifications" style="display: none;">
            <a class="submenu" href="<?= site_url('notifications'); ?>">
                <i class="fa fa-info-circle"></i><span class="text">
                    <?= lang('notifications'); ?>
                </span>
            </a>
        </li>
        <!-- Calendar -->
        <li class="mm_calendar" style="display: none;">
            <a class="submenu" href="<?= site_url('calendar'); ?>">
                <i class="fa fa-calendar"></i><span class="text">
                    <?= lang('calendar'); ?>
                </span>
            </a>
        </li>
        <!-- Settings -->
        <li class="mm_settings <?php echo $settings ? 'active' : ''; ?>">
            <a class="dropmenu" href="#">
                <i class="fa fa-cogs"></i>
                <span class="text">
                    <?= lang('system'); ?>
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