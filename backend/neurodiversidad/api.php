<?php
/**
 * API del Módulo de Neurodiversidad
 * Equipo 3 - Evaluaciones de Neurodiversidad
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
            $query = "SELECT e.*, p.nombre, p.apellido_paterno, u.nombre_completo as evaluador 
                      FROM evaluacion_neurodiversidad e 
                      INNER JOIN pacientes p ON e.paciente_id = p.id 
                      INNER JOIN usuarios u ON e.usuario_id = u.id 
                      ORDER BY e.fecha_evaluacion DESC";
            $stmt = $db->prepare($query);
            $stmt->execute();
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
            break;

        case 'get':
            $id = $_GET['id'] ?? 0;
            $query = "SELECT e.*, p.nombre, p.apellido_paterno, p.apellido_materno 
                      FROM evaluacion_neurodiversidad e 
                      INNER JOIN pacientes p ON e.paciente_id = p.id 
                      WHERE e.id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
            break;

        case 'create':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                
                $query = "INSERT INTO evaluacion_neurodiversidad 
                          (paciente_id, usuario_id, tipo_evaluacion, fecha_evaluacion, 
                           resultados, diagnostico, recomendaciones) 
                          VALUES (:pac_id, :user_id, :tipo, :fecha, :result, :diag, :recom)";
                $stmt = $db->prepare($query);
                $stmt->execute([
                    ':pac_id' => $data['paciente_id'],
                    ':user_id' => $_SESSION['user_id'],
                    ':tipo' => $data['tipo_evaluacion'],
                    ':fecha' => $data['fecha_evaluacion'],
                    ':result' => $data['resultados'] ?? null,
                    ':diag' => $data['diagnostico'] ?? null,
                    ':recom' => $data['recomendaciones'] ?? null
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
