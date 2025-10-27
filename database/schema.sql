-- Schema de Base de Datos para Expediente Clínico Integral
-- Creado para proyecto colaborativo de 6 equipos

CREATE DATABASE IF NOT EXISTS expediente_clinico CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE expediente_clinico;

-- Tabla de Usuarios (Módulo de Autenticación - Equipo 1)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    rol ENUM('admin', 'medico', 'terapeuta', 'recepcionista') NOT NULL,
    nombre_completo VARCHAR(150) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Pacientes (Módulo Expediente General - Equipo 2)
CREATE TABLE IF NOT EXISTS pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_expediente VARCHAR(20) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100),
    fecha_nacimiento DATE NOT NULL,
    genero ENUM('M', 'F', 'Otro') NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    direccion TEXT,
    contacto_emergencia VARCHAR(150),
    telefono_emergencia VARCHAR(20),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_expediente (numero_expediente),
    INDEX idx_nombre (nombre, apellido_paterno)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Expediente Médico General (Módulo Expediente General - Equipo 2)
CREATE TABLE IF NOT EXISTS expediente_general (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    tipo_sangre VARCHAR(10),
    alergias TEXT,
    enfermedades_cronicas TEXT,
    medicamentos_actuales TEXT,
    antecedentes_familiares TEXT,
    observaciones TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    INDEX idx_paciente (paciente_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Evaluación de Neurodiversidad (Módulo Neurodiversidad - Equipo 3)
CREATE TABLE IF NOT EXISTS evaluacion_neurodiversidad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    usuario_id INT NOT NULL,
    tipo_evaluacion ENUM('TEA', 'TDAH', 'Dislexia', 'Otro') NOT NULL,
    fecha_evaluacion DATE NOT NULL,
    resultados TEXT,
    diagnostico TEXT,
    recomendaciones TEXT,
    archivo_adjunto VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    INDEX idx_paciente (paciente_id),
    INDEX idx_tipo (tipo_evaluacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Citas (Módulo de Citas - Equipo 4)
CREATE TABLE IF NOT EXISTS citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    usuario_id INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    tipo_cita ENUM('Primera vez', 'Seguimiento', 'Evaluación', 'Terapia') NOT NULL,
    estado ENUM('Programada', 'Confirmada', 'Cancelada', 'Completada') DEFAULT 'Programada',
    motivo TEXT,
    notas TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    INDEX idx_paciente (paciente_id),
    INDEX idx_fecha (fecha_hora),
    INDEX idx_estado (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Terapias (Módulo de Terapias - Equipo 5)
CREATE TABLE IF NOT EXISTS terapias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id INT NOT NULL,
    terapeuta_id INT NOT NULL,
    tipo_terapia ENUM('Conductual', 'Lenguaje', 'Ocupacional', 'Psicomotriz', 'Otro') NOT NULL,
    fecha_sesion DATE NOT NULL,
    duracion_minutos INT,
    objetivos TEXT,
    actividades TEXT,
    progreso TEXT,
    proxima_sesion DATE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
    FOREIGN KEY (terapeuta_id) REFERENCES usuarios(id),
    INDEX idx_paciente (paciente_id),
    INDEX idx_terapeuta (terapeuta_id),
    INDEX idx_tipo (tipo_terapia)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Sesiones de Usuario
CREATE TABLE IF NOT EXISTS sesiones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    token VARCHAR(255) UNIQUE NOT NULL,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_expiracion TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    INDEX idx_token (token),
    INDEX idx_usuario (usuario_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Logs de Actividad
CREATE TABLE IF NOT EXISTS logs_actividad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    accion VARCHAR(100) NOT NULL,
    modulo VARCHAR(50) NOT NULL,
    descripcion TEXT,
    ip_address VARCHAR(45),
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    INDEX idx_usuario (usuario_id),
    INDEX idx_modulo (modulo),
    INDEX idx_fecha (fecha_hora)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
