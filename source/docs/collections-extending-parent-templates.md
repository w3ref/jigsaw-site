---
extends: _layouts.documentation
section: documentation_content
---

#### [Коллекции](/docs/collections)
## Расширение родительских шаблонов

Чтобы отображать каждый из элементов Вашей коллекции на отдельной странице, Вам необходимо указать родительский шаблон. Вы можете сделать это с помощью ключа `extends` в разделе YAML или с помощью директивы `@extends` в файле Blade:

> _my-first-post.md_

```
---
extends: _layouts.post
title: Моя первая запись в блоге
author: Keith Damiani
date: 2017-03-23
section: content
---

Этот пост *глубоко* интересен.
```

> _my-second-post.blade.php_

```
---
title: Моя вторая запись в блоге
author: Keith Damiani
date: 2017-03-25
section: content
---
@extends ('_layouts.post')

Это второй <strong>потрясающий</strong> пост от {{ $page->author }}.
```

### Элементы коллекции без родительского шаблона

Однако родительские шаблоны для элементов коллекции необязательны. В некоторых случаях - например, для коллекции биографий сотрудников, которые появляются на странице «О нас», Вам может не понадобиться отображать каждый из элементов Вашей коллекции на отдельных страницах. Для этого просто опустите ключ `extends` из основного материала YAML или директиву `@extends` из файла Blade.


### Элементы коллекции с несколькими родительскими шаблонами

Элементы коллекции также могут расширять _множественные_ родительские шаблоны, определяя шаблоны как массив в ключе `extends` во вступительной части YAML. Это будет генерировать отдельный URL для каждого шаблона, что позволяет, например, элементу коллекции иметь как конечные точки `/web/item` и `/api/item`, так и представления `/summary` и `/detail`.

> __people/abraham-lincoln.md_

```
---
name: Абрахам Линкольн
role: Президент
number: 16
extends:
  web: _layouts.person
  api: _layouts.api.person
section: content
---
...
```

> __layouts.person.blade.php_

```
@extends('_layouts.master')

@section('body')
    <header>
        <h1>{{ $page->name }}</h1>
        <h2>{{ $page->role }}</h2>
    </header>

    @yield('content')
@endsection
```

> __layouts.api.person.blade.js_

```
{!! ($page->api()) !!}
```


При использовании нескольких родительских шаблонов Вы можете указать отдельные пути в `config.php` для каждой полученной страницы:

> _config.php_

```
<?php

use Illuminate\Support\Str;

return [
    'collections' => [
        'people' => [
            'path' => [
                'web' => 'people/{number}/{filename}',
                'api' => 'people/api/{number}/{filename}',
            ],
            'api' => function ($page) {
                return [
                    'slug' => Str::slug($page->getFilename()),
                    'name' => $page->name,
                    'number' => $page->number,
                    'content' => $page->getContent(),
                ];
            },
        ],
    ],
];
```
