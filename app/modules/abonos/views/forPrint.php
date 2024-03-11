<?php if (isset($abonos) && !empty($abonos)): ?>
    <div class="box">
        <div class="box-content">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $attrib = ['role' => 'form', 'method' => 'post'];
                    echo form_open('abonos/createMultiple', $attrib);
                    ?>				
                    <table id="PassTable" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10%">Abono N°</th>
                                <th style="width: 23%">Apellido y Nombre/s</th>
                                <th style="width: 20%">Origen</th>
                                <th style="width: 20%">Destino</th>
                                <th style="width: 8%">Ida</th>
                                <th style="width: 8%">Vuelta</th>
                                <th style="width: 8%">Descuento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($abonos as $abono): ?>
                            <input type="hidden" name="abonos[]" value="<?= $abono['abono_id'] ?>">   
                            <tr>
                                <td><?= $abono['abono_id'] ?></td>
                                <td><?= $abono['passenger'] ?></td>
                                <td><?= $abono['from'] ?></td>
                                <td><?= $abono['to'] ?></td>
                                <td><?= $abono['ida'] ?></td>
                                <td><?= $abono['vta'] ?></td>
                                <td><?= $abono['discount'] ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <button class="btn btn-default" name="print" type="submit">
                        <i class="fa fa-print"></i> Imprimir
                    </button>				
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
 endif ?>