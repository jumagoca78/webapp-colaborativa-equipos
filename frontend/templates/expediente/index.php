<!-- Expediente Template - Módulo de Expediente General -->
<div class="expediente-module">
    <h2>Gestión de Expedientes</h2>
    
    <div class="module-actions">
        <button class="btn btn-primary" onclick="showNewPatientForm()">+ Nuevo Paciente</button>
        <input type="text" id="searchPatient" placeholder="Buscar paciente..." class="search-input">
    </div>

    <div id="newPatientForm" class="form-container" style="display: none;">
        <h3>Nuevo Paciente</h3>
        <form id="patientForm">
            <div class="form-row">
                <div class="form-group">
                    <label>Número de Expediente</label>
                    <input type="text" name="numero_expediente" required>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" required>
                </div>
                <div class="form-group">
                    <label>Apellido Materno</label>
                    <input type="text" name="apellido_materno">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" required>
                </div>
                <div class="form-group">
                    <label>Género</label>
                    <select name="genero" required>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" name="telefono">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label>Dirección</label>
                <textarea name="direccion" rows="2"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Contacto de Emergencia</label>
                    <input type="text" name="contacto_emergencia">
                </div>
                <div class="form-group">
                    <label>Teléfono de Emergencia</label>
                    <input type="tel" name="telefono_emergencia">
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="hideNewPatientForm()">Cancelar</button>
            </div>
        </form>
    </div>

    <div class="table-container">
        <table class="data-table" id="patientsTable">
            <thead>
                <tr>
                    <th>Expediente</th>
                    <th>Nombre Completo</th>
                    <th>Fecha Nacimiento</th>
                    <th>Teléfono</th>
                    <th>Tipo Sangre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="patientsBody">
                <tr><td colspan="6" class="text-center">Cargando...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function showNewPatientForm() {
    document.getElementById('newPatientForm').style.display = 'block';
}

function hideNewPatientForm() {
    document.getElementById('newPatientForm').style.display = 'none';
    document.getElementById('patientForm').reset();
}

function loadPatients() {
    fetch('backend/expediente/api.php?action=list')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('patientsBody');
            if (data.length > 0) {
                tbody.innerHTML = data.map(patient => `
                    <tr>
                        <td>${patient.numero_expediente}</td>
                        <td>${patient.nombre} ${patient.apellido_paterno} ${patient.apellido_materno || ''}</td>
                        <td>${new Date(patient.fecha_nacimiento).toLocaleDateString('es-MX')}</td>
                        <td>${patient.telefono || '-'}</td>
                        <td>${patient.tipo_sangre || '-'}</td>
                        <td>
                            <button class="btn btn-sm" onclick="viewPatient(${patient.id})">Ver</button>
                        </td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">No hay pacientes registrados</td></tr>';
            }
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', loadPatients);
</script>
