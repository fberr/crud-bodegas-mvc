/*
========================================================
ESQUEMA DE BASE DE DATOS - SISTEMA DE BODEGAS
========================================================
*/

-- =====================================================
-- TIPO ENUM: estado de la bodega
-- =====================================================
CREATE TYPE estado_bodega AS ENUM ('Activada', 'Desactivada');

-- =====================================================
-- TABLA: bodegas
-- Almacena información de cada bodega del sistema
-- =====================================================
CREATE TABLE public.bodegas (
    id serial4 NOT NULL,  -- Identificador único autoincremental
    codigo varchar(5) NOT NULL,  -- Código único de la bodega (máx. 5 caracteres)
    nombre varchar(100) NOT NULL, -- Nombre descriptivo de la bodega
    direccion text NOT NULL, -- Dirección física de la bodega
    dotacion int4 NOT NULL, -- Cantidad de personal asignado
    estado public.estado_bodega NOT NULL DEFAULT 'Activada',  -- Estado de la bodega (Activada / Desactivada)
    fecha_creacion timestamp DEFAULT CURRENT_TIMESTAMP NULL, -- Fecha de creación del registro

    -- =========================
    -- RESTRICCIONES
    -- =========================

    CONSTRAINT bodegas_codigo_key UNIQUE (codigo),
    -- Evita códigos duplicados
    CONSTRAINT bodegas_dotacion_check CHECK (dotacion >= 0),
    -- Evita valores negativos en dotación
    CONSTRAINT bodegas_pkey PRIMARY KEY (id)
    -- Clave primaria
);

-- =====================================================
-- TABLA: encargados
-- Almacena personas responsables de bodegas
-- =====================================================
CREATE TABLE public.encargados (
    id serial4 NOT NULL, -- Identificador único
    run varchar(12) NOT NULL, -- RUN chileno (identificador único)
    nombre varchar(50) NOT NULL,
    apellido_paterno varchar(50) NOT NULL,
    apellido_materno varchar(50) NULL,
    direccion text NULL,
    telefono varchar(20) NULL,

    -- =========================
    -- RESTRICCIONES
    -- =========================

    CONSTRAINT encargados_pkey PRIMARY KEY (id),
    CONSTRAINT encargados_run_key UNIQUE (run)
    -- Evita duplicidad de RUN
);

-- =====================================================
-- TABLA: bodega_encargado (tabla intermedia)
-- Relación muchos a muchos entre bodegas y encargados
-- =====================================================
CREATE TABLE public.bodega_encargado (
    id serial4 NOT NULL, -- Identificador único de la relación
    bodega_id int4 NOT NULL, -- FK a bodegas
    encargado_id int4 NOT NULL, -- FK a encargados

    -- =========================
    -- RESTRICCIONES
    -- =========================

    CONSTRAINT bodega_encargado_pkey PRIMARY KEY (id),

    CONSTRAINT unique_relacion UNIQUE (bodega_id, encargado_id),
    -- Evita duplicar la misma relación
    CONSTRAINT fk_bodega FOREIGN KEY (bodega_id)
        REFERENCES public.bodegas(id) ON DELETE CASCADE,
    -- Si se elimina una bodega, se eliminan sus relaciones
    CONSTRAINT fk_encargado FOREIGN KEY (encargado_id)
        REFERENCES public.encargados(id) ON DELETE CASCADE
    -- Si se elimina un encargado, se eliminan sus relaciones
);