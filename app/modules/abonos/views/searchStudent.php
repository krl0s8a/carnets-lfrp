<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">Seleccione al alumno de la lista o busquelo por su DNI.</div>
            <div class="panel-body" style="padding: 5px;">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="posupplier">Por apellido y nombre</label>
                        <select name="passenger_id" id="passenger_id" class="form-control">
                            <option value="">--Seleccione--</option>
                            <?php foreach ($students as $k => $v): ?>
                                <option value="<?php echo $k ?>"><?php echo $v; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="posupplier">Por DNI</label>
                        <div class="input-group">
                            <input type="number" max="99999999" name="dnis" id="dnis" class="form-control">
                            <div class="input-group-addon" style="padding: 2px 5px; border-left: 0;">
                                <a href="#" class="external search-student">
                                    <i class="fa fa-2x fa-search" id="addIcon"></i>
                                </a>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group"><br>Si el alumno no esta registrado agregarlo desde <a href="<?= site_url('abonos/addStudent'); ?>" data-toggle='modal' data-target='#myModal'><i class="fa fa-plus-circle"></i> Aqui</a><br>
                        <small class="no-student text-danger"></small>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>
<table id="StudentsTable" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th style="width: 8%">Abono N°</th>
            <th style="width: 8%">Código</th>
            <th style="width: 20%">Apellido y Nombre/s</th>
            <th style="width: 15%">Origen</th>
            <th style="width: 15%">Destino</th>
            <th style="width: 10%">Linea</th>
            <th style="width: 8%">Ida</th>
            <th style="width: 8%">Vuelta</th>
            <th style="width: 8%">Descuento</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<button class="btn btn-primary" type="submit" name="save">Crear</button>
<script type="text/javascript" src="<?php echo site_url('assets/js/modal.js') ?>"></script>