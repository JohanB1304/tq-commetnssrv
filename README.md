# tq-commetnssrv
<p align="center">
  <img style="text-align: center;" src="https://www.tiqal.com/wp-content/uploads/2019/09/Offc_TQ_Logo_color-300x148.png">
</p>

[![Demo](https://img.shields.io/badge/demo-online-ed1c46.svg)](https://ngx-scrollbar.netlify.com/)
[![License](https://img.shields.io/npm/l/express.svg?maxAge=2592000)](/LICENSE)

## Table of contents

Components for Tiqal.
1. [Installation](#installation)
1. [Basic usage](#example-basic)
    - [Notification component](#example-notification-component)
    - [Task component](#example-task-component)  
1. [Settings](#setting-task-component)
    - [Notification component](#setting-notification-component)
    - [Task component](#setting-task-component)

## <a name="installation"></a> Installation:
**Install Dependencies**
```bash
$ @ng-bootstrap/ng-bootstrap@14.1.1 --save
```
```bash
$ @popperjs/core@2.11.7 --save
```
```bash
$ bootstrap@5.2.3 --save
```
```bash
$ @types/dragula@2.1.36 --save
```
```bash
$ dragula@3.7.3 --save
```
```bash
$ ng2-dragula@3.2.0 --save
```
```bash
$ moment@2.29.4 --save
```
```bash
$ moment-timezone@0.5.43 --save
```
```bash
$ ngx-scrollbar@11.0.0 --save
```
```bash
$ ngx-autosize@2.0.4 --save
```

**Install This Library**
```bash
$ npm install tiqal
```

## <a name="example-basic"></a>Use Example:
Add the declaration to your @NgModule:
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

## <a name="setting-task-component"></a>Settings

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
