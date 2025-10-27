<?php
/**
 * Módulo de Autenticación
 * Equipo 1 - Sistema de Login y Gestión de Usuarios
 */

session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header('Location: ../../index.php?page=login&error=campos_vacios');
        exit();
    }

    try {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT id, username, password_hash, email, rol, nombre_completo, activo 
                  FROM usuarios WHERE username = :username AND activo = 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar password
            if (password_verify($password, $user['password_hash'])) {
                // Crear sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['nombre_completo'] = $user['nombre_completo'];

                // Registrar inicio de sesión
                $log_query = "INSERT INTO logs_actividad (usuario_id, accion, modulo, descripcion, ip_address) 
                             VALUES (:user_id, 'login', 'autenticacion', 'Inicio de sesión exitoso', :ip)";
                $log_stmt = $db->prepare($log_query);
                $log_stmt->bindParam(':user_id', $user['id']);
                $log_stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
                $log_stmt->execute();

                header('Location: ../../index.php?page=dashboard');
                exit();
            }
        }

        header('Location: ../../index.php?page=login&error=credenciales_invalidas');
        exit();

    } catch (PDOException $e) {
        header('Location: ../../index.php?page=login&error=error_servidor');
        exit();
    }
} else {
    header('Location: ../../index.php');
    exit();
}
?>
