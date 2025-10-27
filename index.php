<?php
/**
 * Expediente Clínico Integral
 * Sistema de Gestión de Expedientes Médicos
 * Proyecto Colaborativo - 6 Equipos
 */

session_start();

// Configuración de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir configuración de base de datos
require_once 'backend/config/database.php';

// Verificar si el usuario está autenticado
$is_authenticated = isset($_SESSION['user_id']);

// Obtener página solicitada
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Si no está autenticado y no está en login, redirigir
if (!$is_authenticated && $page !== 'login') {
    $page = 'login';
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente Clínico Integral</title>
    <link rel="stylesheet" href="frontend/css/styles.css">
    <link rel="stylesheet" href="frontend/css/dashboard.css">
</head>
<body>
    <div class="container">
        <?php if ($is_authenticated): ?>
            <!-- Header -->
            <header class="header">
                <div class="header-content">
                    <h1>Expediente Clínico Integral</h1>
                    <div class="user-info">
                        <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_completo'] ?? 'Usuario'); ?></span>
                        <a href="backend/auth/logout.php" class="btn btn-secondary">Cerrar Sesión</a>
                    </div>
                </div>
            </header>

            <!-- Navigation -->
            <nav class="navigation">
                <ul>
                    <li><a href="?page=dashboard" class="<?php echo $page === 'dashboard' ? 'active' : ''; ?>">Dashboard</a></li>
                    <li><a href="?page=expediente" class="<?php echo $page === 'expediente' ? 'active' : ''; ?>">Expedientes</a></li>
                    <li><a href="?page=neurodiversidad" class="<?php echo $page === 'neurodiversidad' ? 'active' : ''; ?>">Neurodiversidad</a></li>
                    <li><a href="?page=citas" class="<?php echo $page === 'citas' ? 'active' : ''; ?>">Citas</a></li>
                    <li><a href="?page=terapias" class="<?php echo $page === 'terapias' ? 'active' : ''; ?>">Terapias</a></li>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <li><a href="?page=usuarios" class="<?php echo $page === 'usuarios' ? 'active' : ''; ?>">Usuarios</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="main-content">
                <?php
                // Cargar contenido según la página
                switch ($page) {
                    case 'dashboard':
                        include 'frontend/templates/dashboard/index.php';
                        break;
                    case 'expediente':
                        include 'frontend/templates/expediente/index.php';
                        break;
                    case 'neurodiversidad':
                        include 'frontend/templates/neurodiversidad/index.php';
                        break;
                    case 'citas':
                        include 'frontend/templates/citas/index.php';
                        break;
                    case 'terapias':
                        include 'frontend/templates/terapias/index.php';
                        break;
                    case 'usuarios':
                        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
                            include 'frontend/templates/auth/usuarios.php';
                        } else {
                            echo '<p>No tiene permisos para acceder a esta sección.</p>';
                        }
                        break;
                    default:
                        echo '<p>Página no encontrada.</p>';
                }
                ?>
            </main>
        <?php else: ?>
            <!-- Login page -->
            <?php include 'frontend/templates/auth/login.php'; ?>
        <?php endif; ?>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 Expediente Clínico Integral - Sistema Colaborativo</p>
        </footer>
    </div>

    <script src="frontend/js/main.js"></script>
</body>
</html>
