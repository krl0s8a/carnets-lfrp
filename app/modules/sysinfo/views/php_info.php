<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-list"></i>
            <?= lang('php'); ?>
        </h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sysinfoVersion-tab" data-toggle="tab" href="#sysinfoVersion"
                                role="tab" aria-controls="sysinfoVersion" aria-selected="true">
                                <?php echo lang('sysinfo_version') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sysinfoConfig-tab" data-toggle="tab" href="#sysinfoConfig"
                                role="tab" aria-controls="sysinfoConfig" aria-selected="false">
                                <?php echo lang('sysinfo_setting') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sysinfoCredits-tab" data-toggle="tab" href="#sysinfoCredits"
                                role="tab" aria-controls="sysinfoCredits" aria-selected="false">
                                <?php echo lang('sysinfo_credits') ?>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <?php echo $phpinfo; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>