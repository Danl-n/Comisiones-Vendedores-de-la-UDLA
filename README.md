# Comisiones Vendedores de la UDLA

Aplicación en **Laravel 12** con el patrón **MVC** que calcula las comisiones de los vendedores según un rango de fechas y unas reglas de comisión. Está basada en el ejercicio MVC de semestres pasados.

## Estructura MVC

- **Modelos** (`app/Models`): `Vendedor`, `Venta` y `Regla`. Un vendedor tiene muchas ventas (`hasMany`) y cada venta pertenece a un vendedor (`belongsTo`).
- **Controlador** (`app/Http/Controllers/ComisionController.php`):
  - `index()`: muestra el formulario, el listado de vendedores y las reglas.
  - `calcular()`: valida las fechas, obtiene las ventas del rango y a cada venta le aplica la regla con el mayor umbral que sea menor o igual al monto. Después suma las comisiones por vendedor.
- **Vistas** (`resources/views`): un layout base y la vista `comisiones/index.blade.php` con Tailwind CSS (CDN).
- **Rutas** (`routes/web.php`): `GET /comisiones` y `POST /comisiones`.
- **Base de datos**: migraciones para `vendedores`, `ventas` y `reglas`, y seeders con datos de ejemplo.

## Reglas de comisión

| Umbral monto | Porcentaje |
|---|---|
| $0 | 0% |
| $500 | 5% |
| $600 | 6% |
| $800 | 10% |
| $1000 | 15% |

## Ejecutar localmente con Docker

```bash
docker build -t comisiones-udla .
docker run -p 8080:8000 comisiones-udla
```

Luego abrir http://localhost:8080

Al arrancar, el contenedor crea la base SQLite y ejecuta las migraciones y los seeders (`docker-entrypoint.sh`).

## Despliegue

Desplegado en **Render** como Web Service con Docker.

- URL: _(pegar aquí la URL de Render)_
- Video explicativo: _(pegar aquí el link del video)_

## Uso

1. Ingresar la fecha de inicio y la fecha de fin (los datos de ejemplo son de septiembre de 2026).
2. Hacer clic en **Filtrar y Calcular**.
3. Ver la comisión total por vendedor dentro del rango.
