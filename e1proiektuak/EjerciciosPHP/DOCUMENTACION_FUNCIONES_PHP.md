# 📚 Guía y Documentación Exhaustiva de Funciones en PHP
> **Proyecto:** Ejercicios WES (Web Entorno Servidor / Zerbitzari Inguruneko Garapena)  
> **Ámbito:** `ariketak(1-6)`, `ariketa7`, `ariketa8`, `POO` y `ejerciciosIA`.

Esta documentación detalla tanto las **funciones nativas del lenguaje PHP** utilizadas a lo largo de los ejercicios como las **funciones personalizadas (propias)** creadas para resolver los problemas planteados. El objetivo es proporcionar una referencia clara sobre **qué hacen, cuál es su sintaxis, por qué y cuándo usarlas (usabilidad práctica), ejemplos reales de tu código y buenas prácticas**.

---

## 📑 Tabla de Contenidos
1. [Funciones Nativas de PHP (Built-in)](#1-funciones-nativas-de-php-built-in)
   - [Fechas y Tiempo](#11-fechas-y-tiempo) (`date()`, `DateTime::modify()`, `DateTime::format()`)
   - [Matemáticas y Números Aleatorios](#12-matemáticas-y-números-aleatorios) (`rand()`, `sqrt()`)
   - [Manipulación e Inspección de Arrays](#13-manipulación-e-inspección-de-arrays) (`count()`, `in_array()`, `print_r()`, `sort()`, `array_merge()`)
   - [Cadenas de Texto (Strings)](#14-cadenas-de-texto-strings) (`substr()`, `strtoupper()`, `trim()`, `preg_match()`)
   - [Validación e Inspección de Variables](#15-validación-e-inspección-de-variables) (`filter_var()`, `isset()`, `empty()`)
   - [Archivos y Formato JSON](#16-archivos-y-formato-json) (`file_get_contents()`, `file_put_contents()`, `file_exists()`, `json_encode()`, `json_decode()`)
2. [Funciones Propias Creadas en los Ejercicios](#2-funciones-propias-creadas-en-los-ejercicios)
   - [Bloque Ariketak 6 (Procedimentales y Arrays)](#21-bloque-ariketak-6-procedimentales-y-arrays)
   - [Bloque Ariketa 7 (Validaciones de Formularios y Helpers)](#22-bloque-ariketa-7-validaciones-de-formularios-y-helpers)
   - [Bloque POO y Ejercicios IA](#23-bloque-poo-y-ejercicios-ia)
3. [Tabla Resumen Rápida de Usabilidad](#3-tabla-resumen-rápida-de-usabilidad)

---

# 1. Funciones Nativas de PHP (Built-in)

---

## 1.1 Fechas y Tiempo

### `date()`
- **¿Qué es y para qué sirve?**  
  Formatea una fecha/hora local según un formato especificado. Es la función estándar para obtener el día actual, año, mes, hora, día de la semana, etc., como una cadena de texto.
- **Sintaxis:**
  ```php
  date(string $format, ?int $timestamp = null): string
  ```
  - `$format`: Cadena con códigos de formato (ej: `"N"` para día de la semana 1-7, `"Y-m-d"` para año-mes-día, `"H:i:s"` para hora).
  - `$timestamp` *(opcional)*: Marca de tiempo Unix entera. Si no se indica, toma el momento actual (`time()`).
  - **Retorno:** Cadena con la fecha formateada.
- **Uso en tus ejercicios:**  
  📍 [ariketak2.php: Línea 21](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak2.php#L21)
  ```php
  $egunZenbakia = date("N");
  ```
- **Usabilidad práctica en el ejercicio:**  
  El parámetro `"N"` devuelve la representación numérica del día de la semana según la norma ISO-8601: `1` para lunes (*Astelehena*), `2` para martes, ..., hasta `7` para domingo (*Igandea*). Esto te permite evaluar con un `if/elseif` qué día de la semana es hoy de forma exacta.
- **Ojo con:**  
  No confundir `"N"` (1=Lunes a 7=Domingo) con `"w"` (0=Domingo a 6=Sábado). Si usaras `"w"`, el domingo valdría 0 y descolocaría tus condicionales.

---

### `DateTime` (`modify()`, `format()`)
- **¿Qué es y para qué sirve?**  
  `DateTime` es una clase orientada a objetos en PHP para manipular fechas complejas de manera robusta. Evita errores al calcular sumas o restas de días, meses bisiestos o cambios de huso horario.
  - `modify(string $modifier)`: Altera la fecha sumando o restando intervalos en lenguaje natural (ej. `"+10 days"`, `"-1 month"`).
  - `format(string $format)`: Devuelve la fecha como un string con el formato deseado.
- **Sintaxis:**
  ```php
  $objetoFecha = new DateTime(string $datetime = "now");
  $objetoFecha->modify(string $modifier): DateTime|false;
  $objetoFecha->format(string $format): string;
  ```
- **Uso en tus ejercicios:**  
  📍 [helpers.php: Líneas 32-35](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L32-L35)
  ```php
  function calcularFechaDevolucion($fecha) {
      $devolucion = new DateTime($fecha);
      $devolucion->modify("+10 days");
      return $devolucion->format("Y-m-d");
  }
  ```
- **Usabilidad práctica en el ejercicio:**  
  En un sistema de alquileres o préstamos de biblioteca, calcular cuándo debe devolver el usuario un artículo añadiendo 10 días es crítico. Si sumaras simplemente `10 * 86400` segundos manualmente, podrías tener problemas de cambio de horario de verano o fin de mes. Con `DateTime::modify("+10 days")`, PHP gestiona automáticamente si el mes tiene 28, 30 o 31 días.

---

## 1.2 Matemáticas y Números Aleatorios

### `rand()`
- **¿Qué es y para qué sirve?**  
  Genera un número entero pseudoaleatorio. Esencial para simulaciones, generación de datos de prueba, tiradas de dados, sorteos o asignación de identificadores temporales.
- **Sintaxis:**
  ```php
  rand(): int
  rand(int $min, int $max): int
  ```
  - `$min` *(opcional)*: Valor mínimo que puede salir (inclusivo).
  - `$max` *(opcional)*: Valor máximo que puede salir (inclusivo).
  - **Retorno:** Entero aleatorio entre `$min` y `$max`. Si se llama sin argumentos, devuelve un número entre 0 y `getrandmax()`.
- **Uso en tus ejercicios:**  
  📍 [ariketak2.php: Línea 79](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak2.php#L79) -> `$zenbakia = rand(0, 30);`  
  📍 [ariketak3.php: Línea 27](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak3.php#L27) -> `$numero = rand();`  
  📍 [ariketak4.php: Línea 30](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak4.php#L30) -> `$zenbakiRandom = rand(1, 100);`  
  📍 [ariketak6.php: Línea 111](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak6.php#L111) -> `$zenbakiAleatorioa = rand(1, 10);`
- **Usabilidad práctica en el ejercicio:**  
  Permite probar la lógica de rangos (ej. si está entre 0 y 10, 10 y 20 o 20 y 30), poblar tablas dinámicas con notas o precios sin tener que escribirlos a mano, y testear funciones de cálculo como el factorial.
- **Buenas prácticas:**  
  En PHP moderno, `rand()` es un alias de `mt_rand()` (Mersenne Twister), pero para contraseñas o tokens de seguridad se debe usar `random_int()`.

---

### `sqrt()`
- **¿Qué es y para qué sirve?**  
  Calcula la raíz cuadrada de un número (`float`).
- **Sintaxis:**
  ```php
  sqrt(float|int $num): float
  ```
- **Uso en tus ejercicios:**  
  📍 [ejercicio15.php: Línea 20](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ejerciciosIA/ejercicio15.php#L20)
  ```php
  for ($i = 2; $i <= sqrt($numero1); $i++) {
      if ($numero1 % $i == 0) {
          return false;
      }
  }
  ```
- **Usabilidad práctica en el ejercicio:**  
  Optimización matemática al calcular si un número es primo. En lugar de iterar hasta el número $N$, comprobar divisores solo hasta $\sqrt{N}$ reduce drásticamente las iteraciones necesarias, pasando de miles de operaciones a unas pocas.

---

## 1.3 Manipulación e Inspección de Arrays

### `count()`
- **¿Qué es y para qué sirve?**  
  Cuenta todos los elementos de un array o de un objeto que implemente `Countable`.
- **Sintaxis:**
  ```php
  count(Countable|array $value, int $mode = COUNT_NORMAL): int
  ```
- **Uso en tus ejercicios:**  
  📍 [ariketak3.php: Línea 25](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak3.php#L25) -> `while (count($numeros) < 10)`  
  📍 [ariketak4.php: Línea 41](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak4.php#L41) -> `for ($i = 0; $i < count($zenbakiak); $i++)`  
  📍 [ariketak5.php: Línea 73](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak5.php#L73) -> `$ikasleakLenght = count($ikasleak);`  
  📍 [ariketak6.php: Línea 26](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak6.php#L26) -> `for ($i = 0; $i < count($ray); $i++)`  
  📍 [process.php: Línea 53](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/process.php#L53) -> `if (count($erroreak) == 0)`
- **Usabilidad práctica en el ejercicio:**  
  - Para controlar condiciones de bucles (generar exactamente 10 números sin pasarse).
  - Para calcular la media matemática: `suma / count($elementos)`.
  - Para validar formularios: verificar si el array de `$erroreak` está vacío (`count($erroreak) == 0`) antes de procesar el alta.
- **Tip de rendimiento:**  
  Como hiciste muy bien en `ariketak5.php:73`, guardar `$longitud = count($array)` en una variable antes de un bucle `for` evita recontar el array en cada iteración, mejorando el rendimiento.

---

### `in_array()`
- **¿Qué es y para qué sirve?**  
  Comprueba si un valor existe dentro de un array.
- **Sintaxis:**
  ```php
  in_array(mixed $needle, array $haystack, bool $strict = false): bool
  ```
  - `$needle`: El elemento que buscas ("la aguja").
  - `$haystack`: El array donde buscas ("el pajar").
  - `$strict` *(opcional)*: Si es `true`, compara también el tipo de dato (`===`).
  - **Retorno:** `true` si el elemento está en el array, `false` si no.
- **Uso en tus ejercicios:**  
  📍 [ariketak3.php: Línea 29](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak3.php#L29)
  ```php
  if (!in_array($numero, $numeros)) {
      $numeros[] = $numero;
      $suma += $numero;
  }
  ```
- **Usabilidad práctica en el ejercicio:**  
  Evitar duplicados. Al generar 10 números aleatorios, si un número ya había salido antes, `!in_array(...)` lo detecta y no lo añade, garantizando que todos los elementos de `$numeros` sean únicos.

---

### `print_r()`
- **¿Qué es y para qué sirve?**  
  Muestra información legible para humanos sobre una variable, especialmente arrays u objetos. Es una herramienta clave de depuración (*debugging*).
- **Sintaxis:**
  ```php
  print_r(mixed $value, bool $return = false): string|bool
  ```
  - `$value`: La variable a inspeccionar.
  - `$return` *(opcional)*: Si es `true`, no imprime en pantalla, sino que devuelve el texto como string.
- **Uso en tus ejercicios:**  
  📍 [ariketak3.php: Línea 36](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak3.php#L36)
  ```php
  print_r($numeros);
  ```
- **Usabilidad práctica en el ejercicio:**  
  Un `echo $numeros;` lanzaría una advertencia de tipo *"Array to string conversion"* y solo imprimiría la palabra `"Array"`. Con `print_r($numeros)`, PHP imprime los índices y valores: `Array ( [0] => 45 [1] => 12 ... )`.
- **Consejo:** Para verlo bien formateado en el navegador, se suele envolver en `<pre>`:
  ```php
  echo "<pre>"; print_r($array); echo "</pre>";
  ```

---

### `sort()`
- **¿Qué es y para qué sirve?**  
  Ordena un array en orden ascendente (de menor a mayor o alfabéticamente de la A a la Z).
- **Sintaxis:**
  ```php
  sort(array &$array, int $flags = SORT_REGULAR): bool
  ```
  - **¡Importante!** Pasa el array **por referencia** (`&$array`), lo que significa que **modifica directamente el array original**.
  - **Retorno:** Devuelve `true` si tuvo éxito o `false` en caso de error (no devuelve el array ordenado).
- **Uso en tus ejercicios:**  
  📍 [ariketak4.php: Línea 66](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak4.php#L66)
  ```php
  $herrialdeak = array("EH", "Frantzia", "Alemania", "Italia");
  sort($herrialdeak);
  ```
- **Usabilidad práctica en el ejercicio:**  
  Ordena alfabéticamente los países antes de imprimirlos en la tabla HTML (`"Alemania"`, `"EH"`, `"Frantzia"`, `"Italia"`).
- **Error típico de novato:**  
  Hacer `$resultado = sort($array);` y luego intentar iterar `$resultado`. `$resultado` solo valdrá `true`, ¡el array ordenado sigue siendo `$array`!

---

### `array_merge()`
- **¿Qué es y para qué sirve?**  
  Combina/fusiona uno o más arrays juntos, de modo que los valores de uno se añaden al final del anterior.
- **Sintaxis:**
  ```php
  array_merge(array ...$arrays): array
  ```
  - **Retorno:** El nuevo array resultante con los elementos combinados.
- **Uso en tus ejercicios:**  
  📍 [ariketak6.php: Línea 49](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak6.php#L49)
  ```php
  function arrayKonbinaketa($ray1, $ray2) {
      $kombi = array_merge($ray1, $ray2);
      foreach ($kombi as $elementuak) {
          echo $elementuak . " ";
      }
  }
  ```
- **Usabilidad práctica en el ejercicio:**  
  Juntar listas independientes (por ejemplo, `$s1 = [1, 3, 6, 9]` y `$s2 = [2, 4, 6, 8, 10]`) en una sola colección `$kombi` para poder procesarla o mostrarla en una única pasada de bucle.

---

## 1.4 Cadenas de Texto (Strings)

### `substr()`
- **¿Qué es y para qué sirve?**  
  Devuelve una subcadena (parte de un texto) a partir de una posición inicial y una longitud determinada.
- **Sintaxis:**
  ```php
  substr(string $string, int $offset, ?int $length = null): string
  ```
  - `$offset`: Posición donde empieza el corte (0 para el primer carácter). Si es **negativo**, cuenta desde el final (ej. `-1` es el último carácter).
  - `$length`: Cuántos caracteres extraer. Si se omite, extrae todo hasta el final.
- **Uso en tus ejercicios:**  
  📍 [helpers.php: Línea 12](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L12) -> `$numero = substr($dni, 0, 8);`  
  📍 [helpers.php: Línea 24](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L24) -> `substr($dni, -1);`
- **Usabilidad práctica en el ejercicio:**  
  En la validación del DNI/NAN español:
  1. `substr($dni, 0, 8)` extrae exactamente los 8 primeros dígitos numéricos para poder calcular el módulo 23 (`% 23`).
  2. `substr($dni, -1)` extrae únicamente el último carácter (la letra) para comprobar si coincide con la letra que le corresponde matemáticamente.

---

### `strtoupper()`
- **¿Qué es y para qué sirve?**  
  Convierte todos los caracteres de una cadena de texto a mayúsculas.
- **Sintaxis:**
  ```php
  strtoupper(string $string): string
  ```
- **Uso en tus ejercicios:**  
  📍 [helpers.php: Línea 24](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L24) -> `$letraIntroducida = strtoupper(substr($dni, -1));`  
  📍 [process.php: Línea 9](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/process.php#L9) -> `$nan = strtoupper($_POST["nan"] ?? "");`
- **Usabilidad práctica en el ejercicio:**  
  **Normalización de entradas del usuario**. Los usuarios pueden escribir su DNI como `"12345678a"` o `"12345678A"`. Al pasarlo a mayúsculas con `strtoupper`, evitamos que la validación falle por una simple diferencia tipográfica entre minúscula y mayúscula.

---

### `trim()`
- **¿Qué es y para qué sirve?**  
  Elimina los espacios en blanco (y saltos de línea) al principio y al final de una cadena.
- **Sintaxis:**
  ```php
  trim(string $string, string $characters = " \n\r\t\v\x00"): string
  ```
- **Uso en tus ejercicios:**  
  📍 [ejercicio21reto.php: Línea 40](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ejerciciosIA/ejercicio21reto.php#L40)
  ```php
  $nuevoUsuario = [
      "nombre" => trim($_POST["nombre"]),
      "contrasenia" => trim($_POST["contrasenia"])
  ];
  ```
- **Usabilidad práctica en el ejercicio:**  
  Limpieza de datos antes de guardar en la base de datos o archivo JSON. Si un usuario escribe por error `" Pedro "` o pulsa la barra espaciadora al final, `trim()` lo limpia para que se guarde exactamente `"Pedro"`, evitando problemas en futuras búsquedas o inicios de sesión.

---

### `preg_match()`
- **¿Qué es y para qué sirve?**  
  Realiza una búsqueda de coincidencia con una **expresión regular (Regex)** sobre un texto. Es la forma más potente de comprobar si una cadena cumple un formato específico.
- **Sintaxis:**
  ```php
  preg_match(string $pattern, string $subject, array &$matches = null, int $flags = 0, int $offset = 0): int|false
  ```
  - `$pattern`: La expresión regular entre delimitadores (ej. `"/patrón/"`).
  - `$subject`: El texto a analizar.
  - **Retorno:** `1` si coincide el patrón, `0` si no coincide, `false` en caso de error de sintaxis en la regex.
- **Uso en tus ejercicios:**  
  📍 [helpers.php: Línea 20](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L20)
  ```php
  if (!preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {
      return false;
  }
  ```
- **Usabilidad práctica en el ejercicio:**  
  El patrón `/^[0-9]{8}[A-Za-z]$/` exige que:
  - `^` empiece obligatoriamente con el texto.
  - `[0-9]{8}` contenga exactamente 8 dígitos del 0 al 9 consecutivos.
  - `[A-Za-z]` termine con exactamente una letra del abecedario.
  - `$` llegue al final sin caracteres adicionales.  
  Si alguien mete "1234", "123456789", o letras en medio, `preg_match` devuelve 0 y se rechaza inmediatamente antes de hacer cualquier cálculo matemático.

---

## 1.5 Validación e Inspección de Variables

### `filter_var()`
- **¿Qué es y para qué sirve?**  
  Filtra una variable con un filtro específico de PHP (validación de URLs, IPs, emails, enteros, o sanitización de caracteres HTML).
- **Sintaxis:**
  ```php
  filter_var(mixed $value, int $filter = FILTER_DEFAULT, array|int $options = 0): mixed
  ```
- **Uso en tus ejercicios:**  
  📍 [helpers.php: Línea 5](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L5)
  ```php
  function validarEmail($email) {
      return filter_var($email, FILTER_VALIDATE_EMAIL);
  }
  ```
- **Usabilidad práctica en el ejercicio:**  
  Validar una dirección de correo electrónico según los estándares RFC. En lugar de escribir una expresión regular kilométrica y propensa a fallos para validar un email, `filter_var($email, FILTER_VALIDATE_EMAIL)` lo resuelve en una sola línea nativa y muy optimizada. Devuelve el email saneado si es válido o `false` si no lo es.

---

### `isset()`
- **¿Qué es y para qué sirve?**  
  Determina si una variable está declarada y su valor **no es `null`**. Es un constructor del lenguaje fundamental para comprobar envíos de formularios.
- **Sintaxis:**
  ```php
  isset(mixed $var, mixed ...$vars): bool
  ```
- **Uso en tus ejercicios:**  
  📍 [ariketa8/index.php: Línea 81](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa8/index.php#L81) -> `if (isset($_POST['bidali']))`  
  📍 [ariketa8/index.php: Línea 116](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa8/index.php#L116) -> `if (isset($_POST['soinua']))`  
  📍 [ejercicio13.php: Línea 12](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ejerciciosIA/ejercicio13.php#L12) -> `if (isset($_POST["nombre"]))`  
  📍 [ejercicio21reto.php: Línea 37](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ejerciciosIA/ejercicio21reto.php#L37) -> `if (isset($_POST["registrar"]))`
- **Usabilidad práctica en el ejercicio:**  
  Cuando una página PHP se carga por primera vez (petición GET), el usuario aún no ha pulsado el botón del formulario. Si intentáramos acceder a `$_POST['bidali']` directamente, PHP lanzaría un error de tipo *"Undefined array key"*. Con `if (isset($_POST['bidali']))`, el código de procesamiento solo se ejecuta cuando el usuario ha enviado el formulario con el botón `bidali`.

---

### `empty()`
- **¿Qué es y para qué sirve?**  
  Determina si una variable se considera vacía. Una variable se considera vacía si no existe, o si su valor es igual a `false`, `""` (string vacío), `0`, `0.0`, `"0"`, `null`, o `[]` (array vacío).
- **Sintaxis:**
  ```php
  empty(mixed $var): bool
  ```
- **Uso en tus ejercicios:**  
  📍 [process.php: Líneas 13, 21, 27](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/process.php#L13)
  ```php
  if (empty($emaila)) {
      $erroreak[] = "Emaila hutsik dago.";
  }
  ```
- **Usabilidad práctica en el ejercicio:**  
  Comprobar campos obligatorios en un formulario. Si el usuario envía un input de texto sin escribir nada, llega como una cadena vacía `""`. `empty()` devuelve `true`, permitiendo capturar el error y mostrar un mensaje claro al usuario (*"NAN bete behar da"*, etc.).

---

## 1.6 Archivos y Formato JSON

### `file_exists()`, `file_get_contents()`, `file_put_contents()`
- **¿Qué son y para qué sirven?**  
  Son las funciones principales para persistencia simple de datos en ficheros sin necesidad de una base de datos MySQL.
  - `file_exists(string $filename)`: Comprueba si un archivo o directorio existe en el disco.
  - `file_get_contents(string $filename)`: Lee un archivo completo y devuelve todo su contenido como una cadena de texto.
  - `file_put_contents(string $filename, mixed $data)`: Escribe datos directamente en un fichero (si no existe, lo crea; si existe, lo sobrescribe).
- **Sintaxis:**
  ```php
  file_exists(string $filename): bool
  file_get_contents(string $filename): string|false
  file_put_contents(string $filename, mixed $data, int $flags = 0): int|false
  ```
- **Uso en tus ejercicios:**  
  📍 [ejercicio21reto.php: Líneas 30, 31, 46](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ejerciciosIA/ejercicio21reto.php#L30)
  ```php
  if (file_exists($archivo)) {
      $listaDeUsuarios = json_decode(file_get_contents($archivo), true) ?? [];
  }
  
  file_put_contents($archivo, json_encode($listaDeUsuarios, JSON_PRETTY_PRINT));
  ```
- **Usabilidad práctica en el ejercicio:**  
  Crear una base de datos ligera basada en ficheros JSON. Permite que cuando un usuario se registre, sus datos no se pierdan al recargar la página, sino que queden guardados en el disco dentro de `usuarios.json`.

---

### `json_encode()` y `json_decode()`
- **¿Qué son y para qué sirven?**  
  Transforman datos entre estructuras nativas de PHP (arrays/objetos) y cadenas de texto en formato universal JSON.
  - `json_encode($data)`: Convierte un array u objeto de PHP en una cadena de texto JSON.
  - `json_decode($json, $associative)`: Convierte una cadena de texto JSON en un array u objeto de PHP.
- **Sintaxis:**
  ```php
  json_encode(mixed $value, int $flags = 0, int $depth = 512): string|false
  json_decode(string $json, ?bool $associative = null, int $depth = 512, int $flags = 0): mixed
  ```
- **Uso en tus ejercicios:**  
  📍 [ejercicio21reto.php: Líneas 31, 48](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ejerciciosIA/ejercicio21reto.php#L31)
  ```php
  $listaDeUsuarios = json_decode(file_get_contents($archivo), true);
  json_encode($listaDeUsuarios, JSON_PRETTY_PRINT);
  ```
- **Usabilidad práctica en el ejercicio:**  
  - Al pasar `true` en el segundo parámetro de `json_decode(..., true)`, PHP convierte los objetos JSON directamente en **arrays asociativos** fáciles de recorrer con un `foreach`.
  - La constante `JSON_PRETTY_PRINT` indenta el archivo JSON resultante con espacios y saltos de línea, haciéndolo legible si lo abres con un editor.

---

# 2. Funciones Propias Creadas en los Ejercicios

---

## 2.1 Bloque Ariketak 6 (Procedimentales y Arrays)

### `arrayBatura($ray)`
- **Ubicación:** 📍 [ariketak6.php: Líneas 23-30](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak6.php#L23-L30)
- **Definición:**
  ```php
  function arrayBatura($ray) {
      $batuketa = 0;
      for ($i = 0; $i < count($ray); $i++) {
          $batuketa = $batuketa + $ray[$i];
      }
      return $batuketa;
  }
  ```
- **Propósito y Usabilidad:**  
  Calcula la sumatoria de todos los elementos numéricos contenidos en un array unidimensional.
  - **Parámetro:** `$ray` (Array numérico).
  - **Retorno:** `int|float` con la suma total.
  - **Ejemplo en código:** `$zbk = array(4, 8, 15, 16, 23, 42); echo arrayBatura($zbk);` -> Imprime `108`.
- **Equivalencia nativa en PHP:** En PHP existe una función nativa idéntica llamada `array_sum($ray)`. Crear tu propia función `arrayBatura` te permite comprender la lógica interna de acumulación algorítmica mediante un bucle `for` y un acumulador (`$batuketa`).

---

### `arrayKonbinaketa($ray1, $ray2)`
- **Ubicación:** 📍 [ariketak6.php: Líneas 47-53](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak6.php#L47-L53)
- **Definición:**
  ```php
  function arrayKonbinaketa($ray1, $ray2) {
      $kombi = array_merge($ray1, $ray2);
      foreach ($kombi as $elementuak) {
          echo $elementuak . " ";
      }
  }
  ```
- **Propósito y Usabilidad:**  
  Recibe dos arrays, los fusiona internamente utilizando `array_merge()` e imprime directamente los elementos combinados separados por espacios.
  - **Parámetros:** `$ray1` (Array), `$ray2` (Array).
  - **Retorno:** `void` (no hace `return`, genera salida directa con `echo`).
  - **Diferencia conceptual:** Es una función de procedimiento/presentación (hace salida por pantalla) frente a funciones puras que retornan datos procesados.

---

### `arrayTaulaBistaratu($multi)`
- **Ubicación:** 📍 [ariketak6.php: Líneas 78-95](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak6.php#L78-L95)
- **Definición:**
  ```php
  function arrayTaulaBistaratu($multi) {
      echo "<table border=1px>";
      echo "<tr><th> Izena </th><th> Nota </th></tr>";
      foreach ($multi as $e) {
          echo "<tr>";
          echo "<td>" . $e["ikaslea"] . "</td>";
          echo "<td>" . $e["nota"] . "</td>";
          echo "</tr>";
      }
      echo "</table>";
  }
  ```
- **Propósito y Usabilidad:**  
  Generador de componentes HTML reutilizables. Toma cualquier array multidimensional estructurado con claves `"ikaslea"` y `"nota"`, y renderiza dinámicamente una tabla HTML con encabezados.
  - **Parámetro:** `$multi` (Array de arrays asociativos).
  - **Retorno:** `void` (imprime HTML directamente).
  - **Usabilidad práctica:** En cualquier web (panel de notas, listas de precios, inventarios), abstraer la creación de tablas en funciones reutilizables evita tener que duplicar las etiquetas `<table>`, `<tr>`, `<td>` en cada página.

---

### `faktoriala($zbk)`
- **Ubicación:** 📍 [ariketak6.php: Líneas 115-134](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketak%281-6%29/ariketak6.php#L115-L134)
- **Definición:**
  ```php
  function faktoriala($zbk) {
      $emaitzaArray = array();
      $emaitza = 0;
      for ($i = $zbk; $i >= 0; $i--) {
          echo $i . " * ";
          $emaitza = $i * ($i - 1);
          $emaitzaArray[$i] = $emaitza;
      }
      echo "<br><ul>";
      for ($i = 1; $i <= $zbk; $i++) {
          echo "<li>" . $emaitzaArray[$i] . "</li>";
      }
      echo "</ul>";
  }
  ```
- **Propósito y Usabilidad:**  
  Ilustra el recorrido de bucles decrecientes y el almacenamiento del histórico de multiplicaciones intermedias en un array para luego mostrarlas como lista HTML no ordenada (`<ul>`, `<li>`).
  - **Parámetro:** `$zbk` (Entero del que se desea calcular y listar pasos).

---

## 2.2 Bloque Ariketa 7 (Validaciones de Formularios y Helpers)

### `validarEmail($email)`
- **Ubicación:** 📍 [helpers.php: Líneas 3-6](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L3-L6)
- **Definición:**
  ```php
  function validarEmail($email) {
      return filter_var($email, FILTER_VALIDATE_EMAIL);
  }
  ```
- **Propósito y Usabilidad:**  
  Encapsula la validación de correos electrónicos en una función semántica y limpia.
  - **Parámetro:** `$email` (String introducido por el usuario).
  - **Retorno:** El email filtrado (evalúa a `true` en un `if`) o `false` si el formato no es válido (ej. le falta la arroba, el dominio o tiene espacios).

---

### `letraCorrectaDNI($dni)`
- **Ubicación:** 📍 [helpers.php: Líneas 8-16](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L8-L16)
- **Definición:**
  ```php
  function letraCorrectaDNI($dni) {
      $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
      $numero = substr($dni, 0, 8);
      $resto = $numero % 23;
      return $letras[$resto];
  }
  ```
- **Propósito y Usabilidad:**  
  Implementa el algoritmo oficial del Ministerio del Interior para el cálculo de la letra de control del DNI:
  1. Extrae los 8 primeros caracteres numéricos con `substr($dni, 0, 8)`.
  2. Calcula el resto de la división entera entre 23 (`$numero % 23`).
  3. Utiliza la cadena `$letras` como un array de caracteres indexado por la posición `$resto` para devolver la letra que le corresponde exactamente a ese número.
  - **Retorno:** `string` de 1 carácter con la letra teórica exacta.

---

### `validarDNI($dni)`
- **Ubicación:** 📍 [helpers.php: Líneas 18-28](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L18-L28)
- **Definición:**
  ```php
  function validarDNI($dni) {
      if (!preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {
          return false;
      }
      $letraIntroducida = strtoupper(substr($dni, -1));
      $letraCorrecta = letraCorrectaDNI($dni);
      return $letraIntroducida === $letraCorrecta;
  }
  ```
- **Propósito y Usabilidad:**  
  Validación integral de identidad en 2 fases:
  1. **Fase de formato sintáctico:** Comprueba mediante `preg_match` que tenga exactamente 8 cifras y 1 letra. Si no lo cumple, descarta inmediatamente devolviendo `false`.
  2. **Fase de coherencia matemática:** Obtiene la letra introducida normalizada a mayúsculas con `strtoupper(substr($dni, -1))` y la compara estrictamente (`===`) con la que calcula `letraCorrectaDNI($dni)`.
  - **Retorno:** `true` si el DNI es 100% auténtico y válido, `false` en cualquier otro caso.

---

### `calcularFechaDevolucion($fecha)`
- **Ubicación:** 📍 [helpers.php: Líneas 30-36](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ariketa7/helpers.php#L30-L36)
- **Definición:**
  ```php
  function calcularFechaDevolucion($fecha) {
      $devolucion = new DateTime($fecha);
      $devolucion->modify("+10 days");
      return $devolucion->format("Y-m-d");
  }
  ```
- **Propósito y Usabilidad:**  
  Regla de negocio para alquileres y préstamos:
  - Recibe una fecha en formato string (como `"2026-09-10"` procedente de un input `<input type="date">`).
  - Suma 10 días naturales calculando transiciones de mes y año de forma automática.
  - Devuelve la fecha resultante en formato ISO `"YYYY-MM-DD"`.

---

## 2.3 Bloque POO y Ejercicios IA

### `mayorEdad($edad)` y `nombreCompleto($nombre, $apellidos)`
- **Ubicación:** 📍 [POO/persona/index.php: Líneas 3-15](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/POO/persona/index.php#L3-L15)
- **Definición:**
  ```php
  function mayorEdad($edad) {
      return $edad >= 18;
  }

  function nombreCompleto($nombre, $apellidos) {
      return $nombre . " " . $apellidos;
  }
  ```
- **Propósito y Usabilidad:**  
  Funciones auxiliares puras:
  - `mayorEdad`: Devuelve un booleano `true`/`false` directo para comprobaciones de acceso de forma limpia y legible.
  - `nombreCompleto`: Concatena cadenas asegurando un espacio limpio entre nombre y apellido, evitando concatenaciones repetitivas en el código HTML.

---

### `esPrimo($numero1)`
- **Ubicación:** 📍 [ejercicio15.php: Líneas 14-25](file:///home/ikasle/wes/e1proiektuak/EjerciciosPHP/ejerciciosIA/ejercicio15.php#L14-L25)
- **Definición:**
  ```php
  function esPrimo($numero1) {
      if ($numero1 < 2) {
          return false;
      }
      for ($i = 2; $i <= sqrt($numero1); $i++) {
          if ($numero1 % $i == 0) {
              return false;
          }
      }
      return true;
  }
  ```
- **Propósito y Usabilidad:**  
  Determina si un número entero es primo:
  - Cualquier número menor que 2 no es primo (`return false`).
  - Itera desde 2 hasta la raíz cuadrada del número. Si encuentra cualquier divisor exacto (`$numero1 % $i == 0`), retorna inmediatamente `false`.
  - Si ningún número lo divide de forma exacta, sale del bucle y devuelve `true`.

---

# 3. Tabla Resumen Rápida de Usabilidad

| Función / Elemento | Tipo | ¿Para qué sirve? (Caso de uso rápido) | Retorno principal |
| :--- | :--- | :--- | :--- |
| `date("N")` | Nativa | Saber el día de la semana actual (1=Lunes a 7=Domingo) | `string` ("1"-"7") |
| `rand($min, $max)` | Nativa | Generar números aleatorios para notas, IDs o pruebas | `int` |
| `count($array)` | Nativa | Contar cuántos elementos tiene un array (para bucles o medias) | `int` |
| `in_array($val, $arr)`| Nativa | Comprobar si un dato ya existe dentro de un array | `bool` |
| `print_r($array)` | Nativa | Inspeccionar visualmente la estructura y contenido de un array | Imprime en pantalla |
| `sort(&$array)` | Nativa | Ordenar alfabética o numéricamente un array in-situ | `bool` |
| `array_merge($a, $b)`| Nativa | Unir dos o más listas en un solo array | `array` |
| `substr($str, $ini, $lon)` | Nativa | Extraer partes de un texto (ej. los 8 números o la letra del DNI)| `string` |
| `strtoupper($str)` | Nativa | Pasar un texto a mayúsculas para evitar fallos tipográficos | `string` |
| `trim($str)` | Nativa | Limpiar espacios accidentales al inicio o fin de una entrada | `string` |
| `preg_match($regex, $str)` | Nativa | Validar patrones estrictos de texto mediante expresiones regulares | `int` (1 o 0) |
| `filter_var($email, ...)` | Nativa | Validar si un correo electrónico cumple con el formato estándar | `$email` o `false` |
| `isset($var)` | Nativa | Saber si una variable existe y no es nula (ej. si se pulsó un botón) | `bool` |
| `empty($var)` | Nativa | Saber si un campo de formulario está vacío | `bool` |
| `json_encode($data)` | Nativa | Convertir un array de PHP a formato texto JSON para guardar | `string` |
| `json_decode($json, true)`| Nativa | Convertir un texto JSON a array asociativo de PHP | `array` |
| `file_get_contents($f)` | Nativa | Leer un archivo completo como texto | `string` |
| `file_put_contents($f, $d)`| Nativa | Guardar o sobrescribir datos en un archivo | `int` (bytes) |
| `validarDNI($dni)` | Propia | Comprobar formato y cálculo matemático de la letra del DNI | `bool` |
| `validarEmail($email)` | Propia | Wrapper limpio para validar correos | `mixed` |
| `calcularFechaDevolucion($f)`| Propia | Sumar 10 días hábiles/naturales a una fecha con clase `DateTime` | `string` ("YYYY-MM-DD") |
| `arrayBatura($ray)` | Propia | Sumar todos los números de un array mediante acumulador | `int\|float` |
| `arrayTaulaBistaratu($m)` | Propia | Generar una tabla HTML a partir de un array multidimensional | `void` (HTML) |
