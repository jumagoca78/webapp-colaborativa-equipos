<!-- Citas Template - Módulo de Citas -->
<div class="citas-module">
    <h2>Gestión de Citas</h2>
    
    <div class="module-actions">
        <button class="btn btn-primary" onclick="showNewCitaForm()">+ Nueva Cita</button>
        <button class="btn btn-secondary" onclick="loadTodayCitas()">Citas de Hoy</button>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Fecha y Hora</th>
                    <th>Paciente</th>
                    <th>Profesional</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="citasBody">
                <tr><td colspan="7" class="text-center">Cargando...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function showNewCitaForm() {
    alert('Formulario de nueva cita (por implementar)');
}

function loadCitas() {
    fetch('backend/citas/api.php?action=list')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('citasBody');
            if (data.length > 0) {
                tbody.innerHTML = data.map(cita => `
                    <tr>
                        <td>${new Date(cita.fecha_hora).toLocaleString('es-MX')}</td>
                        <td>${cita.nombre} ${cita.apellido_paterno}</td>
                        <td>${cita.profesional}</td>
                        <td>${cita.tipo_cita}</td>
                        <td><span class="badge badge-${cita.estado.toLowerCase()}">${cita.estado}</span></td>
                        <td>${cita.motivo ? cita.motivo.substring(0, 30) + '...' : '-'}</td>
                        <td>
                            <button class="btn btn-sm" onclick="viewCita(${cita.id})">Ver</button>
                        </td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">No hay citas registradas</td></tr>';
            }
        })
        .catch(error => console.error('Error:', error));
}

function loadTodayCitas() {
    fetch('backend/citas/api.php?action=today')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('citasBody');
            if (data.length > 0) {
                tbody.innerHTML = data.map(cita => `
                    <tr>
                        <td>${new Date(cita.fecha_hora).toLocaleString('es-MX')}</td>
                        <td>${cita.nombre} ${cita.apellido_paterno}</td>
                        <td>${cita.profesional}</td>
                        <td>${cita.tipo_cita}</td>
                        <td><span class="badge badge-${cita.estado.toLowerCase()}">${cita.estado}</span></td>
                        <td>${cita.motivo ? cita.motivo.substring(0, 30) + '...' : '-'}</td>
                        <td>
                            <button class="btn btn-sm" onclick="viewCita(${cita.id})">Ver</button>
                        </td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">No hay citas para hoy</td></tr>';
            }
        });
}

document.addEventListener('DOMContentLoaded', loadCitas);
</script>
