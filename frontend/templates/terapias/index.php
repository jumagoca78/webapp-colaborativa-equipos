<!-- Terapias Template - Módulo de Terapias -->
<div class="terapias-module">
    <h2>Gestión de Terapias</h2>
    
    <div class="module-actions">
        <button class="btn btn-primary" onclick="showNewTerapiaForm()">+ Nueva Sesión de Terapia</button>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Paciente</th>
                    <th>Terapeuta</th>
                    <th>Tipo de Terapia</th>
                    <th>Duración</th>
                    <th>Progreso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="terapiasBody">
                <tr><td colspan="7" class="text-center">Cargando...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function showNewTerapiaForm() {
    alert('Formulario de nueva terapia (por implementar)');
}

function loadTerapias() {
    fetch('backend/terapias/api.php?action=list')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('terapiasBody');
            if (data.length > 0) {
                tbody.innerHTML = data.map(terapia => `
                    <tr>
                        <td>${new Date(terapia.fecha_sesion).toLocaleDateString('es-MX')}</td>
                        <td>${terapia.nombre} ${terapia.apellido_paterno}</td>
                        <td>${terapia.terapeuta}</td>
                        <td><span class="badge badge-terapia">${terapia.tipo_terapia}</span></td>
                        <td>${terapia.duracion_minutos ? terapia.duracion_minutos + ' min' : '-'}</td>
                        <td>${terapia.progreso ? terapia.progreso.substring(0, 40) + '...' : '-'}</td>
                        <td>
                            <button class="btn btn-sm" onclick="viewTerapia(${terapia.id})">Ver</button>
                        </td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">No hay terapias registradas</td></tr>';
            }
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', loadTerapias);
</script>
