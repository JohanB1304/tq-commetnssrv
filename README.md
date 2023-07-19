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


```typescript
import { TiqalModule } from 'tiqal';
...
@NgModule({
  imports: [
    TiqalModule.forRoot({
      url: ''
    })
  ]
})
```

**<a name="example-notification-component"></a> Notification component**
```
<tiqal-notification></tiqal-notification>
```

Use directly inside your HTML templates

**<a name="example-task-component"></a> Task component**
```
<tiqal-task></tiqal-task>
```

## <a name="setting-annotation-component"></a>Settings

## <a name="setting-notification-component"></a>Notification component
Name  | Default | Type | Description
--- | --- | --- | ---
config | `None` | `<TiqalConfig>` | Configuration
disabled | `false` | `boolean` | Enable or disable component
minRows | `2` | `integer` | Sets minimal amount of rows of the textarea
maxRows | `5` | `integer` | Sets maximum amount of rows of the textarea
maxLength | `1000` | `integer` | Sets the maximum number of characters
tenantId | `1000` | `string` | Sets TenantId


## Events / Outputs
Name  | Description
--- | ---
event | Called whenever component performs an action

## <a name="setting-task-component"></a>Task component
