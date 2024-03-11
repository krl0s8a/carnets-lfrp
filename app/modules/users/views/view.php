<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-eye"></i>
                <?php echo lang('us_view_user'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'frmCreate'] ?>
        <?php echo form_open('cities/create', $attrib); ?>
        <div class="modal-body">
            <div class="alerts-modal"></div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th>
                                <?= lang('us_employee') ?>
                            </th>
                            <td><?=($user->employee == 1) ? 'Si' : 'No' ?></td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('bf_username') ?>
                            </th>
                            <td>
                                <?= $user->username ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('bf_email') ?>
                            </th>
                            <td>
                                <?= $user->email ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_last_name') ?>
                            </th>
                            <td>
                                <?= $user->last_name ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_first_name') ?>
                            </th>
                            <td>
                                <?= $user->first_name ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_birth_date') ?>
                            </th>
                            <td>
                                <?= isset($user) && is_object($user) ? formatDate($user->birth, 'Y-m-d', 'd/m/Y') : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_gender') ?>
                            </th>
                            <td>
                                <?= $user->gender ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_cuil') ?>
                            </th>
                            <td>
                                <?= $user->cuil ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_position') ?>
                            </th>
                            <td>
                                <?= $user->position ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_work_file') ?>
                            </th>
                            <td>
                                <?= isset($user) && is_object($user) ? $user->work_file : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_dateemployment') ?>
                            </th>
                            <td>
                                <?= isset($user) && is_object($user) ? formatDate($user->dateemployment, 'Y-m-d', 'd/m/Y') : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_dateemploymentend') ?>
                            </th>
                            <td>
                                <?= isset($user) && is_object($user) ? formatDate($user->dateemploymentend, 'Y-m-d', 'd/m/Y') : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_address') ?>
                            </th>
                            <td>
                                <?= isset($user) && is_object($user) ? $user->address : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_city') ?>
                            </th>
                            <td>
                                <?= isset($user) && is_object($user) ? $user->city : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_state') ?>
                            </th>
                            <td>
                                <?= isset($user) && is_object($user) ? $user->state : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?= lang('us_movil_phone') ?>
                            </th>
                            <td>
                                <?= isset($user) && is_object($user) ? $user->movil_phone : '' ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="<?php echo base_url('users/edit/' . $user->id) ?>" class="btn btn-link">
                <?php echo 'Ir a ' . lang('bf_action_modify') . ' ' . lang('bf_user'); ?>
            </a>
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                <?= lang('close') ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>