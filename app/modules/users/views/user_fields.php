<?php
/* /users/views/user_fields.php */

$currentMethod = $this->router->method;

//$errorClass     = empty($errorClass) ? ' error focused' : $errorClass;
$errorClass = ' error focused';
$controlClass = empty($controlClass) ? 'span4' : $controlClass;
$registerClass = $currentMethod == 'register' ? ' required' : '';
$editSettings = $currentMethod == 'edit';

$defaultLanguage = isset($user->language) ? $user->language : strtolower(settings_item('language'));
$defaultTimezone = isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));
$password_hints = 'Al menos 1 mayúscula, 1 minúscula, 1 número y más de 8 caracteres de longitud';
?>
<!--email-->








