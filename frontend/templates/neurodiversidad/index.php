<!-- Neurodiversidad Template - Módulo de Neurodiversidad -->
<div class="neurodiversidad-module">
    <h2>Evaluaciones de Neurodiversidad</h2>
    
    <div class="module-actions">
        <button class="btn btn-primary" onclick="showNewEvaluationForm()">+ Nueva Evaluación</button>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Tipo de Evaluación</th>
                    <th>Fecha</th>
                    <th>Evaluador</th>
                    <th>Diagnóstico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="evaluationsBody">
                <tr><td colspan="6" class="text-center">Cargando...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function showNewEvaluationForm() {
    alert('Formulario de nueva evaluación (por implementar)');
}

function loadEvaluations() {
    fetch('backend/neurodiversidad/api.php?action=list')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('evaluationsBody');
            if (data.length > 0) {
                tbody.innerHTML = data.map(eval => `
                    <tr>
                        <td>${eval.nombre} ${eval.apellido_paterno}</td>
                        <td><span class="badge badge-${eval.tipo_evaluacion}">${eval.tipo_evaluacion}</span></td>
                        <td>${new Date(eval.fecha_evaluacion).toLocaleDateString('es-MX')}</td>
                        <td>${eval.evaluador}</td>
                        <td>${eval.diagnostico ? eval.diagnostico.substring(0, 50) + '...' : '-'}</td>
                        <td>
                            <button class="btn btn-sm" onclick="viewEvaluation(${eval.id})">Ver</button>
                        </td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">No hay evaluaciones registradas</td></tr>';
            }
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', loadEvaluations);
</script>
