<?php
/**
 * API del Módulo Dashboard
 * Equipo 6 - Dashboard y Estadísticas
 */

header('Content-Type: application/json');
session_start();

require_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autenticado']);
    exit();
}

$database = new Database();
$db = $database->getConnection();

try {
    // Obtener estadísticas generales
    $stats = [];

    // Total de pacientes
    $query = "SELECT COUNT(*) as total FROM pacientes";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['total_pacientes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Citas de hoy
    $query = "SELECT COUNT(*) as total FROM citas WHERE DATE(fecha_hora) = CURDATE()";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['citas_hoy'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Citas pendientes
    $query = "SELECT COUNT(*) as total FROM citas WHERE estado = 'Programada' AND fecha_hora >= NOW()";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['citas_pendientes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Evaluaciones del mes
    $query = "SELECT COUNT(*) as total FROM evaluacion_neurodiversidad 
              WHERE MONTH(fecha_evaluacion) = MONTH(CURDATE()) 
              AND YEAR(fecha_evaluacion) = YEAR(CURDATE())";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['evaluaciones_mes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Terapias del mes
    $query = "SELECT COUNT(*) as total FROM terapias 
              WHERE MONTH(fecha_sesion) = MONTH(CURDATE()) 
              AND YEAR(fecha_sesion) = YEAR(CURDATE())";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['terapias_mes'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Próximas citas (5)
    $query = "SELECT c.*, p.nombre, p.apellido_paterno 
              FROM citas c 
              INNER JOIN pacientes p ON c.paciente_id = p.id 
              WHERE c.fecha_hora >= NOW() AND c.estado = 'Programada' 
              ORDER BY c.fecha_hora ASC 
              LIMIT 5";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['proximas_citas'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Distribución de tipos de neurodiversidad
    $query = "SELECT tipo_evaluacion, COUNT(*) as cantidad 
              FROM evaluacion_neurodiversidad 
              GROUP BY tipo_evaluacion";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stats['distribucion_neurodiversidad'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($stats);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
