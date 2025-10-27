# Guía de Inicio Rápido

## Expediente Clínico Integral - Quick Start

### 🚀 Instalación Rápida (5 minutos)

#### 1. Prerequisitos
```bash
# Verificar que tengas instalado:
php --version    # >= 7.4
mysql --version  # >= 5.7
git --version    # >= 2.0
```

#### 2. Clonar y Configurar
```bash
# Clonar repositorio
git clone https://github.com/jumagoca78/webapp-colaborativa-equipos.git
cd webapp-colaborativa-equipos

# Crear base de datos
mysql -u root -p < database/schema.sql

# Cargar datos de prueba (opcional)
mysql -u root -p expediente_clinico < database/seeds/datos_iniciales.sql
```

#### 3. Configurar Conexión
Editar `backend/config/database.php` con tus credenciales:
```php
private $host = "localhost";
private $db_name = "expediente_clinico";
private $username = "root";        // Tu usuario MySQL
private $password = "";            // Tu contraseña MySQL
```

#### 4. Iniciar Servidor
```bash
# Con PHP built-in server (desarrollo)
php -S localhost:8000

# O configurar Apache/Nginx (ver INSTALLATION.md)
```

#### 5. Acceder al Sistema
- URL: `http://localhost:8000`
- Usuario: `admin`
- Contraseña: `admin123`

### 🎯 Para Desarrolladores - Inicio Rápido

#### Si eres del Equipo 1 (Autenticación):
```bash
git checkout -b feature/auth
# Tu módulo: backend/auth/ y frontend/templates/auth/
# Implementar: gestión de usuarios, recuperación de contraseña, etc.
```

#### Si eres del Equipo 2 (Expediente):
```bash
git checkout -b feature/expediente
# Tu módulo: backend/expediente/ y frontend/templates/expediente/
# Implementar: formularios completos, edición de pacientes, etc.
```

#### Si eres del Equipo 3 (Neurodiversidad):
```bash
git checkout -b feature/neurodiversidad
# Tu módulo: backend/neurodiversidad/ y frontend/templates/neurodiversidad/
# Implementar: formularios de evaluación, reportes, etc.
```

#### Si eres del Equipo 4 (Citas):
```bash
git checkout -b feature/citas
# Tu módulo: backend/citas/ y frontend/templates/citas/
# Implementar: calendario, recordatorios, etc.
```

#### Si eres del Equipo 5 (Terapias):
```bash
git checkout -b feature/terapias
# Tu módulo: backend/terapias/ y frontend/templates/terapias/
# Implementar: planes de tratamiento, seguimiento, etc.
```

#### Si eres del Equipo 6 (Dashboard):
```bash
git checkout -b feature/dashboard
# Tu módulo: backend/dashboard/ y frontend/templates/dashboard/
# Implementar: gráficas, reportes, exportación, etc.
```

### 📂 Estructura de Archivos que Debes Conocer

```
Tu Módulo/
├── backend/[tu-modulo]/
│   └── api.php              # Tu API backend
├── frontend/templates/[tu-modulo]/
│   └── index.php            # Tu template principal
└── docs/
    └── [tu-modulo].md       # Tu documentación
```

### 🔧 Comandos Útiles

```bash
# Ver estado de git
git status

# Ver tus cambios
git diff

# Agregar y commitear
git add .
git commit -m "[TU-MODULO] Descripción del cambio"

# Subir a tu rama
git push origin feature/[tu-modulo]

# Actualizar con develop
git checkout develop
git pull origin develop
git checkout feature/[tu-modulo]
git merge develop
```

### 🧪 Probar tu Módulo

1. **Frontend:**
   - Navegar a: `http://localhost:8000?page=[tu-modulo]`
   - Verificar que se vea correctamente

2. **Backend:**
   - Usar Postman o curl para probar API
   - Ejemplo: `curl http://localhost:8000/backend/[modulo]/api.php?action=list`

3. **Base de Datos:**
   - Verificar que los datos se guarden correctamente
   - `mysql -u root -p expediente_clinico`
   - `SELECT * FROM [tu-tabla];`

### 📖 Recursos Importantes

| Documento | Para qué sirve |
|-----------|----------------|
| `README.md` | Visión general del proyecto |
| `docs/INSTALLATION.md` | Instalación detallada |
| `docs/TEAM_WORKFLOW.md` | Cómo trabajar en equipo |
| `docs/PROJECT_SUMMARY.md` | Resumen de lo implementado |
| `database/schema.sql` | Estructura de base de datos |

### ⚠️ Errores Comunes

**Error: "Access denied for user 'root'@'localhost'"**
- Solución: Verificar credenciales en `backend/config/database.php`

**Error: "Table doesn't exist"**
- Solución: Ejecutar `database/schema.sql`

**Página en blanco:**
- Solución: Verificar logs de PHP: `tail -f /var/log/apache2/error.log`

**No se ven los cambios:**
- Solución: Limpiar caché del navegador (Ctrl+Shift+R)

### 🤝 Pedir Ayuda

1. **Canal de Slack:** #tech-discussions
2. **GitHub Issues:** Crear issue con etiqueta de tu módulo
3. **Code Review:** Pedir a otro equipo que revise tu código

### ✅ Checklist Antes de Tu Primer Commit

- [ ] El código funciona en tu entorno local
- [ ] No hay errores de PHP (syntax check)
- [ ] Los archivos están en la carpeta correcta
- [ ] El commit message es descriptivo
- [ ] No estás modificando archivos de otros módulos
- [ ] Tu rama está actualizada con develop

### 🎉 ¡Listo para Empezar!

Ya tienes todo lo necesario para comenzar a trabajar en tu módulo.

**Siguiente paso:** Lee la documentación específica de tu módulo y comienza a desarrollar.

---

**¿Dudas?** Revisa `docs/TEAM_WORKFLOW.md` o pregunta en el canal de tu equipo.
