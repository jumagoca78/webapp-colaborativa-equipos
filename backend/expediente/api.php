<?php
/**
 * API del Módulo de Expediente General
 * Equipo 2 - Gestión de Expedientes Médicos
 */

header('Content-Type: application/json');
session_start();

require_once '../config/database.php';

// Verificar autenticación
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autenticado']);
    exit();
}

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'list':
            // Listar todos los pacientes
            $query = "SELECT p.*, e.tipo_sangre, e.alergias 
                      FROM pacientes p 
                      LEFT JOIN expediente_general e ON p.id = e.paciente_id 
                      ORDER BY p.fecha_registro DESC";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($pacientes);
            break;

        case 'get':
            // Obtener un paciente específico
            $id = $_GET['id'] ?? 0;
            $query = "SELECT p.*, e.* 
                      FROM pacientes p 
                      LEFT JOIN expediente_general e ON p.id = e.paciente_id 
                      WHERE p.id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($paciente);
            break;

        case 'create':
            // Crear nuevo paciente
            if ($method === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                
                $db->beginTransaction();
                
                // Insertar paciente
                $query = "INSERT INTO pacientes (numero_expediente, nombre, apellido_paterno, apellido_materno, 
                          fecha_nacimiento, genero, telefono, email, direccion, contacto_emergencia, telefono_emergencia) 
                          VALUES (:num_exp, :nombre, :ap_pat, :ap_mat, :fecha_nac, :genero, :tel, :email, 
                          :dir, :cont_emer, :tel_emer)";
                $stmt = $db->prepare($query);
                $stmt->execute([
                    ':num_exp' => $data['numero_expediente'],
                    ':nombre' => $data['nombre'],
                    ':ap_pat' => $data['apellido_paterno'],
                    ':ap_mat' => $data['apellido_materno'] ?? null,
                    ':fecha_nac' => $data['fecha_nacimiento'],
                    ':genero' => $data['genero'],
                    ':tel' => $data['telefono'] ?? null,
                    ':email' => $data['email'] ?? null,
                    ':dir' => $data['direccion'] ?? null,
                    ':cont_emer' => $data['contacto_emergencia'] ?? null,
                    ':tel_emer' => $data['telefono_emergencia'] ?? null
                ]);
                
                $paciente_id = $db->lastInsertId();
                
                // Crear expediente general
                $query = "INSERT INTO expediente_general (paciente_id) VALUES (:paciente_id)";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':paciente_id', $paciente_id);
                $stmt->execute();
                
                $db->commit();
                
                echo json_encode(['success' => true, 'id' => $paciente_id]);
            }
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Acción no válida']);
    }
} catch (PDOException $e) {
    if ($db->inTransaction()) {
        $db->rollBack();
    }
    http_response_code(500);
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>
