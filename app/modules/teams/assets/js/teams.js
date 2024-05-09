function linkEdit(x) {
    var y = x.split('__');
    return '<a href="' + site.base_url + 'teams/edit/' + y[1] + '">' + y[0] + '</a>';
}
oTable = $('#team_table').dataTable({
    "aaSorting": [[1, "asc"], [2, "asc"]],
    "aLengthMenu": [[10, 15, 25, 50, 100], [10, 15, 25, 50, 100]],
    "iDisplayLength": oLengthMenu,
    'bProcessing': true, 'bServerSide': true,
    'sAjaxSource': 'teams/get_teams',
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
    },  {"mRender" : linkEdit}, null, null, null, { "bSortable": false }]
});

var $player = $('#posplayer');
$player.change(function (e) {
    localStorage.setItem('posplayer', $(this).val());
    $('#player_id').val($(this).val());
});
if ((posplayer = localStorage.getItem('posplayer'))) {
    $player.val(posplayer).select2({
        minimumInputLength: 1,
        data: [],
        initSelection: function (element, callback) {
            $.ajax({
                type: 'get',
                async: false,
                url: site.base_url + 'players/getPlayer/' + $(element).val(),
                dataType: 'json',
                success: function (data) {
                    callback(data[0]);
                },
            });
        },
        ajax: {
            url: site.base_url + 'players/suggestions',
            dataType: 'json',
            quietMillis: 15,
            data: function (term, page) {
                return {
                    term: term,
                    limit: 15,
                };
            },
            results: function (data, page) {
                if (data.results != null) {
                    return { results: data.results };
                } else {
                    return { results: [{ id: '', text: 'No Match Found' }] };
                }
            },
        },
    });
} else {
    nsSupplier();
}

$(document).on('click', '.po-delete-avatar', function (e) {
    var row = $(this).closest('tr');
    e.preventDefault();
    $('.po').popover('hide');
    var link = $(this).attr('href');
    var return_id = $(this).attr('data-return-id');
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
}).on('change', '#season_id', function(e){
    e.preventDefault();
    var season_id = $(this).val();
    $.ajax({
        type: 'post',
        url: site.base_url + 'teams/players_by_team',
        dataType: 'html',
        data : $('#frm-team').serialize(),
        success: function (data) {
            $('#players').html(data);
            /*if (data.error == 1) {
                addAlert(data.msg, 'danger');
            } else {
                addAlert(data.msg, 'success');
                if (oTable != '') {
                    oTable.fnDraw();
                }
            }*/
        },
        error: function (data) {
            addAlert('Ajax call failed', 'danger');
        },
    });
}).on('click', '#btn-add-player', function(e){
    e.preventDefault();
    $.ajax({
        type: 'post',
        url: site.base_url + 'teams/add_player_in_team',
        dataType: 'html',
        data : $('#frm-team').serialize(),
        success: function (data) {
            $('#players').html(data);
            /*if (data.error == 1) {
                addAlert(data.msg, 'danger');
            } else {
                addAlert(data.msg, 'success');
                if (oTable != '') {
                    oTable.fnDraw();
                }
            }*/
        },
        error: function (data) {
            addAlert('Fallo al agregar el jugador', 'danger');
        },
    });
}).on('click', '.delete-player-team', function(e){
    e.preventDefault();
    var id = $(this).attr('id');    
    $.ajax({
        type: 'post',
        url: site.base_url + 'teams/delete_player_of_team',
        dataType: 'html',
        data : {id:id},
        success: function (data) {
            $('#players').html(data);
            /*if (data.error == 1) {
                addAlert(data.msg, 'danger');
            } else {
                addAlert(data.msg, 'success');
                if (oTable != '') {
                    oTable.fnDraw();
                }
            }*/
        },
        error: function (data) {
            addAlert('Ajax call failed', 'danger');
        },
    });
}).on('click', '#btn-edit-player-team', function(e){
    e.preventDefault();
    $.ajax({
        type: 'post',
        url: site.base_url + 'teams/save_edit_player_of_team',
        dataType: 'html',
        data : $('#frm-edit-player-team').serialize(),
        success: function (data) {
            $('#myModal').modal('hide');
            $('#players').html(data);
            /*if (data.error == 1) {
                addAlert(data.msg, 'danger');
            } else {
                addAlert(data.msg, 'success');
                if (oTable != '') {
                    oTable.fnDraw();
                }
            }*/
        },
        error: function (data) {
            addAlert('Fallo al agregar el jugador', 'danger');
        },
    });
}).on('click', '#view-player', function(e){
    e.preventDefault();
    var player_id = $('#posplayer').val(); 
    $.ajax({
        type: 'post',
        url: site.base_url + 'teams/view_player',
        dataType: 'html',
        data : {player_id:player_id},
        success: function (data) {
            $('#myModal').modal('hide');
            if (oTable != '') {
                oTable.fnDraw();
            }
        },
        error: function (data) {
            addAlert('Fallo al editar el jugador', 'danger');
        },
    });
});

function nsSupplier() {
    $('#posplayer').select2({
        minimumInputLength: 1,
        ajax: {
            url: site.base_url + 'players/suggestions',
            dataType: 'json',
            quietMillis: 15,
            data: function (term, page) {
                return {
                    term: term,
                    limit: 15,
                };
            },
            results: function (data, page) {
                if (data.results != null) {
                    return { results: data.results };
                } else {
                    return { results: [{ id: '', text: 'No Match Found' }] };
                }
            },
        },
    });
}