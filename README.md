# tq-commetnssrv
<p align="center">
  <img style="text-align: center;" src="https://www.tiqal.com/wp-content/uploads/2019/09/Offc_TQ_Logo_color-300x148.png">
</p>

[![Demo](https://img.shields.io/badge/demo-online-ed1c46.svg)](https://ngx-scrollbar.netlify.com/)
[![License](https://img.shields.io/npm/l/express.svg?maxAge=2592000)](/LICENSE)

## Table of contents

Components for Tiqal.
1. [Installation](#installation)
1. [Settings](#setting-annotation-component)
1. [Endpoints](#enpoints)
    - [Notification component](#example-notification-component)
    - [Task component](#example-task-component)  


## <a name="installation"></a> Installation:

**Use the following command to install with composer.**
```bash
composer require tq-commentssrv/tq-commentssrv
```
Register the service provider in your `config/app.php` configuration file:

```php
'providers' => [
    ...
    TqCommentssrv\TqCommentssrv\AnnotationsServiceProvider::class,
],
```

Run the following command to publish the package config file, models files and routes for the the api:
```bash
php artisan vendor:publish --provider="TqCommentssrv\TqCommentssrv\AnnotationsServiceProvider"
```

## <a name="setting-annotation-component"></a>Settings
In the published config file annotation.php you can set the following config values:

```  'base_url'  ``` means the application URL.</br>
```  'ref_entity'  ``` means the reference class to associate the annotations.</br>
```  'component_name'  ``` means the component name.</br>
```  'main_table_name'  ``` means the name for the table main table.</br>
```php
return [
    'base_url' => env('AN_BASE_URL','https://signaturesrv.metadockit.com/'),
    'ref_entity' => env('AN_REF_ENTITY',\App\Models\Dossier::class),
    'component_name' => env('AN_COMPONENT_NAME','annotations'),
    'main_table_name' => env('AN_TABLE_NAME','an_annotations')
];
```

## <a name="endpoints"></a>Endpoints:
The following endpoints are going to be available four it usage:

- Index annotations</br>
  Method: GET</br>
  Path: api/{slug_tenant}/annotation/{ref_id}</br>
  Parameters:
    - slug_tenant: Slug tenant of the authenticated user.
    - ref_id: Id of the reference entity associated to the annotation.
  </br>
  Responses:
      200:
```json
{
  "data":[
    {
      "id": "999f4afb-8c7f-454e-bc5e-8f234634cc53",
      "ref_id": "263b3243-8428-42c6-a71e-0973b9cf95cd",
      "user_id": "06c5b85c-6e27-43dd-b68a-feac2aa8f80e",
      "comment": "prueba reunión",
      "created_at": "2023-07-11 11:52:48",
      "updated_at": "2023-07-11 16:52:48",
    }
  ],
  "status_code": "200",
  "message": "ok"
}
```
    - 400:
```json
{
  "status_code": "400",
  "message": "Bad request"
}
```
</br>
- Store:
  Method: POST</br>
  Path: api/{slug_tenant}/annotation/{ref_id}</br>
  Parameters:
    - slug_tenant: Slug tenant of the authenticated user.
    - ref_id: Id of the reference entity associated to the annotation.
  </br>
  Request body:
```json
{
  "comment": "string"
}
```
  </br>
    
  responses:
  
    - 200:
```json
{
  "data":[
    {
      "id": "999f4afb-8c7f-454e-bc5e-8f234634cc53",
      "ref_id": "263b3243-8428-42c6-a71e-0973b9cf95cd",
      "user_id": "06c5b85c-6e27-43dd-b68a-feac2aa8f80e",
      "comment": "prueba reunión",
      "created_at": "2023-07-11 11:52:48",
      "updated_at": "2023-07-11 16:52:48",
      "author": {}
    }
  ],
  "status_code": "200",
  "message": "ok"
}
```

-GetTotal unread messages:
  Method: GET</br>
  Path: api/{slug_tenant}/annotation/{ref_id}/get_qty_messages_unread</br>
  Parameters:
    - slug_tenant: Slug tenant of the authenticated user.
    - ref_id: Id of the reference entity associated to the annotation.
  </br>
  Responses:
      200:
```json
{
  "total": 5,
  "status_code": "200",
  "message": "ok"
}
```
    - 400:
```json
{
  "status_code": "400",
  "message": "Bad request"
}

