<header id="header" class="navbar">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('welcome') ?>"><span class="logo">
                <?= html_escape($this->settings_lib->item('site.title')) ?>
            </span></a>

        <div class="btn-group visible-xs pull-right btn-visible-sm">
            <button class="navbar-toggle btn" type="button" data-toggle="collapse" data-target="#sidebar_menu">
                <span class="fa fa-bars"></span>
            </button>
            <a href="<?= site_url('calendar') ?>" class="btn">
                <span class="fa fa-calendar"></span>
            </a>
            <a href="<?= site_url('users/profile/' . $this->session->userdata('user_id')); ?>" class="btn">
                <span class="fa fa-user"></span>
            </a>
            <a href="<?= site_url('logout'); ?>" class="btn">
                <span class="fa fa-sign-out"></span>
            </a>
        </div>

        <div class="header-nav">
            <ul class="nav navbar-nav pull-right">
                <?php
                $userDisplayName = isset($current_user->display_name) && !empty($current_user->display_name) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email);
                ?>
                <li class="dropdown">
                    <a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo gravatar_link($current_user->email, 50, null, $userDisplayName, 'mini_avatar img-rounded'); ?>
                        <div class="user">
                            <span>
                                <?= lang('welcome') ?> <?= $userDisplayName; ?>
                            </span>
                        </div>
                    </a>

                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="<?= site_url('users/profile/' . $this->session->userdata('user_id')); ?>">
                                <i class="fa fa-user"></i>
                                <?= lang('us_profile'); ?>
                            </a>
                        </li>
                        <li>
                            <a
                                href="<?= site_url('users/profile/' . $this->session->userdata('user_id') . '/#cpassword'); ?>"><i
                                    class="fa fa-key"></i>
                                <?= lang('us_change_password'); ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= site_url('logout'); ?>">
                                <i class="fa fa-sign-out"></i>
                                <?= lang('us_logout'); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown hidden-xs"><a class="btn tip" title="<?= lang('dashboard') ?>"
                        data-placement="bottom" href="<?= site_url('welcome') ?>"><i class="fa fa-dashboard"></i></a>
                </li>
                <li class="dropdown hidden-sm">
                    <a class="btn tip" title="<?= lang('settings') ?>" data-placement="bottom"
                        href="<?= site_url('settings') ?>">
                        <i class="fa fa-cogs"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>