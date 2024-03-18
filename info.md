# Comando para lanzar Lumen

>## Este aplicativo esta realizado en lumen 

>## Instalar Extensiones en visual studio code
>> <code> Lumen Smart Command </code>


>> <code> composer create-project --prefer-dist laravel/lumen api_adres </code>
>>
>> <code> cd lumen api_adres </code>


>## Antes de Instalar  flipbox lumen generator
>> <code> composer clear-cache </code>
>> <code> composer self-update </code>
>> <code> composer diagnose </code>

>## Instalar en Composer flipbox lumen generator
>> <code> composer require flipbox/lumen-generator </code>
>> <code> composer require flipbox/lumen-generator -W </code>

>## Configurar flipbox lumen generator 
>## en el archivo bootstrap>app.php y colocar estas Lineas
> <code> $app->register(App\Providers\AppServiceProvider::class); </code><br>
> <code> $app->register(App\Providers\AuthServiceProvider::class); </code><br>
> <code> $app->register(App\Providers\EventServiceProvider::class);</code><br>
>### se activa este plugin
> <code> $app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class); </code>
>## Descomentariar 
> <code> $app->withEloquent();</code>


>## Crear Migraciones en php Lumen
<!-- <code> php artisan make:migration create_unidad </code><br> -->
> <code> php artisan make:migration unidades --create=unidades  </code><br>
> <code> php artisan make:migration create_unidades  </code><br>
> <code> php artisan make:migration create_tipos  </code><br>
> <code> php artisan make:migration create_proveedores  </code><br>
> <code> php artisan make:migration create_adquisicion  </code><br>
>## Ejecutar Migraciones en php Lumen
> <code> php artisan migrate  </code><br>
> <code> php artisan make:model Unidad  </code><br>
>## Ejecutar si no esta creada la carpeta model 
> <code> php artisan make:model Models/Unidad  </code><br>

>## Ejecutar para crear los controladores a crear  
> <code> php artisan make:controller ProveedorController </code><br>

># Lanzar el servicio de Lumen
>> <code> php -S localhost:8000 -t public </code>

# se instalo esto 
>> composer require fruitcake/laravel-cors
