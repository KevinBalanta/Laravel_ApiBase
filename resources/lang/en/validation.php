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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'name' => [
            'required' => 'El nombre es requerido',
            'unique' => 'El nombre ya existe',
            'min' => 'El nombre debe contener mínimo :min caracteres'
        ],
        'area' => [
            'required' => 'El área es requerida',
            'numeric' => 'El área debe ser numérica en hectárea'
        ],
        'dropper_flow' => [
            'required' => 'el flujo del gotero es requerido',
            'numeric' => 'el flujo del gotero es numérico',
            'min' => 'el caudal del gotero debe ser de mínimo :min Litros/Hora'
        ],
        'dropper_separation' => [
            'required' => 'la separación entre goteros es requerida',
            'numeric' => 'La separación entre goteros es numérica',
            'min' => 'La separación entre goteros es de mínimo :min mts' 
        ],
        'irrigation_strategy_id' => [
            'required' => 'La estrategía de riego es requerida'
        ],
        'irrigation_amount_minutes' => [
            'required' => 'Los minutos de riego son requeridos',
            'numeric' => 'Los minutos de riego deben ser numéricos',
            'min' => 'Los minutos de riego deben ser mínimo :min minutos'
        ],
        'irrigation_frequency_days' => [
            'required' => 'La cantidad de días de riego es requerido',
            'numeric' => 'La cantidad de días de riego es numérica'
        ],
        
        'capacity' => [
            'required' => 'La capacidad es requerida',
            'min' => 'La capacidad debe ser mayor a :min'
        ],
        'uptake_time' => [
            'required' => 'El tiempo de captación es requerido',
            'min' => 'El tiempo de captación debe ser mayor a :min'
        ],
        'motorpump_brand' => [
            'required' => 'La marca de la motobomba es requerida',
            'min' => 'La marca debe contener mínimo :min caracteres'
        ],
        'motorpump_reference' => [
            'required' => 'La referencia de la motobomba es requerida',
            'min' => 'La referencia debe contener mínimo :min caracteres'
        ],
        'motorpump_hp' => [
            'required' => 'Los caballos de fuerza de la motobomba es requerido',
            'min' => 'Los caballos de fuerza de la motobomba deben ser de mínimo :min'
        ],
        'motorpump_flow' => [
            'required' => 'El caudal de la motobomba es requerido',
            'min' => 'El caudal de la motobomba deben ser mayor o igual a :min '
        ],
        'minimum_tension' => [
            'required' => 'La tensión mínima del sistema es requerida',
            'numeric' => 'La tensión mínima debe ser un número mayor o igual a cero kPa',
            'min' => 'La tensión mínima debe ser de mayor o igual a :min kPa'
        ],
        'maximum_tension' => [
            'required' => 'La tensión máxima del sistema es requerida',
            'numeric' => 'La tensión máxima debe ser un número menor o igual a 80 kPa',
            'max' => 'La tensión máxima debe ser menor o igual :max kPa'
        ],
        'maximum_level_water' => [
            'required' => 'El nivel máximo de agua del sistema es requerida',
            'numeric' => 'El nivel máximo de agua debe ser un número menor o igual a 100 M3',
            'max' => 'La tensión máxima debe ser menor o igual a :max M3'
        ],
        'minimum_level_water' => [
            'required' => 'El nivel mínimo de agua del sistema es requerida',
            'numeric' => 'El nivel mínimo de agua debe ser un número mayor o igual a 20 M3',
            'min' => 'La tensión mínima debe ser mayor o igual a :max M3'
        ],
        'start_time' => [
            'required' => 'El tiempo de inicio del sistema es requerido',
        ],
        'end_time' => [
            'required' => 'El tiempo de finalización del sistema es requerido',
            'after' => 'El tiempo de finalización debe ser despues del tiempo de inicialización del sistema'
        ],
        'lamina' => [
            'required' => 'La lámina de agua es requerida',
            'numeric' => 'La lámina de agua debe ser númerica',
            'between' => 'La lámina de agua debe estar entre 0% y 100% (0.0,1.0)'
        ],

        
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
