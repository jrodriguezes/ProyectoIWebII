Nombre: Aventones
Hecho por: Jeremy Rodriguez y Miguel Cruz

Descripcion general del proyecto:
    Crear la estructira basica de un servidor web con un sitio en para para crear rides y que las de mas puedan pedir estos rides.
    Dentro de este se pueden crear vehiculos asosiados a los rides.
    A su vez estos rides se asocian a las resvaciones para saber quien a solicitado cual ride.
    Y tanto el ride como el vehiclo se ve asociado a al usuario que sea resgitrado y vinculado con el token que se ha mandado por correo.
    Cadad usurio se ve encargado de resgistar sus propia infromacion como sus datos persoanles, los vehiculos y lor rides que tiene para ofrecer a la comunidad de personas que utilicen el sitio aventones.

    Este proyecto esta hecho con php puro (sin un framework MVC) haciendo uso

    Composer solo para PHPMailer (envío de correos).
    Tailwind + Flowbite + DaisyUI en el frontend.
    Enrutamiento manual en public/index.php.
    Sistema de sesión propio (src/config/session.php).
    Script de consola para notificar reservas pendientes a; driver.


Estructura del proyecto:
    ProyectoIWebII/
        public/               ← raíz pública (index.php, assets, uploads)
        src/
            config/             ← db.php, mailer.php, session.php
            controllers/        ← UserController.php, RideController.php, ...
            actions/          ← insertUser.php, insertRide.php, AcceptReservation.php...
            models/             ← UserModel.php, RideModel.php, ReservationModel.php...
            services/           ← EmailService.php, UploadService.php, VerificationService.php
            views/              ← login.php, user-register.php, booking.php, layouts/...
            scripts/            ← notify_pending_reservations.php
        vendor/               ← (se genera con composer install)
        composer.json
        package.json
        tailwind.config.js

Dependencias y librerias 
    Dependecias de php (composer.json):
        {
            "require": {
                "phpmailer/phpmailer": "^7.0"
            }
        }

    PHPMailer (phpmailer/phpmailer)
        Esta es la depencia es para mandar correos por lo que es importante en:
        La verificacion de la cuenta y a la en el script para recordar que hay una reservacion pendiente 
        (El proyecto necesita hacer el composer install para ser usado)

    Dependencias de Node / Frontend
    {
        "devDependencies": {
            "@tailwindcss/forms": "^0.5.10",
            "autoprefixer": "^10.4.21",
            "daisyui": "^5.3.3",
            "flowbite": "^3.1.2",
            "postcss": "^8.5.6",
            "tailwindcss": "^3.4.18"
        },
        "dependencies": {
            "simple-datatables": "^10.2.0"
        },
        "scripts": {
            "build": "tailwindcss -i ./src/input.css -o ./public/assets/css/tailwind.css",
            "watch": "tailwindcss -i ./src/input.css -o ./public/assets/css/tailwind.css --watch"
        }
    }
    

    Tailwind CSS
        tailwind.config.js
            module.exports = {
                darkMode: "class",
                content: [
                    "./public/**/*.{php,html,js}",
                    "./src/**/*.{php,html,js}",
                    "./node_modules/flowbite/**/*.js",
                ],
                theme: { extend: {} },
            };

    Para generar las clases utilitarias usadas en las vistas.

    Plugins de Tailwind
        tailwind.config.js
            plugins: [
                require("@tailwindcss/forms"),
                require("daisyui"),
                require("flowbite/plugin"),
            ],

        @tailwindcss/forms: hace que inputs, selects y forms se vean bien sin mucho CSS.
        daisyUI: biblioteca de componentes sobre Tailwind (botones, cards, alerts).
        flowbite: otra librería de componentes (sobre todo con JS: modals, dropdowns).
        Esto está alineado con el enunciado que pide “buenas prácticas HTML/CSS”.

    Scripts NPM 
        npm install
        npm run build 

        Esto para que se cargue el css y las vistas del proyecto 

Configuración del sistema:
    db.php
        $servername = "localhost";
        $username   = "root";
        $password   = "";
        $dbname     = "Aventones01";

    esto es para la coneccion con la base de datos de manera que se pueda ingresar a ella

Sesiones:
    src/config/session.php
        inicia la sesión solo si no está iniciada,
        pone la cookie como httponly y samesite=Lax,
        marca secure si la app está en HTTPS.

        La aplicación maneja la sesión de forma segura para mitigar XSS/CSRF
       
Correo
    src/config/mailer.php       
        SMTP Gmail
        usuario: noreplyaventones@gmail.com
        esto debe moverse a variables de entorno en producción

Proceso de Registro:
    Entra al sition que abre el index que hace un render del login en caso de que la sesion del navegador no este abiernta,
    En el login en footer tenemos el link para el register se le hacer clink,
    Se hace un render del register donde estan los datos para ser llenados en la parte de arriba tenemos el toggle para selecione si es un pasajero o es un driver,
    Al hacer submit redirije al proxy que hace una separacion del dato de post accion con eL '_' para entrar a un map que tiene la direcion de todos los controllers que hace un require de la direcion dependiendo de la entidad,
    Una vez en el controller se vulve a poner el post action una variable para saber su valor y por consecuente que accione en el controller vamos a llvar a cabo en este caso es "register_user" que hacer un include de insertUser.php en accion 
    en el archivo insertUser se pone todos los datos que se van a insertar en variables se crea un hash del password con la funcion para encriptar la contrasena y tambien genera los datos de verificacion con una funcion que los crea para luego llamar una funcion que esta en el model que a subes tiene un require de config/db.php para poder conectar con la base de datos luego de registar 
    una ves registrado se manda el email para hacer la verificacion que esta tiene un link al proyecto que al ingresar a este manda al index que este hace que entre en el verificar email que con la fincion de verficar en caso de que todo este bien verifica el usuarion haciendo un update en la base de datos de este usuario con una consulta sql en la funcion


Gestión de Vehículos
    Una ves ingresado al home este hay que ingrsear en el boton new vehicle para poner los datos del vehiculo que como en la explicacion anterio manda un datos en post con la llave action en este caso es un register_vehicle manda al proxy y llega al mapa que manda al controller de vehiclos este manda a la accion que inserta con la funcion del model en la base de datos

    Para el modificar y elimiminar lo que se crea es data-model-target data-modal-toggle que grandes rasgos lo que haces decir y controlar que ventana salta para que sea visible y cual se cierra y el from de este estan los datos para modificar que es la misma explicacion pero en este form el input de tipo hidden es "modify_vechicle" es lo proxy controler accion model

    lo mismo para el eliminar que el input hidden es delete_vehicle y lo que hace en la base de datos es ponerla en inactiva

Gestión de Rides:
    En esta gestion podemos resumir que es lo mismo que la anterior pero los input hiden son insert_vehicle, midify_vehicle y delete_vehicle  
    

Búsqueda de Rides:
    La busqueda de rides se obtiene mediante el modelo rides, alli se encuentra la consulta en function llamada getAllRides, la cual ordena los rides del mas reciente al mas viejo de forma descendiente. Esta funcion se llama en home la cual alli se utiliza para mostrar los datos encontrados en una tabla de flowbite. El sort de la tabla funciona mediante un .js la cual por defecto lo traia la tabla en la pagina oficial de flowbite https://flowbite.com/docs/plugins/datatables/#sorting-data.

    
Reservas:
    La informacion de secarga en una arrays que vienen desde los models y por medio de los de foreach en la vista con las llaves del array que muestra en la tabla

    En la reservas despues de en la busqueda de rides y hacer la resevacion en el booking va a salir la peticion del ride
    para el pasajero lo que le va a salir es la accion de cancerlar que dentro del form va con el input hidden cancel_reservation
    que hace el mismo proseso proxy controler accion model

    Y en caso de que sea conductor va a salir las acciones accept reject cancel y el input de cada form es accept_reservation,reject_reservation, cancel_reservation que sigue el mismo paratron proxy controller accion model y estaccion se en en table de manera inmediata 

Tablas de la base de datos:

    CREATE TABLE users (
        id INT PRIMARY KEY NOT NULL,            
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        birth_date DATE NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone_number VARCHAR(20) NOT NULL,
        profile_photo VARCHAR(255) DEFAULT NULL,
        password VARCHAR(255) NOT NULL,
        user_type VARCHAR(40) NOT NULL,
        status ENUM('active','inactive','pending') DEFAULT 'pending',
        email_verified_at DATETIME NULL,
        verify_token_hash CHAR(64) NULL UNIQUE,
        verify_token_expires_at DATETIME NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (verify_token_hash)
    );


    CREATE TABLE vehicles (
        plate_id VARCHAR(7) PRIMARY KEY,
        driver_id CHAR(11) NOT NULL,
        color VARCHAR(30) NOT NULL,
        brand VARCHAR(30) NOT NULL,
        model VARCHAR(40) NOT NULL,
        year YEAR(4) NOT NULL,
        seats INT(11) NOT NULL,
        vehicle_picture VARCHAR(255),
        status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    create table rides(
        id INT PRIMARY KEY AUTO_INCREMENT,
        driver_id INT NOT NULL,
        vehicle_plate VARCHAR(7) NOT NULL,
        
        name VARCHAR(80) NOT NULL,
        origin VARCHAR(120) NOT NULL,
        destination VARCHAR(120) NOT NULL,
        
        departure_date datetime not null,
        
        price_per_seat DECIMAL(10,2) NOT NULL,
        seats_offered INT NOT NULL,
        
        status ENUM('active','inactive','cancelled','completed') DEFAULT 'active',
        
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
        
        INDEX (driver_id),
        INDEX (vehicle_plate),
        FOREIGN KEY (driver_id) REFERENCES users(id),
        FOREIGN KEY (vehicle_plate) REFERENCES vehicles(plate_id)
    );

    create table reservations(
        id INT PRIMARY KEY AUTO_INCREMENT,
        
        ride_id INT NOT NULL,              -- a qué ride pertenece la reserva
        passenger_id INT NOT NULL,         -- quién está reservando (usuario pasajero)
        
        status ENUM(
            'pending',     -- creada por el pasajero, espera decisión del chofer
            'accepted',    -- chofer la aceptó
            'rejected',    -- chofer la rechazó
            'cancelled'    -- pasajero o chofer la canceló después
        ) NOT NULL DEFAULT 'pending',
        
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
        
        INDEX (ride_id),
        INDEX (passenger_id),
        INDEX (status),

        CONSTRAINT fk_reservation_ride
            FOREIGN KEY (ride_id) REFERENCES rides(id)
            ON DELETE CASCADE,

        CONSTRAINT fk_reservation_passenger
            FOREIGN KEY (passenger_id) REFERENCES users(id)
            ON DELETE CASCADE,

        -- evita que el mismo pasajero mande 20 reservas pendientes al mismo ride
        CONSTRAINT uq_ride_passenger_status_pending
            UNIQUE (ride_id, passenger_id, status)

    );



tabla flowbite search rides
npm install simple-datatables --save
