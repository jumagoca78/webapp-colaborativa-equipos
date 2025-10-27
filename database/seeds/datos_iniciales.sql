-- Datos de semilla para desarrollo
-- Expediente Clínico Integral

USE expediente_clinico;

-- Insertar usuario administrador por defecto
-- Password: admin123 (debe cambiarse en producción)
INSERT INTO usuarios (username, password_hash, email, rol, nombre_completo) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@clinica.com', 'admin', 'Administrador del Sistema'),
('dr.garcia', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'garcia@clinica.com', 'medico', 'Dr. Juan García López'),
('lic.martinez', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'martinez@clinica.com', 'terapeuta', 'Lic. María Martínez Ruiz'),
('recepcion', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'recepcion@clinica.com', 'recepcionista', 'Ana Torres Mendoza');

-- Pacientes de ejemplo
INSERT INTO pacientes (numero_expediente, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, genero, telefono, email, direccion, contacto_emergencia, telefono_emergencia) VALUES
('EXP-2024-001', 'Carlos', 'Hernández', 'Sánchez', '2015-05-15', 'M', '555-1234', 'hernandez@email.com', 'Av. Principal 123, Ciudad', 'Laura Hernández', '555-5678'),
('EXP-2024-002', 'Sofía', 'Ramírez', 'González', '2018-08-22', 'F', '555-2345', 'ramirez@email.com', 'Calle Secundaria 456, Ciudad', 'Pedro Ramírez', '555-6789'),
('EXP-2024-003', 'Diego', 'López', 'Morales', '2016-03-10', 'M', '555-3456', 'lopez@email.com', 'Av. Reforma 789, Ciudad', 'Carmen López', '555-7890');

-- Expedientes generales
INSERT INTO expediente_general (paciente_id, tipo_sangre, alergias, enfermedades_cronicas, medicamentos_actuales, antecedentes_familiares) VALUES
(1, 'O+', 'Ninguna conocida', 'Ninguna', 'Ninguno', 'Sin antecedentes relevantes'),
(2, 'A+', 'Penicilina', 'Ninguna', 'Ninguno', 'Diabetes en abuelo paterno'),
(3, 'B+', 'Ninguna conocida', 'Ninguna', 'Ninguno', 'Sin antecedentes relevantes');

-- Evaluaciones de neurodiversidad de ejemplo
INSERT INTO evaluacion_neurodiversidad (paciente_id, usuario_id, tipo_evaluacion, fecha_evaluacion, resultados, diagnostico, recomendaciones) VALUES
(1, 2, 'TEA', '2024-01-15', 'Evaluación inicial muestra características del espectro autista nivel 1', 'TEA nivel 1', 'Terapia conductual, seguimiento trimestral'),
(2, 2, 'TDAH', '2024-02-20', 'Dificultades de atención sostenida y control de impulsos', 'TDAH combinado', 'Terapia ocupacional, revisión semestral');

-- Citas programadas
INSERT INTO citas (paciente_id, usuario_id, fecha_hora, tipo_cita, estado, motivo) VALUES
(1, 2, '2024-11-15 10:00:00', 'Seguimiento', 'Programada', 'Evaluación de progreso'),
(2, 3, '2024-11-16 14:00:00', 'Terapia', 'Programada', 'Sesión de terapia ocupacional'),
(3, 2, '2024-11-17 09:00:00', 'Primera vez', 'Programada', 'Evaluación inicial');

-- Sesiones de terapia
INSERT INTO terapias (paciente_id, terapeuta_id, tipo_terapia, fecha_sesion, duracion_minutos, objetivos, actividades, progreso) VALUES
(1, 3, 'Conductual', '2024-10-15', 60, 'Mejorar interacción social', 'Juegos de rol, actividades grupales', 'Progreso satisfactorio'),
(2, 3, 'Ocupacional', '2024-10-20', 45, 'Desarrollar atención sostenida', 'Ejercicios de concentración', 'Mejora gradual');
