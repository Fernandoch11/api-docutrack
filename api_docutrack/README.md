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

2. Se deben instalar en la carpeta del Frontend:
    * npm install jspdf html2canvas
    * npm install react-hook-form

3. En la carpta del Backend se debe instalar JWT para la autenticación por Token:
    * composer require tymon/jwt-auth

4. Para migrar las tablas a la base de datos se debe ejecutar:
    * php artisan migrate

