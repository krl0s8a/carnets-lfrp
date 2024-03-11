<?php Defined('BASEPATH') || exit('No direct script access allowed');

$lang['management_routes'] = 'Gestión de recorridos';
$lang['new_route'] = 'Nuevo Recorrido';
$lang['create_route'] = 'Agregar nuevo recorrido';
$lang['routes'] = 'Recorridos';
$lang['list_routes'] = 'Listado de recorridos';
$lang['edit_route'] = 'Editar recorrido';
$lang['locations'] = 'Paradas del recorrido';
$lang['location'] = 'Ubicación';
$lang['back_list'] = 'Volver al listado de recorridos';
$lang['route'] = 'recorrido';
// Fields
$lang['lbl_name'] = 'Nombre recorrido';
$lang['lbl_from_city'] = 'Desde';
$lang['lbl_to_city'] = 'Hasta';
$lang['lbl_location'] = 'Ubicación';
$lang['lbl_line'] = 'Linea';
$lang['lbl_direction'] = 'Sentido';
$lang['lbl_length'] = 'Longitud (Km)';
$lang['lbl_ida'] = 'Ida';
$lang['lbl_vta'] = 'Vuelta';

//Info
$lang['info_routes'] = 'Los recorridos describen la ubicación de inicio (salida) y final (llegada) de un servicio y todas las paradas intermedias.';
$lang['info_edit'] = 'Haga los cambios que desee en el siguiente formulario y haga clic en el botón Guardar para actualizar la información del recorrido. Puede agregar / eliminar ubicaciones hacia / desde el recorrido.';
$lang['info_create'] = 'El recorido representa el inicio (salida) y la ubicación final (llegada) de un servicio y todas las paradas intermedias. Para crear un recorrido, asígnele un título y agregue todas las ubicaciones (paradas) que tiene, comenzando con su ubicación de inicio / salida (Ubicación 1) y agregando tantas ubicaciones como necesite con el botón "Agregar +". La última ubicación que cree será la ubicación final (llegada).';
$lang['info_field_length'] = 'La distancia de la localidad <b>n</b> es la distancia entre la localidad <b>(n-1)</b> y <b>n</b>.';
// Options
$lang['op_create_route'] = 'Agregar nuevo recorrido';
$lang['op_delete_route'] = 'Eliminar recorrido';

// Messages
$lang['route_create_success'] = 'El recorrido fue agregado correctamente';
$lang['route_create_failure'] = 'Hubo un error al agregar el recorrido';
$lang['route_edit_success'] = 'El recorrido fue actualizado correctamente';
$lang['route_deleted_success'] = 'Recorridos seleccionados eliminados correctamente.';

// Activity
$lang['activity_update_route'] = 'recorrido actualizado con id';
$lang['activity_create_route'] = 'recorrido creado con id';
$lang['activity_delete_route'] = 'recorrido/s eliminado/s ';

$lang['title_new_route'] = 'Crear nuevo recorrido';
$lang['title_edit_route'] = 'Editar recorrido';
