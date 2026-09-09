-- Bus de Web Services: esquema simple
-- 3 tablas: usuarios (login), productos (consulta), logs_bus (reporte de uso)

CREATE TABLE IF NOT EXISTS usuarios (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuario       VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    nombre        VARCHAR(150) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuarios_usuario (usuario)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS productos (
    id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    codigo  VARCHAR(30)  NOT NULL,
    nombre  VARCHAR(150) NOT NULL,
    precio  DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock   INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    UNIQUE KEY uq_productos_codigo (codigo)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE IF NOT EXISTS logs_bus (
    id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    operacion VARCHAR(100) NOT NULL,
    resultado VARCHAR(10)  NOT NULL, -- OK o FAULT
    fecha     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Datos de prueba
-- password_hash corresponde a "Demo123!" con password_hash(..., PASSWORD_BCRYPT)
INSERT INTO usuarios (usuario, password_hash, nombre)
VALUES ('demo', '$2y$12$VCt8qTAfSxa6rLoU1m7ZnuEp8zsamnE4qMixQjIDCpmI5qsPCsdkC', 'Usuario Demo')
ON DUPLICATE KEY UPDATE usuario = usuario;

INSERT INTO productos (codigo, nombre, precio, stock)
VALUES
    ('PRD-001', 'Teclado mecanico', 45.99, 20),
    ('PRD-002', 'Mouse inalambrico', 19.50, 35)
ON DUPLICATE KEY UPDATE codigo = codigo;
