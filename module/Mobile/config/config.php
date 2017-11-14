<?php


return array(
    "cad-pet-form" => [
        'nm_pet'=>['is_required'=>null,'min_length'=>3],
        'id_usuario'=>['is_required'=>null],
        'id_raca'=>['is_required'=>null],
        'dt_nasc'=>['is_date'=>'Y-m-d'],
        'flag_porte'=>['is_required'=>null,'max_length'=>2,'contains'=>[1,2,3]]
    ],
    'agenda-form'=>[
        'id_pet'=>['is_required'=>null,'is_num'=>null],
        'id_usuario'=>['is_required'=>null,'is_num'=>null],
        'id_petshop'=>['is_required'=>null,'is_num'=>null],
        'id_servico'=>['is_required'=>null,'is_num'=>null],
        'dt_servico'=>['is_required'=>null,'is_date'=>'Y-m-d']
    ],
    'cad-user-form'=>[
        'nm_usuario'=>['is_required'=>null,'min_length'=>3],
        'em_email'=>['is_required'=>null,'is_email'=>null,'min_length'=>3],
        'pw_senha'=>['is_required'=>null,'min_length'=>2],

    ]
);