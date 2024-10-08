<?php

defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2018, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT
 * @link      http://cibonfire.com
 * @since     Version 1.0
 */
/**
 * Roles language file (Spanish (Latin American))
 *
 * Localization strings used by Bonfire
 *
 * @package Bonfire\Modules\Roles\Language\Spanish (Latin American)
 * @link    http://cibonfire.com/docs/bonfire/roles_and_permissions
 */
$lang['role_intro'] = 'Los roles le permiten definir las capacidades que puede tener un usuario.';
$lang['role_manage'] = 'Gestionar los roles de usuario';
$lang['role_no_roles'] = 'No hay ningún rol en el sistema.';
$lang['role_create_button'] = 'Crear un nuevo rol.';
$lang['role_create_note'] = 'Cada ususario requiere un rol. Asegurate de tener todo lo necesario.';
$lang['role_account_type'] = 'Tipo de cuenta';
$lang['role_description'] = 'Descripción';
$lang['role_details'] = 'Detalles del rol';
$lang['role_create'] = 'Crear un nuevo rol';

$lang['role_name'] = 'Nombre del rol';
$lang['role_max_desc_length'] = 'Max. 255 carácteres.';
$lang['role_default_role'] = 'Rol por defecto';
$lang['role_default_note'] = 'Este rol debe ser asignado a todos los usuarios nuevos.';
$lang['role_permissions'] = 'Permisos';
$lang['role_permissions_check_note'] = 'Revise todos los permisos que se aplican a este rol.';
$lang['role_save_role'] = 'Guardar el rol';
$lang['role_delete_role'] = 'Eliminar este rol';
$lang['role_delete_confirm'] = '¿Esta seguro de eliminar este rol?';
$lang['role_delete_note'] = 'Eliminar este rol convertirá a todos los usuarios que lo tengan asignado a el rol por defecto del sitio web.';
$lang['role_can_delete_role'] = 'Borrable';
$lang['role_can_delete_note'] = '¿Puede este rol ser eliminado?';

$lang['role_roles'] = 'Roles';
$lang['role_new_role'] = 'Nuevo Rol';
$lang['role_new_permission_message'] = 'Podrá modificar los permisos una vez el rol halla sido creado.';
$lang['role_not_used'] = 'No se usa';

$lang['role_login_destination'] = 'Destino del inicio de sesión';
$lang['role_destination_note'] = 'La URL del sitio para redirigir los inicios de sesión exitosos.';
$lang['role_default_context'] = 'Contexto por defecto Admin';
$lang['role_default_context_note'] = 'Se cargará el contexto admin cuando no se especifique uno (I.E. http://yoursite.com/admin/)';


$lang['role_create_success'] = 'El rol fue creado exitosamente.';
$lang['role_create_error'] = 'Hubo un problema al crear el rol: ';
$lang['role_delete_success'] = 'El rol fue eliminado exitosamente.';
$lang['role_delete_error'] = 'El rol no se pudo eliminar: ';
$lang['role_edit_success'] = 'El rol fue guardado correctamente.';
$lang['role_edit_error'] = 'Hubo un problema al guardar el rol: ';
$lang['role_invalid_id'] = 'ID de rol no válido.';


$lang['matrix_header'] = 'Matriz de permisos';
$lang['matrix_permission'] = 'Permisos';
$lang['matrix_role'] = 'Rol';
$lang['matrix_note'] = 'Edición de autorización inmediata. Activa la casilla de verificación para agregar o quitar ese permiso para este rol.';
$lang['matrix_insert_success'] = 'Permisos agregados al rol.';
$lang['matrix_insert_fail'] = 'Hubo un problema al agregar los permisos al rol: ';
$lang['matrix_delete_success'] = 'Los permisos fueron revocados para el rol.';
$lang['matrix_delete_fail'] = 'Hubo un problema al eliminar el permiso para el rol: ';
$lang['matrix_auth_fail'] = 'Autorización: No tienes el permiso para gestionar el control de acceso para este rol.';

$lang['form_validation_role_name'] = 'Nombre del rol';
$lang['form_validation_role_login_destination'] = 'Destino del inicio de sesión';
$lang['form_validation_role_default_context'] = 'Contexto por defecto Admin';
$lang['form_validation_role_default_role'] = 'Rol por defecto';
$lang['form_validation_role_can_delete_role'] = 'Borrable';

$lang['role_list'] = 'Listado de roles';
$lang['role_create'] = 'Agregar nuevo rol';
$lang['role_edit'] = 'Editar rol';