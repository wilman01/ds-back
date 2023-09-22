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

- Mostrar Marcas (GET)

Devuelve una marca de vehículo que sea consultada por un id.
~~~
/api/brand/{id}
~~~

#### Nota
El módulo de marcas tambien tiene a la disposición rutas para actualizar y crear marcas, sin embargo estas rutas no son requeridas por el front-end actualmente.

### Módulo de Modelos de Vehículos

- Listar Modelos (GET)

Devuelve una lista páginada de los modelos que pertenecen a una marca de un vehículo.

Para obtener la lista de modelos se debe indicar por parámetro el id de la marca y el año que se desea consultar.

~~~
/api/vehimodel

obligatorio {brand_id} = id de la marca
obligatorio {year_id} = id del año

~~~

- Mostrar Modelo (GET)

Consulte un modelo si conociendo su id

~~~
/api/vehimodel/{id}

~~~

#### Nota 
El módulo modelos tambien tiene a disposicion rutas para crear y actualizar, sin embargo estas no son requeridas por el front-end actualmente.

### Módulo de Versión Vehículos

- Listar Versiones (GET)

Devuelve una lista páginada de la version del vehiculo.

Para obtener la lista de debe indicar por parámetro el id del modelo y el año que se desea consultar.

~~~
/api/vehiversion

obligatorio {vehi_model_id} = id del modelo
obligatorio {year_id} = id del año

~~~


- Mostrar Versión (GET)

Consultar la version de un vehículo conociendo el id

~~~
/api/vehiversion/{id}
~~~

### Módulo de Proveedores
Los Proveedores son las distintas aseguradoras que ofrecen las pólizas de seguro en el sistema.

- Crear Proveedores (POST)

Permite registrar los datos de un proveedor. Este registro es obligatorio antes de intentar registrar alguna póliza.

~~~
/api/provider

name:{string}
rif:{string|^[JGVE][-][0-9]{8}[-][0-9]$|unique:providers}
contact:{string}
email:{string|email}
phone:{string}
~~~

- Listar Proveedores (GET)

Devuelve una lista páginada de los proveedores

~~~
/api/provider

opcional {q} = variable para hacer busquedas
~~~

- Actualizar Proveedor (PUT)

Permite actualizar los datos del registro de un proveedor.
~~~
/api/provider/{id}

name:{string|unique:providers}
rif:{string|^[JGVE][-][0-9]{8}[-][0-9]$|unique:providers}
contact:{string}
email:{string|email}
phone:{string}
~~~

### Módulo de Pólizas
Póliza se entiende como los datos del contrato de los distintos planes ofrecidos por los proveedores para asegurar a un cliente.

Funcionalidad que permite gestionar la información de las Pólizas que ofrecen los Proveedores. Por lo tanto Póliza depende de Proveedores. Por ahora solo se registraran Pólizas de Salud hasta que se tenga claro la comunicación del sistema con las interfaces de vehículos de los Proveedores.

Habrá un registro fijo en la BD el cual servirá para la relación en BD cuando exista una cotización de Seguro para Vehículo.

###### Restricciones:

El campo name debe ser único.

Debe existir un proveedor quien para relacionar la póliza

Debe existir un tipo con el cual relacionar la póliza

Todos los campos son obligatorios.

Todos los métodos están protegidos por Token excepto  show para que pueda accederse desde la interfaz del cliente.

- Crear Póliza (POST)


  Permite registrar los datos de la Póliza. Debe existir tipo y el poveedor.

~~~
/api/policy

type_id: {int}
provider_id {int}
name:{string}
amount:{double}
coverage: {double}
description:{string}
~~~

- Listar Pólizas (GET)
Devuelve una lista páginada de las pólizas.

~~~
/api/policy

opcional {q} = variable para hacer busquedas.
~~~


- Mostrar póliza (GET)

Devuelve el registro de una póliza conociendo su id.

~~~
api/policy/{id}

~~~

- Actualizar Póliza (PUT)

Permite actualizar los datos del registro de la póliza.
~~~
/api/policy/{id}

type_id: {int}
provider_id {int}
name:{string}
amount:{double}
coverage: {double}
description:{string}
~~~

### Módulo de Tipo de Pólizas

Tipo se entiende como una clasificación tanto para las cotizaciones como para las pólizas

Funcionalidad que permite gestionar un parámetro para clasificar las Cotizaciones y las Pólizas.

Habrá un registro fijo en la BD el cual servirá para la relación en BD cuando exista una cotización de Seguro para Vehículo.

###### Restricciones:

El campo name se refiere al identificador del tipo, debe ser único y es obligatorio.

Existe un método adicional al Crud (withPolicies) que permite obtener el tipo con las palizas relacionadas.

Todos los métodos están protegidos por Token.

- Crear Tipos (POST)

  Permite registrar un tipo. Solo posee un campo y debe ser único.

~~~
/api/type

name: {string|unique:types}

~~~

- Listar Tipos (GET)

Devuelve una lista páginada de los tipos
~~~
api/type

opcional {q} = variable para hacer busquedas.

~~~


- Mostrar Tipo (GET)

Devuelve un tipo conociendo su id.

~~~
api/type/{id}

~~~

- Actualizar Tipo (PUT)

Permite actualizar los datos del registro de las pólizas.

~~~
/api/type/{id}

name: {string|unique:types}

~~~

- Obtener Tipo con Pólizas (GET)

Puede requerir una lista de las pólizas que pertenecen a un tipo enviando el nombre del tipo.

~~~
/api/type-policy/{string}

string es el nombre del tipo de póliza.
~~~

### Módulo de Clientes

Los métodos guardar y mostrar están exceptos de Token

- Crear un Cliente (POST)

Registra los datos de un cliente y guarda en la base de datos una notificación la cual se esta haciendo por ahora a los usuarios con rol de administrador hasta que se defina el rol de usuario que recibirá dicha notificación.

~~~
/api/customer

cedula:{string}
name:{string}
last_name:{string}
email:{string|email}
phone:{string}
birthdate:{date|nullable}
~~~

- Listar Clientes (GET)

Devuelve una lista páginada de los clientes registrados en el sistema.

~~~
api/customer

opcional {q} = variable para hacer busquedas.
~~~

- Mostrar Cliente (GET)

Devuelve el registro de un cliente conociendo su id.

~~~
api/customer/{id}

~~~

- Actualizar Clientes (PUT)

Permite actualizar los datos del registro de los clientes.

~~~
/api/customer/{id}

cedula:{string}
name:{string}
last_name:{string}
email:{string|email}
phone:{string}
birthdate:{date|nullable}

~~~

### Módulo de Cotizaciones
La cotización es la solicitud del detalle de una Póliza específica elegida por un cliente.

Este módulo permite gestionar tanto las cotizaciones de salud como de vehículos. (Por ahora solo vehículo)

Los métodos guardar y mostrar están exceptos de Token.

- Guardar Cotización (POST)

Registra los datos de una cotización y guarda en la base de datos una notificación la cual se está haciendo por ahora a los usuarios con rol de administrador hasta que se defina el rol de usuario que recibirá dicha notificación.

~~~
/api/quotation

type_id:{int}
supplier:{string}
customer_id:{int}
policy:{json}
~~~

- Listar Cotizaciones (GET)

Devuelve una lista páginada de las cotizaciones registradas en el sistema.

~~~
api/quotation

opcional {q} = variable para hacer busquedas.
~~~

- Mostrar Cotización (GET)

Devuelve el registro de un cliente conociendo su id.

~~~
api/quotation/{id}

~~~

- Actualizar Cotización (PUT)

Permite actualizar los datos del registro de una cotización.

~~~
api/quotation/{id}

type_id:{int}
supplier:{string}
policy:{json}
~~~

###### Desarrollado por:
Ing. Rafael Velásquez | rafahel171@gmail.com
