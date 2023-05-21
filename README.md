
# Proyecto de Gestión de Inventario

Este proyecto es un software diseñado para almacenar y gestionar el inventario de productos Proporciona funcionalidades como la creación, edición y eliminación de productos, así como la lista de todos los productos registrados en el sistema. Además, cuenta con un módulo de ventas que permite realizar la venta de productos y actualizar automáticamente el stock.

## Características

- Creación de productos: Permite agregar nuevos productos al inventario especificando su nombre, referencia, precio, peso, categoría, stock y fecha de creación.
- Edición de productos: Permite modificar los datos de un producto existente, como su nombre, precio, peso, categoría y stock.
- Eliminación de productos: Permite eliminar un producto del inventario.
- Listado de productos: Muestra la lista completa de productos registrados en el sistema, incluyendo sus detalles como nombre, referencia, precio, peso, categoría y stock.
- Módulo de ventas: Permite realizar la venta de un producto especificando su ID y la cantidad vendida. Actualiza automáticamente el stock y registra la venta en una tabla.

## Requisitos

- Lenguaje de programación: PHP (versión 7.0 o superior).
- Motor de base de datos: MySQL (versión 5.6 o superior).
- Servidor web (por ejemplo, Apache) configurado.

## Instalación

1. Clona el repositorio en tu máquina local o servidor web:


git clone <URL del repositorio>


2. Crea la base de datos en MySQL utilizando el archivo `inventario.sql` proporcionado. Importa el archivo a través de la interfaz de administración de MySQL o mediante la línea de comandos.

3. Configura la conexión a la base de datos:
   - Abre el archivo `conexion.php`.
   - Modifica los valores de `DB_HOST`, `DB_USER`, `DB_PASSWORD` y `DB_NAME` para que coincidan con la configuración de tu servidor MySQL.

4. Configura el servidor web para que apunte a la carpeta raíz del proyecto.

5. Accede al proyecto a través de tu navegador web utilizando la URL correspondiente.


## Contribución

Si deseas contribuir al proyecto, puedes realizar los siguientes pasos:

1. Haz un fork del repositorio en tu cuenta de GitHub.
2. Realiza tus cambios en tu propia rama.
3. Envía un pull request indicando los cambios que has realizado.

## Autor

Angel Jorge Salazar


