<?php
/**
 * Módulo de Autenticación - Cerrar Sesión
 * Equipo 1
 */

session_start();

// Registrar cierre de sesión si hay sesión activa
if (isset($_SESSION['user_id'])) {
    require_once '../config/database.php';
    
    try {
        $database = new Database();
        $db = $database->getConnection();

        $log_query = "INSERT INTO logs_actividad (usuario_id, accion, modulo, descripcion, ip_address) 
                     VALUES (:user_id, 'logout', 'autenticacion', 'Cierre de sesión', :ip)";
        $log_stmt = $db->prepare($log_query);
        $log_stmt->bindParam(':user_id', $_SESSION['user_id']);
        $log_stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
        $log_stmt->execute();
    } catch (PDOException $e) {
        // Continuar con el cierre de sesión aunque falle el log
    }
}

// Destruir sesión
session_unset();
session_destroy();

header('Location: ../../index.php?page=login');
exit();
?>
