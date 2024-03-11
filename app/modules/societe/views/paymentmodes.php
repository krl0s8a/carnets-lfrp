<?php echo validation_errors(); ?>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li><a href="<?php echo site_url('societe/edit/'.$societe->id); ?>" class="tab-grey"><?php echo lang('tab_societe'); ?></a></li>
            <li class="active"><a href="<?php echo site_url('societe/paymentmodes/'.$societe->id); ?>"><?php echo lang('payment_modes') ?></a></li>
        </ul>
        <div id="tab-content">
            <div id="tab-1" class="tab-pane fade in">
                <div class="box">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa-fw fa fa-bank"></i><?= lang('accounts_bank'); ?></h2>
                        <div class="box-icon">
                            <ul class="btn-tasks">
                                <li>
                                    <a data-toggle="modal" data-target="#myModal" href="<?php echo site_url('societe/create_paymentmode').'/'.$societe->id ?>"><i class="icon fa fa-plus" ></i></a>                                
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmEdit'] ?>
                    <?php echo form_open($this->uri->uri_string(), $attrib); ?>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0"
                                           class="table table-bordered table-condensed table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <td><?php echo lang('lbl_label') ?></td>
                                                <td><?php echo lang('lbl_bank'); ?></td>
                                                <td><?php echo lang('lbl_number') ?></td>
                                                <td style="text-align: center;"><?php echo lang('lbl_default_rib') ?></td>
                                                <td style="text-align: center;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($paymentsmode) && is_array($paymentsmode) && !empty($paymentsmode)): ?>
                                                <?php foreach ($paymentsmode as $v): ?>
                                                    <tr>
                                                        <td><?php echo $v->label; ?></td>
                                                        <td><?php echo $v->bank; ?></td>
                                                        <td><?php echo $v->number; ?></td>
                                                        <td style="text-align: center;">
                                                            <?php if ($v->default_rib == 1): ?>
                                                                <input type="checkbox" checked="checked" disabled="disabled">
                                                            <?php else: ?>
                                                                <input type="checkbox" disabled="disabled">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <span class="btn btn-sm"><i class="fa fa-edit"></i></span>
                                                            <span class="btn btn-sm"><i class="fa fa-trash"></i></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>