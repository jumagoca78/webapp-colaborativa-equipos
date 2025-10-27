# Flujo de Trabajo de Equipos

## Estrategia de Colaboración para 6 Equipos

### Estructura de Equipos

Cada equipo es responsable de un módulo específico y trabaja en su propia rama de funcionalidad.

| Equipo | Módulo | Rama Git | Líder |
|--------|--------|----------|-------|
| 1 | Autenticación | `feature/auth` | Por asignar |
| 2 | Expediente General | `feature/expediente` | Por asignar |
| 3 | Neurodiversidad | `feature/neurodiversidad` | Por asignar |
| 4 | Citas | `feature/citas` | Por asignar |
| 5 | Terapias | `feature/terapias` | Por asignar |
| 6 | Dashboard | `feature/dashboard` | Por asignar |

### Flujo de Trabajo Git

#### Inicio de Sprint

1. **Sincronizar con develop**
   ```bash
   git checkout develop
   git pull origin develop
   ```

2. **Crear/Actualizar rama de funcionalidad**
   ```bash
   git checkout -b feature/[nombre-modulo]
   # o si ya existe
   git checkout feature/[nombre-modulo]
   git merge develop
   ```

#### Durante el Desarrollo

1. **Commits frecuentes**
   ```bash
   git add .
   git commit -m "[MODULO] Descripción clara del cambio"
   ```

   Ejemplos:
   - `[AUTH] Implementar validación de sesión`
   - `[EXPEDIENTE] Agregar formulario de nuevo paciente`
   - `[NEURO] Crear API de evaluaciones`

2. **Push regular a rama remota**
   ```bash
   git push origin feature/[nombre-modulo]
   ```

#### Integración

1. **Preparar para Pull Request**
   ```bash
   # Actualizar rama con últimos cambios de develop
   git checkout develop
   git pull origin develop
   git checkout feature/[nombre-modulo]
   git merge develop
   
   # Resolver conflictos si existen
   # git add archivos-resueltos
   # git commit -m "Resolver conflictos con develop"
   ```

2. **Crear Pull Request**
   - Ir a GitHub
   - Crear PR de `feature/[modulo]` → `develop`
   - Asignar revisor de otro equipo
   - Describir cambios realizados

3. **Code Review**
   - Revisor asignado revisa el código
   - Solicitar cambios si es necesario
   - Aprobar cuando esté correcto

4. **Merge**
   - Después de aprobación, hacer merge
   - Eliminar rama si ya no se necesita

### Reuniones de Sincronización

#### Daily Stand-up (15 min)
- **Cuándo:** Diario
- **Qué:** Cada equipo comparte:
  - Qué hicimos ayer
  - Qué haremos hoy
  - Impedimentos

#### Integration Meeting (1 hora)
- **Cuándo:** Cada 3 días
- **Qué:** 
  - Revisar integraciones entre módulos
  - Resolver dependencias
  - Planificar siguiente integración

#### Sprint Review (2 horas)
- **Cuándo:** Fin de sprint (cada 2 semanas)
- **Qué:**
  - Demo de funcionalidades completadas
  - Feedback del Product Owner
  - Planificación del siguiente sprint

### Comunicación Entre Equipos

#### Canales

1. **Slack/Discord**
   - Canal general: #general
   - Canales por equipo: #team-auth, #team-expediente, etc.
   - Canal técnico: #tech-discussions
   - Canal de integración: #integration

2. **GitHub Issues**
   - Usar para bugs y features
   - Etiquetar por módulo
   - Asignar al equipo responsable

3. **Documentación**
   - Mantener actualizado el README
   - Documentar APIs en docs/API.md
   - Comentarios en código cuando sea necesario

### Resolución de Conflictos

#### Conflictos en Código

1. **Prevención:**
   - Comunicar cambios que afecten otros módulos
   - Mantener ramas actualizadas con develop
   - No modificar código de otros equipos sin coordinación

2. **Resolución:**
   ```bash
   # Si hay conflicto al hacer merge
   git status  # Ver archivos en conflicto
   # Editar archivos, resolver conflictos
   git add archivos-resueltos
   git commit -m "Resolver conflictos de merge"
   ```

3. **Escalación:**
   - Si no se puede resolver: involucrar a ambos equipos
   - Última instancia: decisión del arquitecto/líder técnico

#### Conflictos de Diseño

- Discutir en #tech-discussions
- Documentar decisión tomada
- Actualizar documentación

### Checklist de Integración

Antes de crear Pull Request a `develop`:

- [ ] Código sigue convenciones del proyecto
- [ ] Tests pasan correctamente
- [ ] No hay console.log() o var_dump() de debug
- [ ] Comentarios útiles en código complejo
- [ ] README actualizado si es necesario
- [ ] Sin archivos temporales o de configuración local
- [ ] Rama sincronizada con develop
- [ ] Probado en entorno local

### Proceso de Release

1. **Preparación**
   ```bash
   git checkout develop
   git pull origin develop
   # Verificar que todo funciona
   ```

2. **Crear Release Branch**
   ```bash
   git checkout -b release/v1.0.0
   # Ajustes finales, versiones, etc.
   ```

3. **Testing en Staging**
   - Deploy a ambiente de staging
   - Pruebas completas
   - Corrección de bugs críticos

4. **Merge a Main**
   ```bash
   git checkout main
   git merge release/v1.0.0
   git tag -a v1.0.0 -m "Release version 1.0.0"
   git push origin main --tags
   ```

5. **Deploy a Producción**
   - Ejecutar pipeline de CI/CD
   - Monitorear logs
   - Verificar funcionamiento

### Buenas Prácticas

1. **Commits:**
   - Mensajes descriptivos
   - Un cambio lógico por commit
   - Probar antes de hacer commit

2. **Branches:**
   - Mantener limpias (eliminar después de merge)
   - Sincronizar frecuentemente
   - No commits directos a main/develop

3. **Code Review:**
   - Ser constructivo
   - Explicar el "por qué" de los comentarios
   - Agradecer revisiones

4. **Comunicación:**
   - Sobre-comunicar es mejor que sub-comunicar
   - Usar canales apropiados
   - Responder en tiempo razonable

---

**Recuerda:** El éxito del proyecto depende de la colaboración efectiva entre todos los equipos.
