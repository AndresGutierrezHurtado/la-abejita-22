# Uniformes La Abejita

## Descripción
Uniformes La Abejita es un sitio web para ofrecer uniformes escolares de la mejor calidad. Este proyecto ha sido desarrollado utilizando Laravel, un framework PHP que facilita la creación de aplicaciones web robustas y eficientes.

## Características
- **Catálogo de uniformes:** Explora una amplia gama de uniformes escolares disponibles.
- **Carrito de compras:** Añade uniformes al carrito y realiza pedidos fácilmente.
- **Sistema de autenticación:** Registro e inicio de sesión de usuarios.
- **Panel de administración:** Gestión de productos, pedidos y usuarios.

## Requisitos
- PHP >= 7.3
- Composer
- MySQL
- Node.js & npm (para la gestión de assets)

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tuusuario/uniformes-la-abejita.git
    ```

2. Navega al directorio del proyecto:
    ```bash
    cd uniformes-la-abejita
    ```

3. Instala las dependencias de PHP:
    ```bash
    composer install
    ```

4. Copia el archivo de configuración de entorno y ajusta los valores según tu entorno:
    ```bash
    cp .env.example .env
    ```

5. Genera la clave de la aplicación:
    ```bash
    php artisan key:generate
    ```

6. Configura la base de datos en el archivo `.env` y luego migra las tablas:
    ```bash
    php artisan migrate
    ```

7. Instala las dependencias de Node.js y compila los assets:
    ```bash
    npm install
    npm run dev
    ```

8. Inicia el servidor de desarrollo:
    ```bash
    php artisan serve
    ```

## Uso
- Accede a `http://localhost:8000` en tu navegador para ver el sitio web en funcionamiento.
- Usa el panel de administración para gestionar productos, pedidos y usuarios.

## Contacto
Para cualquier consulta, puedes contactarnos a través de [laabejita22.uni@gmail.com](mailto:laabejita22.uni@gmail.com).

---

¡Gracias por utilizar Uniformes La Abejita!
