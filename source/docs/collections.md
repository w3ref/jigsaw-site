---
extends: _layouts.documentation
section: documentation_content
---

## Коллекции

Jigsaw предоставляет мощные возможности для работы с группами связанных страниц или _коллекциями_. Коллекции дают Вам возможность получать доступ к Вашему контенту на агрегированном уровне, позволяя легко добавлять почти динамические функции, такие как меню, разбиение на страницы, категории и теги на Ваш статический сайт.

Коллекции можно использовать для создания страниц связанного контента - например, сообщений в блогах или статей, которые отсортированы по дате, с индексной страницей, отображающей сводку пяти самых последних сообщений, - или для встраивания связанных блоков содержимого _в_ страницу, для содержимого например, биографии сотрудников, описания продуктов или портфолио проектов.

### Определение коллекции

Чтобы определить коллекцию, добавьте в `config.php` массив с именем `collections`. Каждая коллекция должна обозначаться именем коллекции (обычно во множественном числе), за которым следует массив настроек. Например:

> _config.php_

```
<?php

return [
    'company' => 'Tighten',
    'contact_email' => 'support@tighten.co',
    'collections' => [
        'people' => [
            'path' => 'people',
            'sort' => 'last_name',
        ],
        'posts' => [
            'path' => 'blog/{date|Y-m-d}/{filename}',
            'author' => 'Tighten',
        ],
    ],
];
```

Jigsaw будет искать элементы коллекции в каталоге с тем же именем, что и Ваша коллекция, которому предшествует символ подчеркивания: в этом примере это `_people` и `_posts`. Элементы коллекции могут быть файлами Markdown или Blade или даже [гибридными Blade/Markdown](/docs/content-other-file-types) файлами.

<div class="files">
    <div class="folder folder--open">source
        <div class="folder">_assets</div>
        <div class="folder folder--open">_layouts
            <div class="file">master.blade.php</div>
            <div class="file">post.blade.php</div>
        </div>
        <div class="folder folder--open">_people
            <div class="file">george-michael-bluth.blade.php</div>
            <div class="file">j-walter-weatherman.blade.php</div>
            <div class="file">steve-holt.blade.php</div>
        </div>
        <div class="folder folder--open focus">_posts
            <div class="file">1-my-first-post.md</div>
            <div class="file">2-my-second-post.md</div>
            <div class="file">3-my-third-post.md</div>
        </div>
        <div class="folder">assets</div>
        <div class="file">about-us.blade.php</div>
        <div class="file">blog.blade.php</div>
        <div class="file">index.blade.php</div>
    </div>
    <div class="folder">tasks</div>
    <div class="folder">vendor</div>
    <div class="file">bootstrap.php</div>
    <div class="file">composer.json</div>
    <div class="file">composer.lock</div>
    <div class="file">config.php</div>
    <div class="file">package.json</div>
    <div class="file">webpack.mix.js</div>
</div>

В массив`config.php`, в котором Вы определяете свою коллекцию, может содержать параметры [путь](/docs/collections-paths) и [сортировка](/docs/collections-sorting) для коллекции, а также [переменные и вспомогательные функции](/docs/collections-variables-and-functions/). Однако ни один из этих элементов не требуется; если не указано, будут использоваться путь по умолчанию и настройки сортировки. Фактически, для простейшей конфигурации с использованием настроек по умолчанию и без переменных или функций Вы можете определить коллекцию просто по ее имени:

> _config.php_

```
<?php

return [
    'collections' => [ 'posts' ],
];
```

### Создание страниц коллекции

Если Вы хотите создать отдельную страницу для каждого из элементов коллекции, например страницу для каждого сообщения в блоге, укажите файл [родительский шаблон](/docs/collections-extending-parent-templates) в файле ключ `extends` в YAML или директивой `@extends` в файле Blade, как если бы Вы использовали обычную страницу Jigsaw. Например:

> _my-first-post.md_

```
---
extends: _layouts.post
title: Моя первая запись в блоге
author: Keith Damiani
date: 2021-02-28
section: content
---

Этот пост *глубоко* интересен.
```

> __layouts/post.blade.php_

```
@extends('_layouts.master')

@section('body')
    <h1>{{ $page->title }}</h1>
    <p>By {{ $page->author }} • {{ date('F j, Y', $page->date) }}</p>

    @yield('content')
@endsection
```

### Доступ к элементам коллекции

В любом шаблоне Blade у Вас есть доступ к каждой из Ваших коллекций, используя переменную с именем коллекции. Эта переменная ссылается на объект, который содержит все элементы в Вашей коллекции, и может повторяться для доступа к отдельным элементам коллекции. Переменная коллекции также ведет себя так, как если бы она была [Illuminate Collection](https://laravel.com/docs/7.x/collections) в Laravel, что означает, что у Вас есть доступ ко всем стандартным методам сбора Laravel, таким как `count()`, `filter()` и `where()`.

Например, чтобы создать список заголовков для всех Ваших сообщений в блоге, Вы можете перебрать объект `$posts` в цикле Blade `@foreach` и отобразить свойство `title`, которое Вы определили во вступительной части YAML каждого сообщения:

> _posts.blade.php_

```
<p>Всего постов: {{ $posts->count() }}</p>

<ul>
@foreach ($posts as $post)
    <li>{{ $post->title }}</li>
@endforeach
</ul>
```

Например, предполагая, что все сообщения имеют в своем YAML-фронте свойство `author`, чтобы отфильтровать все сообщения от определенного автора, Вы можете отфильтровать коллекцию `$posts` и создать новую коллекцию:

> _author\_posts.blade.php_

```
<?php
$authorPosts = $posts->filter(function ($value, $key) use ($page) {
    return $value->author == $page->author;
}); ?>
@if ($authorPosts->count() > 0)
<ul>
@foreach ($authorPosts as $post)
    <li>{{ $post->title }}</li>
@endforeach
</ul>
@endif
```

### Метаданные коллекции

Помимо [метаданных](/docs/page-metadata/), доступных для каждой страницы, таких как `getPath()`, `getUrl()` и `getFilename()`, элементы коллекции имеют доступ к нескольким дополнительным функции:

- `getContent()` возвращает основное содержимое элемента коллекции, то есть тело файла Markdown (в настоящее время `getContent()` доступен только для файлов Markdown)
- `getCollection()` возвращает имя коллекции
- `getPrevious()` и `getNext()` предоставляют вам соседние элементы в коллекции на основе [порядка сортировки](/docs/collections-sorting) коллекции по умолчанию
- `getFirst()` возвращает первый элемент коллекции (как и метод коллекции Laravel `first()`)
- `getLast()` возвращает последний элемент коллекции (как и метод коллекции Laravel `last()`)

> __layouts/post.blade.php_

```
@extends('_layouts.master')

@section('body')
    <h1>{{ $page->title }}</h1>

    @yield('content')

    @if ($page->getNext())
        <p>Прочтите мой следующий пост:
            <a href="{{ $page->getNext()->getPath() }}">{{ $page->getNext()->title }}</a>
        </p>
    @endif
@endsection
```
