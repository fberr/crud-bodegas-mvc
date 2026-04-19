# 🏢 Sistema de Gestión de Bodegas

Aplicación web desarrollada en PHP bajo patrón **MVC**, que permite gestionar bodegas y sus encargados, utilizando una base de datos PostgreSQL.

---

## 🚀 Funcionalidades

* 📋 Listado de bodegas
* 🔍 Filtro por estado (Activadas / Desactivadas)
* ➕ Crear nueva bodega
* ✏️ Editar bodega existente
* 🗑️ Eliminar bodega (con confirmación en modal)
* 👥 Asignar múltiples encargados por bodega
* 🎯 Visualización de encargados con badges
* ⚠️ Mensajes de éxito y error (flash messages)

---

## 🧱 Tecnologías utilizadas

* PHP (MVC puro)
* PostgreSQL
* Bootstrap 5
* Font Awesome
* JavaScript (vanilla)

---

## 📁 Estructura del proyecto

```
test-tecnico-mvc/
│
├── config/
│   └── database.php
│
├── controllers/
│   └── BodegaController.php
│
├── models/
│   └── Bodega.php
│
├── views/
│   ├── index.php
│   ├── create.php
│   ├── edit.php
│   └── layout.php
│
├── js/
│   └── app.js
│
├── sql/
│   ├── schema.sql
│   ├── data.sql
│   ├── dump.sql
│
├── routes.php
├── index.php
└── README.md

```

---

## 🧠 Arquitectura

El proyecto implementa el patrón **MVC (Modelo - Vista - Controlador)**:

* **Modelo:** Manejo de datos y consultas SQL
* **Vista:** Interfaz de usuario con HTML + Bootstrap
* **Controlador:** Lógica de negocio y flujo de la aplicación

Además, se utiliza un **Front Controller (`index.php`)** para centralizar el acceso al sistema.

---

## ⚙️ Configuración

### 1. Clonar el proyecto

```bash
git clone <url-del-repositorio>
```

---

### 2. Configurar base de datos

Crear base de datos en PostgreSQL:

```sql
CREATE DATABASE prueba_tecnica;
```

Configurar credenciales en:

```
config/database.php
```

👉 Se recomienda importar en la bd creada:

schema.sql (estructura)
data.sql (datos iniciales)

antes de ejecutar el proyecto.

---

### 3. Ejecutar proyecto

Abrir en navegador:

```
http://localhost:8888/test-tecnico-mvc/
```

---

## 🗄️ Base de datos

El sistema utiliza:

* Tabla `bodegas`
* Tabla `encargados`
* Tabla intermedia `bodega_encargado` (relación muchos a muchos)

---

## ✨ Características destacadas

* Uso de **PDO** para conexión segura a base de datos
* Consultas preparadas (prevención de SQL Injection)
* Manejo de relaciones muchos a muchos
* Interfaz responsiva con Bootstrap
* Modal dinámico para eliminación
* Código organizado y documentado
