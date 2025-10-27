/**
 * JavaScript Principal
 * Expediente Clínico Integral
 */

// Funciones globales
window.viewPatient = function(id) {
    alert('Ver detalles del paciente ' + id + ' (funcionalidad por implementar)');
};

window.viewEvaluation = function(id) {
    alert('Ver evaluación ' + id + ' (funcionalidad por implementar)');
};

window.viewCita = function(id) {
    alert('Ver cita ' + id + ' (funcionalidad por implementar)');
};

window.viewTerapia = function(id) {
    alert('Ver terapia ' + id + ' (funcionalidad por implementar)');
};

// Utilidades
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-MX', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function formatDateTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('es-MX', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Manejo de errores global
window.addEventListener('error', function(e) {
    console.error('Error:', e.error);
});

// Confirmación antes de cerrar sesión
document.addEventListener('DOMContentLoaded', function() {
    const logoutLinks = document.querySelectorAll('a[href*="logout"]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('¿Está seguro de que desea cerrar sesión?')) {
                e.preventDefault();
            }
        });
    });
});

// Búsqueda en tablas
function setupTableSearch(inputId, tableId) {
    const input = document.getElementById(inputId);
    if (!input) return;

    input.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const table = document.getElementById(tableId);
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const textValue = cell.textContent || cell.innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            rows[i].style.display = found ? '' : 'none';
        }
    });
}

// Notificaciones
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#06b6d4'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        z-index: 1000;
        animation: slideIn 0.3s ease-out;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// CSS para animaciones
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

console.log('Expediente Clínico Integral - Sistema cargado correctamente');
