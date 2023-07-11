<?php
return [
    'base_url' => env('AN_BASE_URL','https://signaturesrv.metadockit.com/'),
    'ref_entity' => env('AN_REF_ENTITY',\App\Models\Dossier::class),
    'component_name' => env('AN_COMPONENT_NAME','annotations'),
    'main_table_name' => env('AN_TABLE_NAME','an_annotations')
];
