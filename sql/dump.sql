--
-- PostgreSQL database dump
--

\restrict X0BGXUgD0F2hFLizSdB5uCBopncJJEeUb4znbRo9JFjYd4WTqccYvCwI4dTI7kO

-- Dumped from database version 18.3 (Postgres.app)
-- Dumped by pg_dump version 18.3 (Postgres.app)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: estado_bodega; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.estado_bodega AS ENUM (
    'Activada',
    'Desactivada'
);


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: bodega_encargado; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bodega_encargado (
    id integer NOT NULL,
    bodega_id integer NOT NULL,
    encargado_id integer NOT NULL
);


--
-- Name: bodega_encargado_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.bodega_encargado_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: bodega_encargado_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.bodega_encargado_id_seq OWNED BY public.bodega_encargado.id;


--
-- Name: bodegas; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bodegas (
    id integer NOT NULL,
    codigo character varying(5) NOT NULL,
    nombre character varying(100) NOT NULL,
    direccion text NOT NULL,
    dotacion integer NOT NULL,
    estado public.estado_bodega DEFAULT 'Activada'::public.estado_bodega NOT NULL,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT bodegas_dotacion_check CHECK ((dotacion >= 0))
);


--
-- Name: bodegas_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.bodegas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: bodegas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.bodegas_id_seq OWNED BY public.bodegas.id;


--
-- Name: encargados; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.encargados (
    id integer NOT NULL,
    run character varying(12) NOT NULL,
    nombre character varying(50) NOT NULL,
    apellido_paterno character varying(50) NOT NULL,
    apellido_materno character varying(50),
    direccion text,
    telefono character varying(20)
);


--
-- Name: encargados_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.encargados_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: encargados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.encargados_id_seq OWNED BY public.encargados.id;


--
-- Name: bodega_encargado id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bodega_encargado ALTER COLUMN id SET DEFAULT nextval('public.bodega_encargado_id_seq'::regclass);


--
-- Name: bodegas id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bodegas ALTER COLUMN id SET DEFAULT nextval('public.bodegas_id_seq'::regclass);


--
-- Name: encargados id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.encargados ALTER COLUMN id SET DEFAULT nextval('public.encargados_id_seq'::regclass);


--
-- Data for Name: bodega_encargado; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.bodega_encargado (id, bodega_id, encargado_id) FROM stdin;
1	1	1
2	1	2
3	2	3
\.


--
-- Data for Name: bodegas; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.bodegas (id, codigo, nombre, direccion, dotacion, estado, fecha_creacion) FROM stdin;
1	B001	Bodega Central	Av. Principal 123	10	Activada	2026-04-16 21:26:30.245135
2	B002	Bodega Norte	Calle Norte 456	5	Activada	2026-04-16 21:26:30.245135
3	B003	Bodega Sur	Av. Sur 789	8	Desactivada	2026-04-16 21:26:30.245135
\.


--
-- Data for Name: encargados; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.encargados (id, run, nombre, apellido_paterno, apellido_materno, direccion, telefono) FROM stdin;
1	12345678-9	Juan	Pérez	González	Santiago Centro	912345678
2	98765432-1	María	López	Rojas	Providencia	987654321
3	11222333-4	Carlos	Soto	Díaz	Las Condes	956789123
\.


--
-- Name: bodega_encargado_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.bodega_encargado_id_seq', 3, true);


--
-- Name: bodegas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.bodegas_id_seq', 3, true);


--
-- Name: encargados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.encargados_id_seq', 3, true);


--
-- Name: bodega_encargado bodega_encargado_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bodega_encargado
    ADD CONSTRAINT bodega_encargado_pkey PRIMARY KEY (id);


--
-- Name: bodegas bodegas_codigo_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bodegas
    ADD CONSTRAINT bodegas_codigo_key UNIQUE (codigo);


--
-- Name: bodegas bodegas_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bodegas
    ADD CONSTRAINT bodegas_pkey PRIMARY KEY (id);


--
-- Name: encargados encargados_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.encargados
    ADD CONSTRAINT encargados_pkey PRIMARY KEY (id);


--
-- Name: encargados encargados_run_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.encargados
    ADD CONSTRAINT encargados_run_key UNIQUE (run);


--
-- Name: bodega_encargado unique_relacion; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bodega_encargado
    ADD CONSTRAINT unique_relacion UNIQUE (bodega_id, encargado_id);


--
-- Name: bodega_encargado fk_bodega; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bodega_encargado
    ADD CONSTRAINT fk_bodega FOREIGN KEY (bodega_id) REFERENCES public.bodegas(id) ON DELETE CASCADE;


--
-- Name: bodega_encargado fk_encargado; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bodega_encargado
    ADD CONSTRAINT fk_encargado FOREIGN KEY (encargado_id) REFERENCES public.encargados(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict X0BGXUgD0F2hFLizSdB5uCBopncJJEeUb4znbRo9JFjYd4WTqccYvCwI4dTI7kO

