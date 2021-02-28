---
extends: _layouts.documentation
section: documentation_content
---

## Переменные сайта

Все, что Вы добавляете в массив в `config.php`, будет доступно во всех Ваших шаблонах как свойство объекта `$page`.

Например, если Ваш файл `config.php` выглядит так:

```php
<?php

return [
    'contact_email' => 'support@example.com',
];
```

...Вы можете использовать эту переменную в любом из Ваших шаблонов следующим образом:

```
@extends('_layouts.master')

@section('content')
    <p>Свяжитесь с нами по {{ $page->contact_email }}</p>
@stop
```

При желании переменные сайта также могут быть доступны в виде массивов:

```
<p>Свяжитесь с нами по {{ $page['contact_email'] }}</p>
```

Jigsaw также поддерживает переменные сайта, зависящие от среды, о которых Вы можете узнать больше [здесь](/docs/environments/).

