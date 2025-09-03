# 🚀 laravel-saas-starter

Este es un **starter kit** para proyectos en **Laravel 12** diseñado para la arquitectura de **multitenencia con bases de datos separadas**, ideal para casos donde los datos de tus clientes deben estar completamente aislados. Si la privacidad y la no-intersección de datos son cruciales para tu aplicación, este repositorio es un punto de partida excelente. 

---

## 📦 Paquetes y Tecnologías Incluidas

Este repositorio te ofrece una base sólida con paquetes que agilizarán tu desarrollo. Puedes explorarlos, modificarlos o reemplazarlos según tus necesidades:

* **Tenancy for Laravel**: El núcleo de la multitenencia. Utiliza bases de datos diferentes para cada tenant, garantizando la separación total de los datos. Te recomendamos encarecidamente revisar la documentación, especialmente la sección sobre las dos aplicaciones: una para la aplicación principal (central) y otra para los inquilinos (tenants).
* **Formularios y tablas de Filament PHP 4**: Herramienta poderosa para construir paneles de administración, tablas y formularios de manera rápida y elegante.
* **Laravel Permission (Spatie)**: Un paquete robusto para gestionar roles y permisos, fundamental para controlar el acceso de los usuarios a las funcionalidades de tu aplicación.
* **Livewire & Livewire Flux**: Se utiliza como el frontend de la aplicación, permitiendo una experiencia de usuario dinámica y reactiva sin necesidad de escribir JavaScript complejo.
* **Laravel Routingkit (Francisco Paz)**: Un paquete que facilita la definición y la visualización de rutas, optimizando el flujo para el usuario final.

---

## 🛠️ Requisitos de Instalación

Antes de empezar, asegúrate de tener instalados los siguientes componentes:

* **PHP 8.2 o superior**
* **Composer**
* **Node.js**
* **Redis Server**: Es **indispensable** para el funcionamiento del login centralizado. Si no lo tienes, puedes instalarlo y configurarlo en tu sistema.

---

## ⚙️ Pasos de Instalación Detallados

Sigue estos pasos para poner en marcha el proyecto:

### 1. Clonar el Repositorio e Instalar Dependencias

Abre tu terminal y ejecuta los siguientes comandos:

\`\`\`bash
git clone https://github.com/franciscopazf/laravel-saas-starter
cd laravel-saas-starter
composer install
npm install
npm run build
\`\`\`

> 💡 Para producción, puedes usar \`npm run build\` en lugar de \`npm run dev\`.

### 2. Configurar el Entorno Local (Archivos Hosts)

Para que la multitenencia por subdominio funcione correctamente en tu entorno local, necesitas editar tu archivo de hosts.

* **En Linux o macOS**:
    \`\`\`bash
    sudo nano /etc/hosts
    \`\`\`
* **En Windows**: Edita el archivo en \`C:\\Windows\\System32\\drivers\\etc\\hosts\` como administrador.

Agrega las siguientes líneas:

\`\`\`
127.0.0.1 devapp.local
127.0.0.1 comunidad1.devapp.local
127.0.0.1 jacalito.devapp.local
\`\`\`

> ⚠️ Estos son ejemplos. \`devapp.local\` es el dominio principal y \`comunidad1.devapp.local\` y \`jacalito.devapp.local\` son los subdominios que actúan como tenants. Puedes cambiar sus nombres si lo deseas, pero asegúrate de mantener la estructura de subdominio.

### 3. Configurar WorkOS (Autenticación)

Este starter kit utiliza **WorkOS** para la autenticación centralizada.


* **Regístrate en WorkOS**: Crea una cuenta en la plataforma.
* **Obtén tus credenciales**: Una vez registrado, ve a tu panel de control de WorkOS para encontrar tu **Client ID** y **API Key**.
* **Actualiza el archivo \`.env\`**: Copia tus credenciales en el archivo \`.env\` de tu proyecto:
    \`\`\`
    WORKOS_CLIENT_ID=tu_client_id_de_workos
    WORKOS_API_KEY=tu_api_key_de_workos
    \`\`\`
* **Configura la URL de redirección**: En tu panel de WorkOS, configura la URL de redirección (Redirect URI) a \`http://devapp.local:8000/authenticate\`. Esta URL es a la que WorkOS redirigirá al usuario después de la autenticación.

### 4. Configurar el Correo Electrónico del Administrador

En el archivo \`.env\`, establece tu dirección de correo electrónico para el administrador:

\`\`\`
MAIL_ADMIN_ADDRESS=tu_correo_de_administrador@gmail.com
\`\`\`

### 5. Ejecutar Migraciones y Sincronizar Permisos

Ahora, es momento de preparar la base de datos y los permisos del sistema.

\`\`\`bash
php artisan migrate --seed
\`\`\`
> Este comando ejecuta las migraciones para crear las tablas necesarias y siembra la base de datos con datos de prueba, incluyendo el usuario administrador y los roles iniciales.

A continuación, sincroniza los permisos con el paquete de Laravel Routingkit:

\`\`\`bash
php artisan rk:ac
\`\`\`
> Este comando te pedirá confirmación; simplemente escribe \`yes\` y presiona **Enter**.

### 6. Iniciar el Servidor Local

Finalmente, inicia el servidor de Laravel para ver tu aplicación en acción:

\`\`\`bash
php artisan serve
\`\`\`

Tu aplicación debería estar disponible en tu navegador en \`devapp.local:8000\`.

---

## ⚠️ Consideraciones y Flujo de Usuarios

* **Conceptos Clave**: Es crucial que estés familiarizado con los conceptos de **roles y permisos** y, especialmente, la **multitenencia en bases de datos múltiples**. El starter kit asume que tienes un conocimiento básico de estos temas.
* **Flujo de Autenticación**: El sistema está diseñado para un **login centralizado** que redirecciona a los usuarios a sus respectivos tenants basándose en reglas.
* **Dominio y Subdominio**: Actualmente, el login y las cookies funcionan a través de subdominios (\`tenant.devapp.local\`). **No se comparten cookies entre dominios completamente diferentes** (ej. \`dominio1.com\` y \`dominio2.com\`). Si tu proyecto necesita esta funcionalidad, deberás modificar la configuración o implementar sistemas de login separados.
* **Identificación del Tenant**: El kit soporta la identificación de tenants por **subdominio** y **path**. La configuración actual está optimizada para subdominios debido a la forma en que se manejan las cookies. Si necesitas cambiar la forma de identificar a los inquilinos, la documentación de **Tenancy for Laravel** es tu mejor guía.


¡Esperamos que este starter kit te sea de gran utilidad para iniciar tu proyecto SaaS! ¡Feliz desarrollo! 🚀


puede  leer mas sobre el paquete laravel routing-kit en 
[Laravel Routingkit](https://github.com/franciscopazf/laravel-routingkit)
