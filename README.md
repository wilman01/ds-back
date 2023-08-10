## Despertar Seguros

<p align="center">
<img src="https://img.shields.io/badge/PHP-Laravel-red">
<img src="https://img.shields.io/badge/API-REST_FULL-green
">
<img src="https://img.shields.io/badge/Git%20Hub-private-yellow
">
</p>

## Acerca de:

Esta aplicación esta construida para ofrecer una serie de servicios mediante llamadas HTTP que permiten procesar y obtener datos para el sistema de cotizaciones de las pólizas de Despertar Seguros:

### Versión 1.0

## Autenticación
<p>La aplicación ofrece rutas publicas que serán utilizadas por los clientes desde la página web para solicitar las cotizaciones. Igualmente existen rutas de Administrador las cuales requieren un token válido generado por ésta Api el cual tendrá un TTL (time to live) de dos horas que serán asignados a un usuario registrado en el sistema.</p>
<p>Esta información sera indicada más adelante en cada una de las rutas</p>

## Api Referencias

### Tipo de Aplicación

application/json

### Ruta Ráiz servidor de prueba
[http://ec2-54-91-207-60.compute-1.amazonaws.com/api](#)

### Generalidades de las respuestas

La Api responde en formato json basado en una forma reducida de la especificación json:api según [www.jsonapi.org](https://jsonapi.org/)
Esta especificación construye un objeto json formateado como el siguiente ejemplo:

{ 

    "data"{
        ...
        }

    "links"{
        ...
    }
    "meta"{
        (paginacion)
    }
}

## Rutas Http

### Módulo de Usuarios 

- Login (POST) *no token*

Autentica a un usuario  en el sistema
~~~ 
  /auth/login
  
  email:{string}
  password:{string}
~~~

- Registro de Usuario (POST)

Permite que se cree un usuario y se le asigne un rol en el sistema.
~~~
/auth/register

cedula:{string}
name:{string}
last_name:{string}
password:{string}
password_confirmation{string|equals:password}
email:{string|email}
role:{string|exists:role}
~~~

- Lista de Usuarios (GET)

Genera una lista páginada de los usuarios del sistema.
~~~
/auth/user
~~~

- Obtener Usuario logueado (POST)

Devuelve el registro del usuario logueado
~~~
/auth/user
~~~

- Actualizar Usuario (PUT)

Permite actualizar los datos del registro de un usuario.
~~~
/auth/user/{id}

cedula:{string}
name:{string}
last_name:{string}
password:{string}
password_confirmation{string|equals:password}
email:{string|email}
role:{string|exists:role}
~~~

### Módulo de Años

- Listar Años (GET)
~~~
/api/year/{id}?q='string'

opcional {q} = variable para hacer busquedas

~~~

### Módulo de Marcas de Vehículos

- Listar Marcas (GET)
Devuelve una lista páginada de las marcas de un vehículo. Pude solicitar las marcas de un año especifico enviando el id de un año registrado en el sistema.
~~~
/api/brand?q={string}&year_id={id}

opcional {q} = variable para hacer busquedas
opcional {year_id} = id de un año registrado
~~~

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

#### Desarrollado por
Ing. Rafael Velásquez | rafahel171@gmail.com
