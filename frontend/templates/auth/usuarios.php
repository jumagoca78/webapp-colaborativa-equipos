<!-- Usuarios Template - Módulo de Autenticación (Admin) -->
<div class="usuarios-module">
    <h2>Gestión de Usuarios</h2>
    
    <div class="alert alert-info">
        Esta sección está disponible solo para administradores.
    </div>

    <div class="module-actions">
        <button class="btn btn-primary" onclick="showNewUserForm()">+ Nuevo Usuario</button>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre Completo</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>admin</td>
                    <td>Administrador del Sistema</td>
                    <td>admin@clinica.com</td>
                    <td><span class="badge" style="background: #ef4444; color: white;">Admin</span></td>
                    <td><span class="badge" style="background: #10b981; color: white;">Activo</span></td>
                    <td>2024-01-01</td>
                    <td>
                        <button class="btn btn-sm" disabled>Editar</button>
                    </td>
                </tr>
                <tr>
                    <td>dr.garcia</td>
                    <td>Dr. Juan García López</td>
                    <td>garcia@clinica.com</td>
                    <td><span class="badge" style="background: #2563eb; color: white;">Médico</span></td>
                    <td><span class="badge" style="background: #10b981; color: white;">Activo</span></td>
                    <td>2024-01-15</td>
                    <td>
                        <button class="btn btn-sm" disabled>Editar</button>
                    </td>
                </tr>
                <tr>
                    <td>lic.martinez</td>
                    <td>Lic. María Martínez Ruiz</td>
                    <td>martinez@clinica.com</td>
                    <td><span class="badge" style="background: #f59e0b; color: white;">Terapeuta</span></td>
                    <td><span class="badge" style="background: #10b981; color: white;">Activo</span></td>
                    <td>2024-01-20</td>
                    <td>
                        <button class="btn btn-sm" disabled>Editar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function showNewUserForm() {
    alert('Formulario de nuevo usuario (funcionalidad por implementar por Equipo 1)');
}
</script>
