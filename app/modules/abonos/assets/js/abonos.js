function linkEdit(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'abonos/edit/' + y[1] + '">' + y[0] + '</a>';
}

var $frmCreate = $('#frmCreateAbono'),
    oTable = $('#AbonoTable').dataTable({
        "aaSorting": [[1, "desc"], [2, "asc"]],
        "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
        "iDisplayLength": oLengthMenu,
        'bProcessing': true, 'bServerSide': true,
        'sAjaxSource': 'abonos/getAbonos',
        'oLanguage': dt_lang,
        'fnServerData': function (sSource, aoData, fnCallback) {
            $.ajax({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback
            });
        },
        "aoColumns": [{
            "bSortable": false,
            "mRender": checkbox
            //}, { "mRender": linkEdit }, null, { "mRender": type }, null, null, null, { "mRender": abono_status, "bSortable": false }, { "bSortable": false }]
        }, { "mRender": linkEdit }, null, {"mRender":alignCenter}, null, null, null, {"mRender":alignCenter}, {"mRender":alignCenter}, { "mRender": abono_status, "bSortable": false }, { "bSortable": false }]
    });

function type(x) {
    if (x == 1) {
        return 'Docente';
    } else if (x == 2) {
        return 'Alumno';
    } else if(x == 3) {
        return 'Particular';
    } else {
        return 'Institucion';
    }
}

function abono_status(x) {
    var y = x.split('__');

    if (y[0] == 1) {
        r = '<span class="label label-success">Pendiente</span>';
    } else if (y[0] == 2) {
        r = '<span class="label label-warning">Impreso</span>';
    } else {
        r = '<span class="label label-danger">Anulado</span>';
    }
    return r;
}

// Funcion que trae los pasajeros
function getPassengers() {
    $.ajax({
        type: "post", async: false,
        url: site.base_url + 'abonos/ajaxGetPassengersBySchool',
        dataType: 'html',
        data: $frmCreate.serialize(),
    })
        .done(function (data) {
            $('#div_grid').css("display", "block");
            $('#grid').html(data);
        });
}
$('#school_id').on('change', function (e) {
    if (e && e.preventDefault) {
        e.preventDefault();
    }
    getPassengers();
});

$('#line_id').on('change', function (e) {
    let id = $(this).val();
    if (id != '') {
        $.ajax({
            url: '/abonos/getTariffsByLine',
            type: 'GET',
            dataType: 'html',
            data: { line_id: id }
        })
            .done(function (data) {
                $('#tariff_id').html(data);
            });
    }
    return false;
});

$('#step-1').on('click', function (e) {
    if (e && e.preventDefault) {
        e.preventDefault();
    }
    if ($('#school_id').val() == '' && $('#type').val() == 1) {
        alert('Seleccione una escuela');
        return false;
    }
    getPassengers();
});

$('#dni').on('blur', function (e) {
    dni = $(this).val();
    $.ajax({
        url: site.base_url + '/abonos/getPassengerByDni',
        type: 'GET',
        dataType: 'json',
        data: { dni: $(this).val() }
    })
        .done(function (data) {
            if (data != 0) {
                $('#last_name').val(data.last_name);
                $('#first_name').val(data.first_name);
                $('#passenger_id').val(data.id);
                $('#type').val(data.type);
            }
        })
        .fail(function () {
            console.log("error");
        });
});

$('#from').on('change', function (e) {
    let from = $(this).val(), to = $('#to').val();
    if (from != '' && to != '' && from != to) {
        $.ajax({
            url: site.base_url + 'abonos/getLines',
            type: 'GET',
            dataType: 'html',
            data: { from: from, to: to }
        })
            .done(function (html) {
                $('#line_id').html(html);
                $('#tariff_id').html('');
            })
            .fail(function () {
                console.log("error");
            });
    }
});

$('#to').on('change', function (e) {
    let from = $('#from').val(), to = $(this).val();
    if (from != '' && to != '' && from != to) {
        $.ajax({
            url: site.base_url + 'abonos/getLines',
            type: 'GET',
            dataType: 'html',
            data: { from: from, to: to }
        })
            .done(function (html) {
                $('#line_id').html(html);
                $('#tariff_id').html('');
            })
            .fail(function () {
                console.log("error");
            });
    }
});

$('#tariff_id').on('change', function (e) {
    let from = $('#from').val(), to = $('#to').val(), tariff_id = $(this).val();
    if (from != '' && to != '' && tariff_id != '') {
        $.ajax({
            url: site.base_url + 'abonos/getPrice',
            type: 'GET',
            dataType: 'json',
            data: { from: from, to: to, tariff_id: tariff_id },
        })
            .done(function (price) {
                $('#price').val(price);
            })
            .fail(function () {
                console.log("error");
            });
    }
});

$('#save_abono_lote').on('click', function (e) {
    $.ajax({
        url: site.base_url + 'abonos/saveAbonoLote',
        type: 'POST',
        dataType: 'json',
        data: $frmCreate.serialize()
    })
        .done(function (data) {
            addAlert(data.message, data.type);
            getPassengers();
        })
        .fail(function (data) {
            console.log("error");
        });
});

$(document).on('ifChecked', '.checkbox', function (e) {
    if (e && e.preventDefault) {
        e.preventDefault();
    }
    var element = $(this).parent().parent().parent();
    element.find('select').attr('disabled', false);
    element.find('input[type="number"]').attr('disabled', false);
    element.find('input[type="text"]').attr('disabled', false);
});
$(document).on('ifUnchecked', '.checkbox', function (e) {
    if (e && e.preventDefault) {
        e.preventDefault();
    }
    var element = $(this).parent().parent().parent();
    element.find('select').attr('disabled', true);
    element.find('input[type="number"]').attr('disabled', true);
    element.find('input[type="text"]').attr('disabled', true);
});
$(document).on('click', '.po-delete-abono', function (e) {
    e.preventDefault();
    $('.po').popover('hide');
    var link = $(this).attr('href');
    var s = $(this).attr('id');
    var sp = s.split('__');
    $.ajax({
        type: 'get',
        url: link,
        dataType: 'json',
        success: function (data) {
            if (data.error == 1) {
                addAlert(data.msg, 'danger');
            } else {
                addAlert(data.msg, 'success');
                if (oTable != '') {
                    oTable.fnDraw();
                }
            }
        },
        error: function (data) {
            addAlert('Ajax call failed', 'danger');
        },
    });
    return false;
});
$(document).on("change", "#school_idd", function (e) {
    if (e && e.preventDefault) {
        e.preventDefault();
    }
    let school_id = $('#school_id').val(),
        type = $('#type').val(),
        number_abono_start = $('#number_abono_start').val(),
        line_id = $('#line_id').val();
    if (school_id == 1) {
        $.ajax({
            type: "get", async: false,
            url: site.base_url + 'abonos/ajaxGetPassengersBySchool',
            dataType: 'html',
            data: { school_id: school_id, type: type, line_id: line_id, number_abono_start: number_abono_start },
        })
            .done(function (data) {
                $('#grid').html(data);
                $('#save').removeClass('disabled');
                $('#print').removeClass('disabled');
            });
    }
}).on('click', '.add-row', function (e) {
    number_abono_start = $('#number_abono_start').val(),
        route = $('#route').val();
    type = $('#type').val();
    length = $('#PassTable tbody tr').length;

    $.ajax({
        type: "get", async: false,
        url: site.base_url + 'abonos/ajaxAddRowTeacher',
        dataType: 'html',
        data: { route: route, type: type, number_abono_start: number_abono_start, length: length }
    })
        .done(function (data) {
            $('#PassTable').append(data);
        });
}).on('click', '.del-row', function (e) {
    var el = $(this).parent().parent().remove();
    if ($('#StudentsTable tbody').length < 1) {
        $('.save-abono').hide();
    }
}).on('click', '.add-tramo', function (e) {
    $.ajax({
        url: site.base_url + 'abonos/saveAssignTramo',
        type: 'POST',
        dataType: 'json',
        data: $('#frmTramo').serialize()
    })
        .done(function (data) {
            $('#message').show();
            $('#message').addClass(data.alert);
            $('#message').html(data.message);
            if (data.alert == 'success') {
                setTimeout('', 9000);
                $('#myModal').modal('hide');
                getPassengers();
            }
        });
}).on('click', '#save-teacher', function (e) {
    $.ajax({
        url: site.base_url + 'abonos/saveTeacher',
        type: 'POST',
        dataType: 'json',
        data: $('#frmCreateTeacher').serialize(),
    })
        .done(function (data) {
            getPassengers();
            addAlert(data.message, data.type);
            $('#myModal').modal('hide');
        });
}).on('click', '#save-student', function (e) {
    $.ajax({
        url: site.base_url + 'abonos/saveStudent',
        type: 'POST',
        dataType: 'json',
        data: $('#frmCreateStudent').serialize(),
    })
        .done(function (data) {
            addAlertModal(data.message, data.type);
        });
}).on('blur', '#mdni', function (e) {
    $.ajax({
        url: site.base_url + 'abonos/getPassengerByDni',
        type: 'GET',
        dataType: 'json',
        data: { dni: $(this).val() },
    })
        .done(function (p) {
            $('#mlast_name').val(p.last_name);
            $('#mfirst_name').val(p.first_name);
            $('#mpassenger_id').val(p.id);
        });
}).on('click', '.search-student', function (e) {
    let dni = $('#dnis').val();
    if (dni == '') {
        $('.no-student').html('Ingrese un valor en el campo');
        return false;
    } else {
        $('.no-student').html('<p></p>');
    }

    if (dni != '') {
        $.ajax({
            url: site.base_url + '/abonos/searchStudentByDni',
            type: 'GET',
            dataType: 'html',
            data: { dni: dni },
        })
            .done(function (st) {
                if (st) {
                    $('#StudentsTable tbody').append(st);
                } else {
                    $('.no-student').html('No existe alumno con el DNI buscado.');
                }
                if ($('#StudentsTable tbody').length > 0) {
                    $('.save-abono').show();
                }
            })
            .fail(function () {

            });
    }
}).on('change', '#type', function (e) {
    if ($(this).val() == 2) {
        $('#school_id').val('');
    }
}).on('change', '.from', function (e) {
    let str = $(this).attr('id').split('_');
    let to = $('#to_' + str[1]).val();
    let from = $('#from_' + str[1]).val();
    let line = $('#line_' + str[1]);
    $.ajax({
        url: site.base_url + 'abonos/getLines',
        type: 'GET',
        dataType: 'html',
        data: { from: from, to: to }
    })
        .done(function (options) {
            line.html(options);
        })
        .fail(function () {
            console.log("error");
        });
}).on('change', '.to', function (e) {
    let str = $(this).attr('id').split('_');
    let to = $('#to_' + str[1]).val();
    let from = $('#from_' + str[1]).val();
    let line = $('#line_' + str[1]);
    $.ajax({
        url: site.base_url + 'abonos/getLines',
        type: 'GET',
        dataType: 'html',
        data: { from: from, to: to }
    })
        .done(function (options) {
            line.html(options);
        })
        .fail(function () {
            console.log("error");
        });
}).on('change', '#passenger_id', function (e) {
    let id = $(this).val();
    if (id != '') {
        $.ajax({
            url: site.base_url + '/abonos/searchStudentById',
            type: 'GET',
            dataType: 'html',
            data: { id: id },
        })
            .done(function (st) {
                if (st) {
                    $('#StudentsTable tbody').append(st);
                } else {
                    $('.no-student').html('No existe alumno con el DNI buscado.');
                }
                if ($('#StudentsTable tbody').length > 0) {
                    $('.save-abono').show();
                }
            })
            .fail(function () {

            });
    }
});