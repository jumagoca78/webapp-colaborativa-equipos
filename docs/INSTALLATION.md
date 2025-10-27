# Guía de Instalación

## Expediente Clínico Integral

### Requisitos del Sistema

- **PHP:** 7.4 o superior
- **MySQL:** 5.7 o superior
- **Servidor Web:** Apache 2.4+ o Nginx 1.18+
- **Git:** 2.0 o superior

### Instalación Paso a Paso

#### 1. Preparar el Entorno

**Para Apache:**
```bash
# Instalar Apache, PHP y MySQL en Ubuntu/Debian
sudo apt update
sudo apt install apache2 php php-mysql mysql-server git

# Habilitar módulos necesarios
sudo a2enmod rewrite
sudo systemctl restart apache2
```

**Para Nginx:**
```bash
sudo apt update
sudo apt install nginx php-fpm php-mysql mysql-server git
```

#### 2. Clonar el Repositorio

```bash
cd /var/www/html
sudo git clone https://github.com/jumagoca78/webapp-colaborativa-equipos.git
cd webapp-colaborativa-equipos
```

#### 3. Configurar Base de Datos

```bash
# Iniciar sesión en MySQL
mysql -u root -p

# Ejecutar el script de creación
mysql -u root -p < database/schema.sql

# Opcional: Cargar datos de prueba
mysql -u root -p expediente_clinico < database/seeds/datos_iniciales.sql
```

#### 4. Configurar Conexión a Base de Datos

Editar `backend/config/database.php`:

```php
private $host = "localhost";
private $db_name = "expediente_clinico";
private $username = "tu_usuario";
private $password = "tu_contraseña";
```

#### 5. Configurar Permisos

```bash
# Dar permisos apropiados
sudo chown -R www-data:www-data /var/www/html/webapp-colaborativa-equipos
sudo chmod -R 755 /var/www/html/webapp-colaborativa-equipos
```

#### 6. Configurar Virtual Host (Apache)

Crear `/etc/apache2/sites-available/expediente-clinico.conf`:

```apache
<VirtualHost *:80>
    ServerName expediente-clinico.local
    DocumentRoot /var/www/html/webapp-colaborativa-equipos
    
    <Directory /var/www/html/webapp-colaborativa-equipos>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/expediente-error.log
    CustomLog ${APACHE_LOG_DIR}/expediente-access.log combined
</VirtualHost>
```

```bash
# Habilitar el sitio
sudo a2ensite expediente-clinico.conf
sudo systemctl reload apache2
```

#### 7. Configurar Hosts (Opcional)

```bash
sudo nano /etc/hosts
```

Agregar:
```
127.0.0.1   expediente-clinico.local
```

### Verificación de Instalación

1. Abrir navegador: `http://expediente-clinico.local` o `http://localhost/webapp-colaborativa-equipos`
2. Usar credenciales de prueba:
   - Usuario: `admin`
   - Contraseña: `admin123`

### Solución de Problemas Comunes

#### Error de conexión a base de datos
- Verificar credenciales en `backend/config/database.php`
- Asegurar que MySQL está corriendo: `sudo systemctl status mysql`

#### Página en blanco
- Verificar logs de PHP: `tail -f /var/log/apache2/error.log`
- Habilitar display_errors en php.ini para desarrollo

#### Error 403 Forbidden
- Verificar permisos de archivos
- Revisar configuración de Apache/Nginx

### Configuración para Desarrollo

```bash
# Habilitar errores de PHP
sudo nano /etc/php/7.4/apache2/php.ini
```

Cambiar:
```ini
display_errors = On
error_reporting = E_ALL
```

### Siguiente Paso

Ver [DATABASE_SCHEMA.md](DATABASE_SCHEMA.md) para entender la estructura de la base de datos.
