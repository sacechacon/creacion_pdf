# Proyecto Generar PDF

## Dependencias:
1. MySQL.
2. PHP.
3. LibreOffice.
4. Composer.
5. PHPOffice/PHPSpreadsheet.
6. PHPOffice/PHPWord.
7. PHP ZipArchive.

## Manual de Instalación:

1. **Proyecto Genera PDF**:
    1. Por ahora, se encuentra en el siguiente repositorio:
        1. *https://github.com/miguelmiguel/genera_pdf*

2. **Instalación de Composer**, que es un manejador de dependencias, para librerías de PHP.
    1. En Linux: Ejecutar los siguientes comandos desde el terminal, en el directorio donde descargó el proyecto, desde github:
    ```sh
        php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
        php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
        php composer-setup.php
        php -r "unlink('composer-setup.php');"
    ```
    2. En Windows: Descargar el instalador de Composer del sitio web *https://getcomposer.org/doc/00-intro.md* 
        1. *https://getcomposer.org/Composer-Setup.exe* esta es la ruta directa al ejecutable.
        2. Ejecutar el archivo descargado.
        3. Cerrar el terminal de Windows, si está abierto, y abrirlo de nuevo para poder ejecutar el comando *‘composer’* desde el mismo. 

3. **Instalación de PHP Spreadsheet**: se puede encontrar información de esta librería en las siguientes direcciones: *https://github.com/PHPOffice/PhpSpreadsheet* y *https://phpspreadsheet.readthedocs.io/en/develop/* 
    1. En Linux: Luego de tener instalado composer en el directorio donde se instaló el proyecto, se debe ejecutar el siguiente comando:
    ```sh
        php composer.phar require phpoffice/phpspreadsheet
    ```
    2. En Windows: Luego de instalar composer, ir en el terminal, a la carpeta del nuevo proyecto y ejecutar el siguiente comando:
    ```sh
        composer require phpoffice/phpspreadsheet
    ```

4. **Instalación de PHP Word**: se puede encontrar información de esta librería en las siguientes direcciones: *https://github.com/PHPOffice/PHPWord* y *https://phpword.readthedocs.io/en/latest/*
    1. **En Linux**: Luego de tener instalado composer en el directorio donde se instaló el proyecto, se debe ejecutar el siguiente comando:

    ```sh
        php composer.phar require phpoffice/phpword
    ``` 

    2. **En Windows**: Luego de instalar composer, ir en el terminal, a la carpeta del nuevo proyecto y ejecutar el siguiente comando:
    ```sh
        composer require phpoffice/phpword
    ```

5. **PHP ZipArchive**:
    1. **En Linux**: Desde el terminal, ejecutar el siguiente comando:
        1. **Ubuntu/Debian**:
        ```sh
            sudo yum install php-zip
        ```
           
        ```sh
            sudo apt-get install php7.0-zip
        ```
           
        ```sh
            sudo apt-get install php5.6-zip
        ```
        
        Esto, dependiendo de la versión de PHP. 
        
        2. **Fedora/CentOS**: 
        ```sh
            sudo yum install php-zip
        ```
           
        ```sh
            sudo yum install php7.0-zip
        ```
           
        ```sh
            sudo yum install php5.6-zip
        ```
        
        Esto, dependiendo de la versión de PHP. 
        
    2. **En Windows**: Desde PHP 5.3, esta librería se encuentra presente en la instalación oficial de PHP para Windows.

6. **Instalación de LibreOffice**:
    1. **En Linux**: Desde el terminal, ejecutar el siguiente comando: 
        1. Debian/Ubuntu: 
        ```sh
            sudo apt-get install libreoffice –no-install-recommends
        ```
        
        Ésto si se instala en un servidor y/o no se quiere utilizar la interfaz gráfica de LibreOffice.
        
        2. CentOS/Fedora:  
        ```sh
            sudo yum install libreoffice –no-install-recommends
        ```
        
        Ésto si se instala en un servidor y/o no se quiere utilizar la interfaz gráfica de LibreOffice.
        
    2. En Windows: Descargar el ejecutable instalador de LibreOffice de la siguiente dirección:
        1. *https://es.libreoffice.org/descarga/libreoffice* 

7. **MySQL**:
    1. Al obtener el proyecto desde el repositorio, en el mismo directorio donde se crea, se encontrará un script *‘db_tables.sql’* que tiene los comandos para crear las tablas de la base de datos del proyecto.
    2. En MySQL, se debe crear una base de datos (luego se debe suministrar su nombre en el archivo de configuración, en la sección **[CONF GENERAL]**, con la etiqueta *‘base_datos_app’*).
    3. Luego, se debe ejecutar el script *‘db_tables.sql’* en la base de datos recientemente creada, y se crean las tablas necesarias para el proyecto.

8. **Archivo de configuración**:
    1. Se dejó un ejemplo de archivo de configuración en el proyecto, llamado *‘ejemplo.cnf’*. **No es recomendable usar ese archivo**, sino **crear otro que NO se guarde** en el repositorio, para no guardar contraseñas ni otra información sensible en el mismo.
    2. En el archivo de configuración, existen tres (3) secciones, y cada una tiene diferentes objetivos:
        1. **[CONF GENERAL]**: guarda la información general, necesaria para la ejecución del proyecto. Sus etiquetas son:
            1. **ruta_in**: Ubicación del directorio donde se encontrarán todos los archivos de entrada del proceso a ejecutar (plantilla en word, archivo de datos en excel, etc.).
            2. **ruta_out**: Ubicación del directorio donde se encontrarán los PDF que serán generados al ejecutar el proceso.
            3. **archivo_bd**: Nombre del archivo de datos en excel.
            4. **plantilla**: Nombre de la plantilla del documento en word.
            5. **cabecera**: Indica si el archivo de datos en excel usa la primera fila para encabezados de los nombres de las columnas (Valores posibles: **“SI”** y **“NO”**).
            6. **base_datos_app**: Nombre de la base de datos donde se registraran los resultados del proceso ejecutado.
            7. **user_db**: Usuario de la base de datos.
            8. **pass_db**: Contraseña de la base de datos.
            9. **server_db**: Servidor donde se aloja la base de datos (Usualmente, localhost).
            10. **cliente_archivo**: Cliente que se registrará en el proceso.
            11. **soffice_path**: Dirección donde se encuentra el ejecutable de LibreOffice (Sólo es necesario si el servidor donde se ejecuta el proceso es Windows).
        2. **[FORMATO_NOMBRE_PDF]**: Esta sección tiene variables que ayudarán a configurar el nombre de los archivos de salida en PDF. Para esto se definen dos tipos de variables:
            1. **fijo_X** (X es un número o letra para diferenciarlas): es un campo que no cambiará, es decir, se mantendrá el valor que se indica en el archivo de configuración. Ejemplo:
                1. fijo_1 = “dda”
                2. fijo_2 = “PROCESADO”
            2. **variable_X**: es un campo que dependerá de los datos mapeados del archivo de datos de excel. Ejemplo:
                1. variable_1 = #indice (utilizará el valor que se mapee en la sección [MAPEOS] con la etiqueta #indice)
                2. variable_2 = #nom_ddo
            3. Los valores de estos campos fijos y variables, se utilizarán para crear el nombre de los archivos, en el orden en que sean escritos en el archivo de configuración, y serán separados entre ellos por ‘_’. Ejemplo:
                1. variable_a = #apellido
                2. fijo_1 = “USUARIO”
                3. variable_b = #rut
                4. fijo_2 = DOCUMENTO
                5. variable_c = #indice
                
                   El nombre de archivo final sería:
                   **PEREZ_USUARIO_1234567-8_DOCUMENTO_24.pdf**
                   
        3. **[MAPEOS]**: Esta sección tiene los campos que se extraerán del archivo de datos en excel. Se colocará la etiqueta y la letra de la columna del archivo en excel donde se encuentra ese campo. 
            1. La letra indica la columna del archivo de base de datos. Ejemplo:
            ```
                [MAPEOS]
                .
                .
                .
                #indice = A
                .
                .
                .
            ```
            
            2. Los mapeos se pueden hacer para 1 o varias columnas por variable.
            
            3. Para una columna por variable, se define una variable, así: 
            ```
                [MAPEOS]
                .
                .
                .
                #nombre_ejemplo = 'Columna'
                .
                .
                .
            ```
            
            4. Para varias columnas por variable, se definen varias variables con el mismo nombre, así:
            ```
                #nombre_ejemplo[] = 'Columna 1'
                #nombre_ejemplo[] = 'Columna 2'
                #nombre_ejemplo[] = 'Columna 3'
            ```
            
            5. En este último caso, las columnas se van a unir con espacios entre cada una y en el orden en el que se definan en el archivo de configuración. Ejemplo:
            ```
                #nombre[] = A 
                #nombre[] = B 
            ```
            
            * En la columna A está el apellido.
            * En la columna B está el nombre.
            * La etiqueta **#nombre** en plantilla de word será sustituída por **“APELLIDO NOMBRE”**.

9. **Plantillas en Word**: Se debe agregar las etiquetas que serán cambiadas por los datos a mapear. Para agregar las etiquetas se debe hacer lo siguiente:
    1. En el documento de Word, agregar la misma etiqueta de mapeo colocada en el archivo de configuración, pero rodeada por **'${‘** y **‘}’**, sin espacios entre ellos. Ejemplo:
        1. Si en el archivo de configuración, la etiqueta de mapeo es **#prueba**, en la plantilla debe colocarse **${#prueba}**.
            1. Config.cnf 
            ```
               [MAPEOS]
               #prueba = A
            ```
               
            2. Plantilla.docx
            
               Aquí va lo que se va a cambiar: **${#prueba}**. Esto es una prueba.
                
10. **Ejecución del proceso**: 
    1. Se debe ir al directorio donde se encuentra el proyecto y ejecutar lo siguiente:
        1. *php  generar_pdf.php  nombre_del_archivo_de_configuración.cnf* 
    2. También se puede ejecutar fuera del directorio del proyecto, indicando la ruta completa del ejecutable ‘generar_pdf.php’. Ejemplo:
        1. *php /ruta/del/proyecto/local/generar_pdf.php /archivo/de/configuracion.cnf*
    3. En este último caso (ejecución fuera del directorio del proyecto), es importante que las rutas **_‘ruta_in’_** y **_‘ruta_out’_** del archivo de configuración, **no sean rutas relativas**, sino **absolutas**.
