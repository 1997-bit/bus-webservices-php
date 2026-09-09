DOCUMENTO DE REQUERIMIENTOS INICIALES

Proyecto: Bus de Web Services
Versión: 1.0
Fecha: 19/08/2026
Responsable: Equipo de 2 integrantes (por definir)
Asignatura: Ingeniería de Software Aplicada III — Universidad Tecnológica de Panamá, Facultad de Ingeniería de Sistemas Computacionales

---

1. Introducción

Un web service es un programa. Este programa permite la comunicación entre dos sistemas distintos. Los sistemas pueden estar en plataformas diferentes. Los sistemas pueden usar lenguajes de programación diferentes. El web service envía y recibe datos a través de una red.

Un bus de web services es un sistema central. Este sistema conecta varios web services. El bus recibe una solicitud del usuario. El bus envía la solicitud al web service correcto. El web service devuelve una respuesta. El bus entrega la respuesta al usuario.

SOAP es un protocolo de comunicación. SOAP usa mensajes en formato XML. SOAP define reglas estrictas para el intercambio de datos. REST es un estilo de arquitectura. REST usa el protocolo HTTP de forma directa. REST es, en general, más simple que SOAP.

Este proyecto usa el protocolo SOAP. El proyecto usa PHP como lenguaje de programación. El proyecto usa MySQL como motor de base de datos.

La interoperabilidad es la capacidad de dos sistemas para trabajar juntos. Los web services dan interoperabilidad a los sistemas distribuidos. Un sistema distribuido tiene partes que funcionan en computadoras diferentes. Sin un estándar común, dos sistemas distintos no pueden intercambiar datos de forma confiable. Por esta razón, se usan protocolos como SOAP y REST.

---

2. Objetivo del Proyecto

Objetivo general:
- Analizar los fundamentos teóricos y arquitectónicos de los web services.
- Comprender el rol de los web services como solución de interoperabilidad entre sistemas distribuidos.
- Comparar los estándares SOAP y REST mediante su aplicación en un caso real.
- Determinar la vigencia y pertinencia de estos estándares en la ingeniería de software actual.

Objetivos específicos:
- Crear un web service con PHP y MySQL.
- Integrar uno o más web services en un bus central.
- Crear un módulo de administración con un botón para borrar las búsquedas registradas.
- Preparar y realizar una exposición práctica del proyecto.
- Elaborar un manual de usuario.

---

3. Alcance

Incluye:

- Diseño y desarrollo de un bus de web services.
- Al menos un web service creado con PHP y MySQL, usando el protocolo SOAP.
- Un módulo de administración con un botón para borrar las búsquedas realizadas.
- Documentación técnica y manual de usuario.
- Preparación y ejecución de una exposición grupal en clase.

No incluye:

- Despliegue en un servidor de producción externo a la universidad, salvo indicación contraria del profesor.
- Integración con sistemas de terceros fuera del alcance académico del curso.
- Soporte técnico posterior a la fecha de entrega final (18/09/2026).

---

4. Stakeholders

| Rol | Nombre | Descripción |
| --- | --- | --- |
| Profesor de Proyectos | Arturo Murillo | Evalúa el proyecto. Define los criterios de aceptación y la matriz de evaluación. |
| Integrante del equipo 1 | Por definir | Desarrolla el bus de web services. Da soporte a la clase. |
| Integrante del equipo 2 | Por definir | Desarrolla el bus de web services. Da soporte a la clase. |
| Compañeros de clase | Grupo del curso | Usan la herramienta durante las sesiones de clase. |

---

5. Requerimientos Funcionales

| ID | Requerimiento | Descripción | Prioridad |
| --- | --- | --- | --- |
| RF-01 | Crear web service SOAP | El sistema debe exponer un web service en PHP. El web service debe consultar una base de datos MySQL. | Alta |
| RF-02 | Crear bus de web services | El sistema debe centralizar el acceso a uno o más web services. El bus debe recibir la solicitud del usuario y devolver la respuesta correspondiente. | Alta |
| RF-03 | Registrar búsquedas | El sistema debe guardar un historial de las búsquedas realizadas por los usuarios. | Media |
| RF-04 | Botón de administración | El sistema debe tener un botón de administración. Este botón borra el historial de búsquedas. | Alta |

---

6. Requerimientos No Funcionales

| ID | Tipo | Descripción |
| --- | --- | --- |
| RNF-01 | Usabilidad | La interfaz debe ser clara. Un compañero de clase debe poder usarla sin ayuda extensa. |
| RNF-02 | Documentación | El equipo debe entregar un manual de usuario. Este manual vale el 50% de la nota total. |
| RNF-03 | Soporte | Cada integrante debe apoyar a otros estudiantes durante el uso de la herramienta en clase. |
| RNF-04 | Compatibilidad | El web service debe funcionar con PHP y MySQL. |

---

7. Reglas de Negocio

- El proyecto es grupal. Cada grupo tiene 2 personas.
- El equipo debe exponer el proyecto en las sesiones de clase.
- Cada integrante debe apoyar al resto de la clase en el uso correcto de la herramienta.
- El equipo debe traer los criterios de evaluación el día de la exposición.

---

8. Supuestos

- Los estudiantes tienen acceso a un servidor con PHP y MySQL.
- El profesor evalúa el proyecto según la matriz de evaluación adjunta a la guía.
- Las sesiones de clase incluyen tiempo asignado para la exposición de cada grupo.

---

9. Restricciones

- Fecha de inicio: 19/08/2026.
- Fecha de fin: 18/09/2026.
- El equipo debe tener exactamente 2 integrantes.
- El proyecto debe usar PHP y MySQL, según el ejemplo de referencia indicado por el profesor.
- La presentación debe realizarse en las sesiones de clase, no fuera de ellas.

---

10. Riesgos

| Riesgo | Impacto | Mitigación |
| --- | --- | --- |
| Un integrante no puede asistir a la exposición | Alto: afecta el 50% práctico de la nota | Repartir el conocimiento entre los dos integrantes. Ambos deben poder exponer cualquier parte del proyecto. |
| Falla del servidor o de la base de datos durante la demo | Alto: la demostración no funciona | Probar el sistema antes de la exposición. Mantener una copia local de respaldo. |
| Entrega tardía del manual de usuario | Medio: afecta el 50% escrito de la nota | Fijar una fecha interna de entrega anterior al 18/09/2026. |

---

11. Criterios de Aceptación

- El web service responde correctamente usando el protocolo SOAP.
- El bus de web services conecta el web service con el usuario final.
- El botón de administración borra el historial de búsquedas sin errores.
- El equipo entrega el manual de usuario completo.
- El equipo expone el proyecto en la fecha asignada por el profesor.
- La evaluación total es de 100 puntos. 50 puntos corresponden a la exposición y práctica en grupo. 50 puntos corresponden al trabajo escrito (manual de usuario).
- La matriz de evaluación mide cinco elementos: exposición general del grupo, aportes del grupo, uso práctico de la teoría, conocimiento del tema, y calidad y pertinencia. Cada elemento se califica de 1 (deficiente) a 5 (excelente).

---

12. Aprobación

| Nombre | Cargo | Firma | Fecha |
| --- | --- | --- | --- |
| Arturo Murillo | Profesor de Proyectos | | |
| | Integrante 1 | | |
| | Integrante 2 | | |
