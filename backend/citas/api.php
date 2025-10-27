<?php
/**
 * API del Módulo de Citas
 * Equipo 4 - Gestión de Citas Médicas
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
            $query = "SELECT c.*, p.nombre, p.apellido_paterno, u.nombre_completo as profesional 
                      FROM citas c 
                      INNER JOIN pacientes p ON c.paciente_id = p.id 
                      INNER JOIN usuarios u ON c.usuario_id = u.id 
                      ORDER BY c.fecha_hora DESC";
            $stmt = $db->prepare($query);
            $stmt->execute();
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            break;

        case 'today':
            $query = "SELECT c.*, p.nombre, p.apellido_paterno, u.nombre_completo as profesional 
                      FROM citas c 
                      INNER JOIN pacientes p ON c.paciente_id = p.id 
                      INNER JOIN usuarios u ON c.usuario_id = u.id 
                      WHERE DATE(c.fecha_hora) = CURDATE() 
                      ORDER BY c.fecha_hora ASC";
            $stmt = $db->prepare($query);
            $stmt->execute();
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            break;

        case 'create':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                
                $query = "INSERT INTO citas 
                          (paciente_id, usuario_id, fecha_hora, tipo_cita, motivo, estado) 
                          VALUES (:pac_id, :user_id, :fecha, :tipo, :motivo, :estado)";
                $stmt = $db->prepare($query);
                $stmt->execute([
                    ':pac_id' => $data['paciente_id'],
                    ':user_id' => $data['usuario_id'],
                    ':fecha' => $data['fecha_hora'],
                    ':tipo' => $data['tipo_cita'],
                    ':motivo' => $data['motivo'] ?? null,
                    ':estado' => $data['estado'] ?? 'Programada'
                ]);
                
                echo json_encode(['success' => true, 'id' => $db->lastInsertId()]);
            }
            break;

        case 'update_status':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                
                $query = "UPDATE citas SET estado = :estado WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->execute([
                    ':estado' => $data['estado'],
                    ':id' => $data['id']
                ]);
                
                echo json_encode(['success' => true]);
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
