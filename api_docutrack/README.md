# Tecnologías Utilizadas:
1. React
2. PHP (Laravel)
3. PostgreSQL

# Motivo por el que elegí estas tecnologías:
Ya tenía algo de conocimiento de React, la estructura es bastante intuitiva y además al utilizar JavaScript facilita el desarrollo y las peticiones al API.

En cuanto a PHP para la creación del API utilizando laravel, decidí utilizarlo porque es un lenguaje que utilizo todos los días y para el backend me iba a facilitar y ahorrar mucho tiempo de desarrollo. Además con laravel se simplifican algunos procesos ya que viene con la estructura definida.

Por otra parte postgreSQL, se utilizó porque era la base de datos requerida, aunque es bastante similar a lo que se maneja en otros gestores como Mysql.

# Clonar repositorio:
1. Abrir una terminal y ejecutar el siguiente comando:
   1.1 Frontend: git clone https://github.com/Fernandoch11/docutrack.git
   1.2 Backend: git clone https://github.com/Fernandoch11/api-docutrack.git

# Frontend
2. Se deben instalar en la carpeta del Frontend:
    * npm install jspdf html2canvas
    * npm install react-hook-form

3. Para ejcutar el Frontend debemos abrir una terminal y situarnos en la carpeta donde lo clonamos, luego ejecutar el comando:
   * npm run dev

# Backend
1. Se debe instalar JWT para la autenticación por Token:
    * composer require tymon/jwt-auth

2. Para migrar las tablas a la base de datos se debe ejecutar:
    * php artisan migrate

3. Luego de ejecutar la migración se debe ejecutar el siguiente comando:
    * php artisan migrate --seed
    
    Este seeder lo que hace es insertar un usuario admin por defecto a la base de datos, las credenciales de acceso son:
    usuario: admin@gmail.com
    password: 123456

4. En config/cors.php se debe verificar que el parametro 'allowed_origins' tenga la url con el puerto desde donde se hacen las peticiones al API ya que si no se registra lo bloquea.

5. Para ejcutar el API debemos abrir una terminal y situarnos en la carpeta donde lo clonamos, luego ejecutar el comando:
   * php artisan serve

# Comentarios (Decisiones)
1. Se desarrollaron todos los puntos
2. Se agregaron funcionalidades como:
  2.1 desde el admin al solicitar corrección de la solicitud se puede enviar un comentario para que el usuario sepa que debe corregir
  2.2 desde la interfaz de usuarios con rol USER, si la solicitud está en status corregir, muestra la opción de editar la solicitud y volver a enviar al admin.
3. Los repositorios del Frontend y Backend se hicieron por separado para mejor organización.