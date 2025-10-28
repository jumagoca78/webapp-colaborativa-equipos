<!-- Login Template - Módulo de Autenticación -->
<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <h2>Expediente Clínico Integral</h2>
            <p>Sistema de Gestión de Expedientes Médicos</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            <?php
            switch ($_GET['error']) {
                case 'campos_vacios':
                    echo 'Por favor, complete todos los campos.';
                    break;
                case 'credenciales_invalidas':
                    echo 'Usuario o contraseña incorrectos.';
                    break;
                case 'error_servidor':
                    echo 'Error del servidor. Intente nuevamente.';
                    break;
                default:
                    echo 'Error desconocido.';
            }
            ?>
        </div>
        <?php endif; ?>
        <form action="../../backend/auth/login.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        </form>

        <div class="login-footer">
            <p><small>Usuarios de ejemplo: admin / admin123</small></p>
            <p><small>&copy; 2024 Proyecto Colaborativo - 6 Equipos</small></p>
        </div>
    </div>
</div>
