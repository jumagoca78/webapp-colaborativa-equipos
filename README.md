# Expediente Clínico Integral

Sistema modular de gestión de expedientes clínicos desarrollado colaborativamente por 6 equipos especializados.

## 📋 Descripción del Proyecto

**Expediente Clínico Integral** es una aplicación web modular diseñada para la gestión integral de expedientes médicos, con enfoque especial en neurodiversidad. El sistema permite administrar pacientes, evaluaciones, citas, terapias y generar reportes estadísticos.

## 🏗️ Arquitectura del Proyecto

```
webapp-colaborativa-equipos/
├── frontend/                 # Capa de presentación
│   ├── css/                 # Estilos CSS
│   ├── js/                  # JavaScript del cliente
│   └── templates/           # Plantillas HTML por módulo
│       ├── auth/           # Login y autenticación
│       ├── dashboard/      # Panel principal
│       ├── expediente/     # Gestión de expedientes
│       ├── neurodiversidad/# Evaluaciones
│       ├── citas/          # Gestión de citas
│       └── terapias/       # Sesiones de terapia
├── backend/                  # Lógica de negocio
│   ├── config/             # Configuraciones
│   ├── auth/               # Autenticación
│   ├── expediente/         # API expedientes
│   ├── neurodiversidad/    # API evaluaciones
│   ├── citas/              # API citas
│   ├── terapias/           # API terapias
│   └── dashboard/          # API estadísticas
├── database/                 # Base de datos
│   ├── schema.sql          # Esquema de BD
│   ├── migrations/         # Migraciones
│   └── seeds/              # Datos iniciales
├── docs/                     # Documentación
├── tests/                    # Pruebas
│   ├── unit/               # Pruebas unitarias
│   └── integration/        # Pruebas de integración
├── index.php                 # Punto de entrada
└── README.md                # Este archivo
```

## 👥 Organización de Equipos

El desarrollo se realiza mediante **6 equipos especializados** trabajando en paralelo:

### Equipo 1: Autenticación y Seguridad
- **Responsabilidades:**
  - Sistema de login/logout
  - Gestión de usuarios y roles
  - Control de sesiones
  - Logs de actividad
- **Rama Git:** `feature/auth`
- **Módulos:** `backend/auth/`, `frontend/templates/auth/`

### Equipo 2: Expediente General
- **Responsabilidades:**
  - Registro de pacientes
  - Datos demográficos
  - Información médica general
  - Historial clínico
- **Rama Git:** `feature/expediente`
- **Módulos:** `backend/expediente/`, `frontend/templates/expediente/`

### Equipo 3: Neurodiversidad
- **Responsabilidades:**
  - Evaluaciones especializadas
  - Diagnósticos
  - Recomendaciones
  - Seguimiento de casos
- **Rama Git:** `feature/neurodiversidad`
- **Módulos:** `backend/neurodiversidad/`, `frontend/templates/neurodiversidad/`

### Equipo 4: Gestión de Citas
- **Responsabilidades:**
  - Programación de citas
  - Calendario de profesionales
  - Recordatorios
  - Estados de citas
- **Rama Git:** `feature/citas`
- **Módulos:** `backend/citas/`, `frontend/templates/citas/`

### Equipo 5: Terapias
- **Responsabilidades:**
  - Registro de sesiones
  - Planes de tratamiento
  - Seguimiento de progreso
  - Programación de terapias
- **Rama Git:** `feature/terapias`
- **Módulos:** `backend/terapias/`, `frontend/templates/terapias/`

### Equipo 6: Dashboard y Reportes
- **Responsabilidades:**
  - Panel de control
  - Estadísticas generales
  - Reportes y gráficas
  - Integración de módulos
- **Rama Git:** `feature/dashboard`
- **Módulos:** `backend/dashboard/`, `frontend/templates/dashboard/`

## 🔄 Estrategia de Branching Git

### Ramas Principales
- **`main`**: Código en producción
- **`develop`**: Rama de integración

### Ramas de Funcionalidad (por equipo)
- `feature/auth` - Equipo 1
- `feature/expediente` - Equipo 2
- `feature/neurodiversidad` - Equipo 3
- `feature/citas` - Equipo 4
- `feature/terapias` - Equipo 5
- `feature/dashboard` - Equipo 6

### Flujo de Trabajo

1. **Desarrollo Individual**
   ```bash
   git checkout -b feature/[modulo]
   # Realizar cambios
   git add .
   git commit -m "Descripción del cambio"
   git push origin feature/[modulo]
   ```

2. **Integración a Develop**
   ```bash
   # Crear Pull Request de feature/[modulo] → develop
   # Revisión de código por otro equipo
   # Merge después de aprobación
   ```

3. **Deploy a Producción**
   ```bash
   # Después de pruebas en develop
   # Crear Pull Request de develop → main
   # Deploy automático vía CI/CD
   ```

## 🚀 Configuración e Instalación

### Requisitos Previos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Git

### Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/jumagoca78/webapp-colaborativa-equipos.git
   cd webapp-colaborativa-equipos
   ```

2. **Configurar base de datos**
   ```bash
   # Crear la base de datos
   mysql -u root -p < database/schema.sql
   
   # Cargar datos iniciales (opcional)
   mysql -u root -p expediente_clinico < database/seeds/datos_iniciales.sql
   ```

3. **Configurar conexión a BD**
   - Editar `backend/config/database.php`
   - Ajustar credenciales según tu entorno

4. **Configurar servidor web**
   - Apuntar DocumentRoot a la carpeta del proyecto
   - Habilitar mod_rewrite (Apache)

5. **Acceder al sistema**
   ```
   http://localhost/webapp-colaborativa-equipos
   ```

### Credenciales de Prueba
- **Usuario:** admin
- **Contraseña:** admin123

## 🔐 Roles y Permisos

| Rol | Permisos |
|-----|----------|
| **admin** | Acceso total al sistema |
| **medico** | Expedientes, evaluaciones, citas |
| **terapeuta** | Terapias, seguimiento de pacientes |
| **recepcionista** | Citas, registro de pacientes |

## 🔧 Tecnologías Utilizadas

- **Frontend:**
  - HTML5
  - CSS3 (Custom styling)
  - JavaScript (Vanilla JS)

- **Backend:**
  - PHP 7.4+
  - PDO para acceso a datos
  - Session management

- **Base de Datos:**
  - MySQL 5.7+
  - InnoDB engine

## 🧪 Pruebas

### Ejecutar Pruebas Unitarias
```bash
# Por implementar
phpunit tests/unit
```

### Ejecutar Pruebas de Integración
```bash
# Por implementar
phpunit tests/integration
```

## 📊 Integración Continua (CI/CD)

El proyecto implementa CI/CD mediante GitHub Actions:

### Pipeline de Integración
1. **Code Quality Check**
   - Análisis de sintaxis PHP
   - Validación de estándares de código
   
2. **Tests Automáticos**
   - Pruebas unitarias
   - Pruebas de integración
   
3. **Build**
   - Validación de dependencias
   - Generación de artefactos

4. **Deploy Automático**
   - Deploy a staging desde `develop`
   - Deploy a producción desde `main`

### Configuración CI/CD
El archivo `.github/workflows/ci.yml` define el pipeline completo:
- Triggers en push a ramas `feature/*`, `develop`, `main`
- Tests automáticos en cada Pull Request
- Notificaciones de estado en Slack/Email

## 📝 Módulos del Sistema

### 1. Autenticación
- Login/Logout seguro
- Gestión de sesiones
- Control de acceso basado en roles

### 2. Expediente General
- Registro completo de pacientes
- Datos demográficos
- Historial médico
- Información de contacto

### 3. Neurodiversidad
- Evaluaciones TEA, TDAH, Dislexia
- Diagnósticos especializados
- Recomendaciones terapéuticas
- Archivos adjuntos

### 4. Citas
- Calendario de citas
- Gestión de estados
- Recordatorios
- Asignación de profesionales

### 5. Terapias
- Registro de sesiones
- Objetivos terapéuticos
- Seguimiento de progreso
- Planes de tratamiento

### 6. Dashboard
- Estadísticas en tiempo real
- Gráficas de seguimiento
- Indicadores clave
- Resumen de actividades

## 🤝 Guía de Colaboración

### Para Desarrolladores

1. **Antes de empezar:**
   - Revisar el módulo asignado a tu equipo
   - Crear tu rama desde `develop`
   - Comunicar cambios importantes al equipo

2. **Durante el desarrollo:**
   - Commits frecuentes y descriptivos
   - Seguir convenciones de código
   - Documentar funciones importantes
   - No modificar módulos de otros equipos sin coordinación

3. **Al terminar:**
   - Crear Pull Request a `develop`
   - Solicitar code review
   - Resolver comentarios
   - Actualizar documentación si es necesario

### Convenciones de Código

- **PHP:** PSR-12
- **JavaScript:** ES6+
- **CSS:** BEM methodology
- **SQL:** snake_case para tablas y columnas
- **Commits:** Conventional Commits

## 📖 Documentación Adicional

- [Guía de API](docs/API.md) - Por crear
- [Manual de Usuario](docs/USER_MANUAL.md) - Por crear
- [Arquitectura del Sistema](docs/ARCHITECTURE.md) - Por crear

## 🐛 Reporte de Bugs

Para reportar bugs o solicitar nuevas funcionalidades:
1. Crear un Issue en GitHub
2. Usar las etiquetas apropiadas
3. Describir el problema con detalle
4. Incluir pasos para reproducir

## 📄 Licencia

Este proyecto es de código abierto para fines educativos.

## 👨‍💻 Equipo de Desarrollo

Proyecto desarrollado colaborativamente por 6 equipos especializados como parte de un ejercicio de desarrollo ágil y trabajo en equipo.

---

**© 2024 Expediente Clínico Integral - Sistema Colaborativo**

Para más información, contactar al coordinador del proyecto.