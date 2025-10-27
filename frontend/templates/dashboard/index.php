<!-- Dashboard Template - Módulo Dashboard -->
<div class="dashboard">
    <h2>Dashboard - Resumen General</h2>
    
    <div class="stats-grid" id="statsGrid">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <h3 id="totalPacientes">-</h3>
                <p>Total Pacientes</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">📅</div>
            <div class="stat-info">
                <h3 id="citasHoy">-</h3>
                <p>Citas Hoy</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">⏰</div>
            <div class="stat-info">
                <h3 id="citasPendientes">-</h3>
                <p>Citas Pendientes</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">🧠</div>
            <div class="stat-info">
                <h3 id="evaluacionesMes">-</h3>
                <p>Evaluaciones (Mes)</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">💪</div>
            <div class="stat-info">
                <h3 id="terapiasMes">-</h3>
                <p>Terapias (Mes)</p>
            </div>
        </div>
    </div>

    <div class="dashboard-sections">
        <div class="section">
            <h3>Próximas Citas</h3>
            <div id="proximasCitas" class="citas-list">
                <p>Cargando...</p>
            </div>
        </div>

        <div class="section">
            <h3>Distribución de Neurodiversidad</h3>
            <div id="distribucionNeuro" class="neuro-chart">
                <p>Cargando...</p>
            </div>
        </div>
    </div>
</div>

<script>
// Cargar datos del dashboard
document.addEventListener('DOMContentLoaded', function() {
    fetch('backend/dashboard/api.php')
        .then(response => response.json())
        .then(data => {
            // Actualizar estadísticas
            document.getElementById('totalPacientes').textContent = data.total_pacientes || 0;
            document.getElementById('citasHoy').textContent = data.citas_hoy || 0;
            document.getElementById('citasPendientes').textContent = data.citas_pendientes || 0;
            document.getElementById('evaluacionesMes').textContent = data.evaluaciones_mes || 0;
            document.getElementById('terapiasMes').textContent = data.terapias_mes || 0;

            // Próximas citas
            const citasContainer = document.getElementById('proximasCitas');
            if (data.proximas_citas && data.proximas_citas.length > 0) {
                citasContainer.innerHTML = data.proximas_citas.map(cita => `
                    <div class="cita-item">
                        <strong>${cita.nombre} ${cita.apellido_paterno}</strong><br>
                        <small>${new Date(cita.fecha_hora).toLocaleString('es-MX')}</small><br>
                        <small>${cita.tipo_cita}</small>
                    </div>
                `).join('');
            } else {
                citasContainer.innerHTML = '<p>No hay citas programadas</p>';
            }

            // Distribución de neurodiversidad
            const neuroContainer = document.getElementById('distribucionNeuro');
            if (data.distribucion_neurodiversidad && data.distribucion_neurodiversidad.length > 0) {
                neuroContainer.innerHTML = data.distribucion_neurodiversidad.map(item => `
                    <div class="neuro-item">
                        <span class="neuro-type">${item.tipo_evaluacion}</span>
                        <span class="neuro-count">${item.cantidad}</span>
                    </div>
                `).join('');
            } else {
                neuroContainer.innerHTML = '<p>No hay evaluaciones registradas</p>';
            }
        })
        .catch(error => {
            console.error('Error cargando dashboard:', error);
        });
});
</script>
