<?php
/**
 * API del Módulo de Terapias
 * Equipo 5 - Gestión de Sesiones de Terapia
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

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'list':
            $query = "SELECT t.*, p.nombre, p.apellido_paterno, u.nombre_completo as terapeuta 
                      FROM terapias t 
                      INNER JOIN pacientes p ON t.paciente_id = p.id 
                      INNER JOIN usuarios u ON t.terapeuta_id = u.id 
                      ORDER BY t.fecha_sesion DESC";
            $stmt = $db->prepare($query);
            $stmt->execute();
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            break;

        case 'by_patient':
            $paciente_id = $_GET['paciente_id'] ?? 0;
            $query = "SELECT t.*, u.nombre_completo as terapeuta 
                      FROM terapias t 
                      INNER JOIN usuarios u ON t.terapeuta_id = u.id 
                      WHERE t.paciente_id = :paciente_id 
                      ORDER BY t.fecha_sesion DESC";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':paciente_id', $paciente_id);
            $stmt->execute();
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            break;

        case 'create':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                
                $query = "INSERT INTO terapias 
                          (paciente_id, terapeuta_id, tipo_terapia, fecha_sesion, 
                           duracion_minutos, objetivos, actividades, progreso, proxima_sesion) 
                          VALUES (:pac_id, :ter_id, :tipo, :fecha, :duracion, 
                                  :objetivos, :actividades, :progreso, :proxima)";
                $stmt = $db->prepare($query);
                $stmt->execute([
                    ':pac_id' => $data['paciente_id'],
                    ':ter_id' => $_SESSION['user_id'],
                    ':tipo' => $data['tipo_terapia'],
                    ':fecha' => $data['fecha_sesion'],
                    ':duracion' => $data['duracion_minutos'] ?? null,
                    ':objetivos' => $data['objetivos'] ?? null,
                    ':actividades' => $data['actividades'] ?? null,
                    ':progreso' => $data['progreso'] ?? null,
                    ':proxima' => $data['proxima_sesion'] ?? null
                ]);
                
                echo json_encode(['success' => true, 'id' => $db->lastInsertId()]);
            }
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Acción no válida']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
