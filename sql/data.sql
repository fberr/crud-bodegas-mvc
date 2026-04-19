/*
========================================================
DATOS INICIALES - SISTEMA DE BODEGAS
========================================================
*/

-- =====================================================
-- INSERT: BODEGAS
-- =====================================================
INSERT INTO public.bodegas (codigo, nombre, direccion, dotacion, estado)
VALUES 
('B001', 'Bodega Central', 'Av. Principal 123', 10, 'Activada'),
('B002', 'Bodega Norte', 'Calle Norte 456', 5, 'Activada'),
('B003', 'Bodega Sur', 'Av. Sur 789', 8, 'Desactivada');

-- =====================================================
-- INSERT: ENCARGADOS
-- =====================================================
INSERT INTO public.encargados (run, nombre, apellido_paterno, apellido_materno, direccion, telefono)
VALUES
('12345678-9', 'Juan', 'Pérez', 'González', 'Santiago Centro', '912345678'),
('98765432-1', 'María', 'López', 'Rojas', 'Providencia', '987654321'),
('11222333-4', 'Carlos', 'Soto', 'Díaz', 'Las Condes', '956789123');

-- =====================================================
-- INSERT: RELACIÓN BODEGA - ENCARGADO
-- =====================================================
INSERT INTO public.bodega_encargado (bodega_id, encargado_id)
VALUES
(1, 1),
(1, 2),
(2, 3);