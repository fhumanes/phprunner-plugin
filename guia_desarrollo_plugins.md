# 📘 **Guía Completa de Desarrollo de Plugins PHPRunner (VIEW + EDIT)**

### *Cómo envolver plugins jQuery para integrarlos en PHPRunner*

### *Incluye plantilla base y ejemplo completo con Select2*

# 🧭 Índice

1. Introducción

2. Arquitectura general de un plugin PHPRunner

3. Estructura de archivos

4. Ciclo de vida de un plugin

5. Modo VIEW: funcionamiento y plantilla

6. Modo EDIT: funcionamiento y plantilla

7. Cómo envolver un plugin jQuery

8. Ejemplo completo: Plugin Select2

9. Plantilla base para nuevos plugins

10. Buenas prácticas

11. Errores comunes

12. Apéndice: estructura recomendada de repositorio

# 1. **Introducción**

PHPRunner permite extender su interfaz mediante **plugins personalizados**, que pueden:

- mostrar valores en modo **VIEW**

- permitir edición avanzada en modo **EDIT**

- integrar plugins jQuery

- añadir CSS/JS propios

- definir parámetros configurables

Esta guía explica **cómo crear plugins completos**, desde cero, con ejemplos reales.

# 2. **Arquitectura general de un plugin PHPRunner**

Un plugin PHPRunner se compone de:

- **sample.php** → define parámetros configurables

- **help.txt** → documentación visible en PHPRunner

- **VIEW**
  
  - `<View><Plugin>.php`
  
  - `<View><Plugin>.js`

- **EDIT**
  
  - `<Edit><Plugin>.php`
  
  - `<Edit><Plugin>.js`

- **assets/** → plugin jQuery (CSS, JS, imágenes…)

# 3. **Estructura de archivos**

Código

```
MyPlugin/
│
├── sample.php
├── help.txt
│
├── ViewMyPlugin.php
├── ViewMyPlugin.js
│
├── EditMyPlugin.php
├── EditMyPlugin.js
│
└── assets/
      ├── jquery-plugin.js
      ├── jquery-plugin.css
      └── ...
```

# 4. **Ciclo de vida de un plugin**

## Modo VIEW

1. PHPRunner carga `<ViewMyPlugin.php>`

2. Ejecuta `initUserControl()`

3. Ejecuta `ShowDBValue()`

4. Inserta el HTML generado

5. Carga CSS/JS declarados

6. Ejecuta `<ViewMyPlugin.js>`

## Modo EDIT

1. PHPRunner carga `<EditMyPlugin.php>`

2. Ejecuta `initUserControl()`

3. Ejecuta `buildUserControl()`

4. Inserta el HTML base

5. Carga CSS/JS del plugin jQuery

6. Ejecuta `<EditMyPlugin.js>`

7. Inicializa la clase `Runner.controls.EditMyPlugin`

8. Antes de guardar → llama a `getForSubmit()`

# 5. **Modo VIEW: funcionamiento y plantilla**

## 5.1 Métodos del PHP

### ✔ `initUserControl()`

Lee parámetros y prepara valores.

### ✔ `ShowDBValue()`

Genera el HTML final.

### ✔ `addCSSFiles()` / `addJSFiles()`

Carga recursos.

## 5.2 Plantilla VIEW (PHP)

php

```
class ViewMyPlugin extends ViewControl
{    function initUserControl()    {        $this->color = $this->settings["color"] ?? "blue";    }    function showDBValue(&$data, $keylink)    {        $value = $data[$this->field];        return "<span style='color:{$this->color}'>{$value}</span>";    }    function addCSSFiles()    {        $this->addCSSFile("assets/myplugin.css");    }    function addJSFiles()    {        $this->addJSFile("assets/myplugin.js");    }
}
```

## 5.3 Plantilla VIEW (JS)

js

```
function ViewMyPlugin(container, options) {    // Opcional: lógica JS para modo vista
}
```

# 6. **Modo EDIT: funcionamiento y plantilla**

## 6.1 Métodos del PHP

### ✔ `initUserControl()`

- Lee parámetros

- Aplica defaults

- Sube settings al JS:

php

```
$this->addJSSetting("placeholder", $this->placeholder);
```

### ✔ `buildUserControl()`

Genera el HTML base:

php

```
return '<select id="'.$this->cfield.'" name="'.$this->cfield.'"></select>';
```

### ✔ `getUserSearchOptions()`

Define comparadores permitidos.

### ✔ `addCSSFiles()` / `addJSFiles()`

Carga el plugin jQuery.

## 6.2 Plantilla EDIT (JS)

⚠️ **Regla obligatoria:** 
El nombre debe ser EXACTAMENTE:

Código

```
Runner.controls.Edit<Plugin>
Runner.controls.constants["Edit<Plugin>"]
```

Ejemplo:

js

```
Runner.controls.EditMyPlugin = Runner.extend(Runner.controls.Control, {    constructor: function(cfg) {        Runner.controls.Control.prototype.constructor.call(this, cfg);        const placeholder = this.getFieldSetting("placeholder");        $("#" + this.cfield).select2({            placeholder: placeholder        });    },    getForSubmit: function() {        return $("#" + this.cfield).val();    }
});

Runner.controls.constants["EditMyPlugin"] = "EditMyPlugin";
```

# 7. **Cómo envolver un plugin jQuery**

## 7.1 Pasos

1. Copiar el plugin jQuery a `/assets/`

2. Declarar CSS/JS en `addCSSFiles()` y `addJSFiles()`

3. Generar HTML base en `buildUserControl()`

4. Inicializar el plugin jQuery en el constructor JS

5. Implementar `getForSubmit()`

6. Registrar la clase con el nombre correcto

# 8. **Ejemplo completo: Plugin Select2**

Aquí tienes un ejemplo real, completo y funcional.

## 8.1 sample.php

php

```
$settings = array(    "placeholder" => array("type" => "text", "default" => "Seleccione..."),    "multiple" => array("type" => "checkbox", "default" => false),    "allowClear" => array("type" => "checkbox", "default" => true)
);
```

## 8.2 EditSelect2.php

php

```
class EditSelect2 extends EditControl
{    function initUserControl()    {        $this->placeholder = $this->settings["placeholder"] ?? "Seleccione...";        $this->multiple = $this->settings["multiple"] ?? false;        $this->allowClear = $this->settings["allowClear"] ?? true;        $this->addJSSetting("placeholder", $this->placeholder);        $this->addJSSetting("multiple", $this->multiple);        $this->addJSSetting("allowClear", $this->allowClear);    }    function buildUserControl()    {        $multiple = $this->multiple ? "multiple" : "";        return "<select id='{$this->cfield}' name='{$this->cfield}' {$multiple}></select>";    }    function addCSSFiles()    {        $this->addCSSFile("assets/select2.css");    }    function addJSFiles()    {        $this->addJSFile("assets/select2.js");    }
}
```

## 8.3 EditSelect2.js

js

```
Runner.controls.EditSelect2 = Runner.extend(Runner.controls.Control, {    constructor: function(cfg) {        Runner.controls.Control.prototype.constructor.call(this, cfg);        const placeholder = this.getFieldSetting("placeholder");        const multiple = this.getFieldSetting("multiple");        const allowClear = this.getFieldSetting("allowClear");        $("#" + this.cfield).select2({            placeholder: placeholder,            multiple: multiple,            allowClear: allowClear        });    },    getForSubmit: function() {        return $("#" + this.cfield).val();    }
});

Runner.controls.constants["EditSelect2"] = "EditSelect2";
```

# 9. **Plantilla base para nuevos plugins**

Incluye:

- sample.php

- EditPlugin.php

- EditPlugin.js

- ViewPlugin.php

- ViewPlugin.js

*(Si quieres, te genero la plantilla completa en un archivo separado.)*

# 10. **Buenas prácticas**

- Mantener nombres consistentes

- Usar `addJSSetting()` solo en `initUserControl()`

- No manipular el DOM fuera del constructor

- Siempre implementar `getForSubmit()`

- Evitar dependencias globales

- Documentar parámetros en sample.php

# 11. **Errores comunes**

- No registrar la clase con el nombre correcto

- No devolver el valor en `getForSubmit()`

- No cargar CSS/JS del plugin jQuery

- Usar IDs duplicados

- No manejar modos SEARCH/INLINE

# 12. **Estructura recomendada de repositorio**

Código

```
/docs/
   PHPRunner-Plugin-Development-Guide.md
/plugins/
   Select2/
   Multiselect2/
   DateRange/
   ...
```


