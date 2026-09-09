DOCUMENTO DE REQUERIMIENTOS INICIALES

Proyecto: Bus de Web Services
Versión: 1.0
Fecha: 19/08/2026
Responsable: Equipo de 2 integrantes (por definir)
Referencia técnica: Crear un Web Service con PHP y MySQL — Primeros pasos (IslaVisual)

---

1. Introducción

Un web service es un programa. Este programa expone funciones a través de una red. Un cliente remoto puede llamar estas funciones. El cliente no necesita conocer el código interno del servidor.

PHP incluye una extensión llamada SOAP. Esta extensión crea y consume web services. La extensión soporta SOAP 1.1, SOAP 1.2 y WSDL 1.1. La extensión debe estar activa en el archivo php.ini del servidor. Sin esta extensión, las clases `SoapServer` y `SoapClient` no funcionan.

Este proyecto no genera un archivo WSDL. El servicio se define de forma manual. El servicio usa un namespace fijo: `urn:BusWebServices`. Este enfoque es el mismo que usa el ejemplo de referencia de IslaVisual.

Un bus de web services es un componente central. Este componente agrupa varias operaciones en un solo punto de entrada. El archivo `bus.php` cumple este rol en este proyecto. `bus.php` crea un `SoapServer` y le asigna la clase `BusService`. La clase `BusService` contiene las operaciones reales del bus. Cada operación se conecta a una base de datos MySQL mediante PDO.

El bus registra el uso de cada operación. Cada llamada genera un registro en la tabla `logs_bus`. El registro guarda el nombre de la operación y el resultado (OK o FAULT). Este registro permite generar reportes de uso y también permite borrar el historial cuando sea necesario.

---

2. Objetivo del Proyecto

Objetivo general:
- Construir un bus de web services funcional, usando PHP, la extensión SOAP y MySQL.

Objetivos específicos:
- Exponer un conjunto de operaciones SOAP a través de un único punto de entrada (`bus.php`).
- Persistir usuarios, productos y registros de uso en una base de datos MySQL.
- Registrar cada llamada al bus como un log de uso (operación y resultado).
- Generar un reporte agregado del uso del bus por operación.
- Construir un cliente de prueba que consuma el bus mediante `SoapClient`.
- Construir un módulo de administración con un botón para borrar el historial de logs.

---

3. Alcance

Incluye:

- `bus.php`: punto de entrada SOAP. Crea el `SoapServer` sin WSDL y expone la clase `BusService`.
- `BusService.php`: clase con las operaciones del bus:
  - `login(usuario, password)`
  - `consultarProducto(codigo)`
  - `listarProductos()`
  - `reporteUso()`
- `config/Conexion.php`: conexión única a MySQL vía PDO, configurada por variables de entorno (`.env`).
- `database/schema.sql`: tablas `usuarios`, `productos` y `logs_bus`, con datos de prueba.
- `cliente.php` (pendiente): script que consume el bus con `SoapClient` y prueba las 4 operaciones.
- `admin.php` (pendiente): página con un botón que borra los registros de `logs_bus`, con confirmación previa.

No incluye:

- Generación o publicación de un archivo WSDL.
- Una API REST equivalente.
- Un sistema de sesiones o roles de usuario más allá de la validación simple de `login`.
- Despliegue en un servidor de producción.
- Una interfaz gráfica más allá de las páginas simples `cliente.php` y `admin.php`.

---

4. Stakeholders

| Rol | Nombre | Descripción |
| --- | --- | --- |
| Equipo de desarrollo | Por definir (2 integrantes) | Construye y mantiene `bus.php`, `BusService.php`, `cliente.php` y `admin.php`. |
| Usuario del bus | Cliente SOAP (`cliente.php` u otro consumidor) | Llama a las operaciones del bus: `login`, `consultarProducto`, `listarProductos`, `reporteUso`. |
| Administrador | Persona con acceso a `admin.php` | Borra el historial de logs del bus cuando sea necesario. |

---

5. Requerimientos Funcionales

| ID | Requerimiento | Descripción | Prioridad |
| --- | --- | --- | --- |
| RF-01 | Autenticar usuario | La operación `login(usuario, password)` debe validar las credenciales contra la tabla `usuarios`, usando `password_verify`. | Alta |
| RF-02 | Consultar producto | La operación `consultarProducto(codigo)` debe devolver código, nombre, precio y stock de un producto existente. | Alta |
| RF-03 | Listar productos | La operación `listarProductos()` debe devolver todos los productos ordenados por nombre. | Media |
| RF-04 | Reportar uso | La operación `reporteUso()` debe devolver, por operación, el total de llamadas y el total de errores (`FAULT`), a partir de `logs_bus`. | Media |
| RF-05 | Registrar log de uso | Cada llamada a una operación del bus debe insertar un registro en `logs_bus` con la operación y el resultado (`OK` o `FAULT`). | Alta |
| RF-06 | Botón de administración | `admin.php` debe mostrar un botón que borra todos los registros de `logs_bus`, tras pedir confirmación. | Alta |
| RF-07 | Cliente de prueba | `cliente.php` debe consumir el bus con `SoapClient` y mostrar el resultado de las 4 operaciones expuestas. | Media |

---

6. Requerimientos No Funcionales

| ID | Tipo | Descripción |
| --- | --- | --- |
| RNF-01 | Seguridad | Las contraseñas se almacenan como hash (`password_hash`, bcrypt). Nunca se guardan ni se devuelven en texto plano. |
| RNF-02 | Seguridad | Todas las consultas SQL usan sentencias preparadas de PDO, para evitar inyección SQL. |
| RNF-03 | Configuración | El servidor debe tener activa la extensión SOAP de PHP (`extension=soap` en `php.ini`). |
| RNF-04 | Configuración | Las credenciales de base de datos se leen de variables de entorno (`.env`), no del código fuente. |
| RNF-05 | Confiabilidad | El borrado de logs en `admin.php` es una acción destructiva. Debe pedir confirmación antes de ejecutarse. |
| RNF-06 | Compatibilidad | La base de datos usa motor InnoDB y charset `utf8mb4`. |

---

7. Reglas de Negocio

- El servicio SOAP no usa WSDL. El namespace fijo es `urn:BusWebServices`.
- Toda operación del bus, exitosa o fallida, debe generar un registro en `logs_bus`.
- Un intento de `login` fallido debe lanzar un `SoapFault` genérico, sin indicar si el usuario existe.
- El campo `codigo` de la tabla `productos` es único y es la clave de búsqueda para `consultarProducto`.
- Borrar los registros de `logs_bus` no debe afectar ni a `usuarios` ni a `productos`.

---

8. Supuestos

- El servidor de despliegue tiene PHP 8 o superior, con la extensión SOAP habilitada.
- Existe una base de datos MySQL accesible con las credenciales definidas en `.env`.
- Los datos de prueba del esquema (usuario `demo`, productos `PRD-001` y `PRD-002`) son suficientes para validar el bus durante el desarrollo.

---

9. Restricciones

- El bus debe implementarse con la extensión SOAP nativa de PHP, sin frameworks adicionales.
- La conexión a la base de datos debe hacerse únicamente mediante PDO.
- `cliente.php` y `admin.php` están pendientes de desarrollo (ver `docs/documentacion.md`).
- El proyecto no debe depender de un archivo WSDL externo.

---

10. Riesgos

| Riesgo | Impacto | Mitigación |
| --- | --- | --- |
| La extensión SOAP no está habilitada en el servidor de pruebas | Alto: el bus no responde ninguna petición | Verificar `phpinfo()` o `php.ini` antes de ejecutar el bus. |
| Sin WSDL, el cliente no conoce automáticamente los métodos disponibles | Medio: el consumidor debe conocer los métodos de antemano | Mantener actualizada la lista de operaciones en `docs/documentacion.md`. |
| Borrado accidental de `logs_bus` desde `admin.php` | Medio: se pierde el historial de uso | Pedir confirmación explícita antes de ejecutar el `DELETE`. |
| Credenciales de base de datos expuestas en el repositorio | Alto: riesgo de seguridad | Usar `.env` (no versionado) y mantener `.env.example` solo con valores de ejemplo. |

---

11. Criterios de Aceptación

- `bus.php` responde correctamente a peticiones SOAP para `login`, `consultarProducto`, `listarProductos` y `reporteUso`.
- `login` nunca devuelve la contraseña ni el hash, solo `usuario` y `nombre` cuando la autenticación es correcta.
- Cada llamada a una operación del bus queda registrada en `logs_bus`, con el resultado correcto (`OK` o `FAULT`).
- `admin.php` borra los registros de `logs_bus` solo después de confirmación, y `reporteUso()` refleja el borrado.
- `cliente.php` consume el bus mediante `SoapClient` y muestra el resultado de las 4 operaciones sin errores.

---

12. Aprobación

| Nombre | Cargo | Firma | Fecha |
| --- | --- | --- | --- |
| | Integrante 1 | | |
| | Integrante 2 | | |
