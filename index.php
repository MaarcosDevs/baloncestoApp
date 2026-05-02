<?php
require_once "autoload.php";
session_start();

$gestor = new GestorPDO();
$controller = new EquipoController($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_login'])) {
    $emailRecuperado = base64_decode($_COOKIE['usuario_login']);
    $usuario = $gestor->buscarUsuarioPorEmail($emailRecuperado);
    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['usuarioEmail'] = $usuario->getEmail();
    } else {
        setcookie('usuario_login', '', time() - 3600, '/');
    }
}

$temasPermitidos = ['default', 'dark', 'forest', 'ocean'];

if (isset($_GET['tema']) && in_array($_GET['tema'], $temasPermitidos)) {
    setcookie('tema_color', $_GET['tema'], [
        'expires' => time() + (86400 * 365),
        'path' => '/',
        'httponly' => false,
        'samesite' => 'Strict'
    ]);
    header("Location: index.php");
    exit;
}

$temaActual = (isset($_COOKIE['tema_color']) && in_array($_COOKIE['tema_color'], $temasPermitidos))
    ? $_COOKIE['tema_color']
    : 'default';
$GLOBALS['temaActual'] = $temaActual;

switch ($accion) {
    case 'login':
        $usuarioController->login();
        break;
    case 'alta':
        $usuarioController->alta();
        break;
    case 'logout':
        $usuarioController->logout();
        break;
    case 'crear':
    case 'editar':
    case 'eliminar':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?accion=login');
            exit;
        }
        if ($accion === 'crear') $controller->crear();
        if ($accion === 'editar') $controller->editar();
        if ($accion === 'eliminar') $controller->eliminar();
        break;
    default:
        $controller->index();
}
