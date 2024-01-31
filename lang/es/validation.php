<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

'accepted' => 'El campo :attribute debe ser aceptado.',

'accepted_if' => 'El campo :attribute debe ser aceptado cuando :other es :value.',

'active_url' => 'El campo :attribute debe contener una URL válida.',

'after' => 'El campo :attribute debe contener una fecha posterior a :date.',

'after_or_equal' => 'El campo :attribute debe contener una fecha posterior o igual a :date.',

'alpha' => 'El campo :attribute sólo debe contener letras.',

'alpha_dash' => 'El campo :attribute sólo debe contener letras, números, guiones y guiones bajos.',

'alpha_num' => 'El campo :attribute sólo debe contener letras y números.',

'array' => 'El campo :attribute debe ser una matriz.',

'ascii' => 'El campo :attribute sólo debe contener caracteres alfanuméricos de un byte y símbolos.',

'before' => 'El campo :attribute debe ser una fecha anterior a :date.',

'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',

'between' => [
'array' => 'El campo :attribute debe tener entre :min y :max elementos.',
'file' => 'El campo :attribute debe estar entre :min y :max kilobytes.',
'numeric' => 'El campo :attribute debe estar entre :min y :max.',
'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
],

'boolean' => 'El campo :attribute debe ser verdadero o falso.',

'can' => 'El campo :attribute contiene un valor no autorizado.',

'confirmed' => 'La confirmación de :attribute no coincide.',

'current_password' => 'La contraseña es incorrecta.',

'date' => 'El campo :attribute no contiene una fecha válida.',

'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',

'date_format' => 'El campo :attribute no coincide con el formato :format.',

'decimal' => 'El campo :attribute debe tener :decimal lugares decimales.',

'declined' => 'El campo :attribute debe ser rechazado.',

'declined_if' => 'El campo :attribute debe ser rechazado cuando :other es :value.',

'different' => 'Los campos :attribute y :other deben ser diferentes.',

'digits' => 'El campo :attribute debe tener :digits dígitos.',

'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',

'dimensions' => 'El campo :attribute tiene dimensiones de imagen no válidas.',

'distinct' => 'El campo :attribute contiene un valor duplicado.',

'doesnt_end_with' => 'El campo :attribute no debe finalizar con uno de los siguientes valores: :values',

'doesnt_start_with' => 'El campo :attribute no debe comenzar con uno de los siguientes valores: :values',

'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',

'ends_with' => 'El campo :attribute debe finalizar con uno de los siguientes valores: :values',

'enum' => 'El :attribute seleccionado no es válido.',

'exists' => 'El :attribute seleccionado no es válido.',

'extensions' => 'El campo :attribute debe tener una de las siguientes extensiones: :values.',

'file' => 'El campo :attribute debe ser un archivo.',

'filled' => 'El campo :attribute es obligatorio.',

'gt' => [
'array' => 'El campo :attribute debe tener más de :value elementos.',
'file' => 'El campo :attribute debe tener más de :value kilobytes.',
'numeric' => 'El campo :attribute debe ser mayor que :value.',
'string' => 'El campo :attribute debe tener más de :value caracteres.',
],

'gte' => [
'array' => 'El campo :attribute debe tener como mínimo :value elementos.',
'file' => 'El campo :attribute debe tener como mínimo :value kilobytes.',
'numeric' => 'El campo :attribute debe ser mayor o igual que :value.',
'string' => 'El campo :attribute debe tener como mínimo :value caracteres.',
],

'hex_color' => 'El campo :attribute debe ser un color hexadecimal válido.',

'image' => 'El campo :attribute debe ser una imagen.',

'in' => 'El :attribute seleccionado no es válido.',

'in_array' => 'El campo :attribute no existe en :other.',

'integer' => 'El campo :attribute debe ser un número entero.',

'ip' => 'El campo :attribute debe contener una dirección IP válida.',

'ipv4' => 'El campo :attribute debe contener una dirección IPv4 válida.',

'ipv6' => 'El campo :attribute debe contener una dirección IPv6 válida.',

'json' => 'El campo :attribute debe contener una cadena JSON válida.',

'lowercase' => 'El campo :attribute debe estar en minúsculas.',

'lt' => [
'array' => 'El campo :attribute debe tener menos de :value elementos.',
'file' => 'El campo :attribute debe tener menos de :value kilobytes.',
'numeric' => 'El campo :attribute debe ser menor que :value.',
'string' => 'El campo :attribute debe tener menos de :value caracteres.',
],

'lte' => [
'array' => 'El campo :attribute no debe tener más de :value elementos.',
'file' => 'El campo :attribute debe pesar menos o igual que :value kilobytes.',
'numeric' => 'El campo :attribute debe ser menor o igual que :value.',
'string' => 'El campo :attribute debe tener menos o igual que :value caracteres.',
],

'mac_address' => 'El campo :attribute debe contener una dirección MAC válida.',

'max' => [
'array' => 'El campo :attribute no puede tener más de :max elementos.',
'file' => 'El campo :attribute no puede ser mayor que :max kilobytes.',
'numeric' => 'El campo :attribute no puede ser mayor que :max.',
'string' => 'El campo :attribute no puede ser mayor que :max caracteres.',

],

'max_digits' => 'El campo :attribute no debe tener más de :max dígitos.',

'mimes' => 'El campo :attribute debe ser un archivo con formato: :values.',

'mimetypes' => 'El campo :attribute debe ser un archivo con formato: :values.',

'min' => [
'array' => 'El campo :attribute debe tener al menos :min elementos.',
'file' => 'El campo :attribute debe tener al menos :min kilobytes.',
'numeric' => 'El campo :attribute debe ser al menos :min.',
'string' => 'El campo :attribute debe tener al menos :min caracteres.',
],

'min_digits' => 'El campo :attribute debe tener al menos :min dígitos.',

'missing' => 'El campo :attribute debe estar en falta.',

'missing_if' => 'El campo :attribute debe estar en falta cuando :other es :value.',

'missing_unless' => 'El campo :attribute debe estar en falta a menos que :other esté en :values.',

'missing_with' => 'El campo :attribute debe estar en falta cuando :values está presente.',

'missing_with_all' => 'El campo :attribute debe estar en falta cuando :values están presentes.',

'multiple_of' => 'El campo :attribute debe ser múltiplo de :value',

'not_in' => 'El :attribute seleccionado no es válido.',

'not_regex' => 'El formato del campo :attribute no es válido.',

'numeric' => 'El campo :attribute debe ser numérico.',

'password' => [


'letters' => 'El campo :attribute debe contener al menos una letra.',

'mixed' => 'El campo :attribute debe contener al menos una mayúscula y una minúscula.',

'numbers' => 'El campo :attribute debe contener al menos un número.',

'symbols' => 'El campo :attribute debe contener al menos un símbolo.',

'uncompromised' => 'El :attribute proporcionado ha aparecido en un data leak. Por favor elija un :attribute diferente.',
],

'present' => 'El campo :attribute debe estar presente.',

'present_if' => 'El campo :attribute debe estar presente cuando :other es :value.',

'present_unless' => 'El campo :attribute debe estar presente a menos que :other sea :value.',

'present_with' => 'El campo :attribute debe estar presente cuando :values está presente.',

'present_with_all' => 'El campo :attribute debe estar presente cuando :values están presentes.',

'prohibited' => 'El campo :attribute está prohibido.',

'prohibited_if' => 'El campo :attribute está prohibido cuando :other es :value.',

'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other esté en :values.',

'prohibits' => 'El campo :attribute prohíbe que :other esté presente.',

'regex' => 'El formato del campo :attribute es inválido.',

'required' => 'El campo :attribute es obligatorio.',

'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',

'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',

'required_if_accepted' => 'El campo :attribute es obligatorio cuando :other es aceptado.',

'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',

'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',

'required_with_all' => 'El campo :attribute es obligatorio cuando :values están presentes.',

'required_without' => 'El campo :attribute es obligatorio cuando :values no esté presente.',

'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estén presentes.',

'same' => 'El campo :attribute y :other deben coincidir.',

'size' => [


'array' => 'El campo :attribute debe contener :size elementos.',

'file' => 'El campo :attribute debe tener :size kilobytes.',

'numeric' => 'El campo :attribute debe ser :size.',

'string' => 'El campo :attribute debe tener :size caracteres.',
],

'starts_with' => 'El campo :attribute debe comenzar con uno de los siguientes valores: :values',

'string' => 'El campo :attribute debe ser una cadena de caracteres.',

'timezone' => 'El campo :attribute debe ser una zona horaria válida.',

'unique' => ':attribute ya ha sido registrado.',

'uploaded' => 'Subir :attribute ha fallado.',

'uppercase' => 'El campo :attribute debe estar en mayúsculas.',

'url' => 'El campo :attribute debe ser una URL válida.',

'uuid' => 'El campo :attribute debe ser un UUID válido.',

'ulid' => 'El campo :attribute debe ser un ULID válido.',

'custom' => [
'nombre-atributo' => [
    'nombre-regla' => 'mensaje-personalizado',
],

'attributes' => []

],
];


