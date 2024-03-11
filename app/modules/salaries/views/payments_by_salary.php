<table class="table table-condensed">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Metodo de pago</th>
        <th>Cuenta Bancaria</th>
        <th><?= lang('lbl_amount') ?></th>
        <th></th>
    </tr>
    <?php $total = 0; foreach ($payments as $p) { $total += $p->amount; ?>
        <tr>
            <td>
                <?= $p->id ?>
            </td>
            <td>
                <?= formatDate($p->date_payment, 'Y-m-d', 'd/m/Y') ?>
            </td>
            <td>
                <?= types_of_payment()[$p->type_payment] ?>
            </td>
            <td><a href="<?php echo site_url('banks/edit/'.$p->fk_bank_account) ?>"><?= $p->bank ?></a></td>
            <td>
                <?= $p->amount ?>
            </td>
            <td>
                <span class="btn btn-sm btn-danger po-delete-pay" id="<?= $p->id ?>">
                    <i class="fa fa-trash"></i>
                </span>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <th colspan="4">Total pagado</th>
        <th><?= $total ?></th>
    </tr>
</table>