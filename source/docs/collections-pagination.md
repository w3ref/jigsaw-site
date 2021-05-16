---
extends: _layouts.documentation
section: documentation_content
---

#### [Коллекции](/docs/collections)
## Пагинация

Вы можете создать шаблон Blade, который отображает элементы Вашей коллекции в формате с разбивкой на страницы, включив ключ `pagination` в обложку YAML шаблона. Заголовок разбивки на страницы должен включать имя коллекции `collection` и счетчик `perPage`:


> _posts.blade.php_

```
---
pagination:
  collection: posts
  perPage: 5
---
@extends('_layouts.master')
...
```

> Если вы не указали значение `perPage` в своем шаблоне, значение по умолчанию может быть установлено для конкретной коллекции, добавив ключ `perPage` в настройки коллекции в `config.php`, или глобально, добавив ключ `perPage` к верхнему уровню `config.php`. В противном случае значение по умолчанию будет 10.

Как только в заголовке будет определена `pagination`, шаблон получит доступ к специальной переменной `$pagination`, которая имеет несколько атрибутов:

- `$pagination->items` содержит массив элементов коллекции для текущей страницы
- `$pagination->currentPage` содержит номер текущей страницы
- `$pagination->totalPages` содержит общее количество страниц
- `$pagination->pages` содержит массив путей к каждой странице

> Обратите внимание, что страницы `pages` индексируются по их номерам, т.е. они начинаются с 1. Таким образом, Вы можете ссылаться на пути страницы по номеру страницы, т.е. `$pagination->page[1]` вернет путь к первой странице.

- `$pagination->first` содержит путь к первой странице (аналогично `$pagination->path[1]`)
- `$pagination->last` содержит путь к последней странице
- `$pagination->next` содержит путь к следующей странице
- `$pagination->previous` содержит путь к предыдущей странице

Используя эти атрибуты `$pagination`, Вы можете создать набор кнопок и ссылок нумерации страниц:

```
@if ($previous = $pagination->previous)
    <a href="{{ $page->baseUrl }}{{ $pagination->first }}">&lt;&lt;</a>
    <a href="{{ $page->baseUrl }}{{ $previous }}">&lt;</a>
@else
    &lt;&lt; &lt;
@endif

@foreach ($pagination->pages as $pageNumber => $path)
    <a href="{{ $page->baseUrl }}{{ $path }}"
        class="{{ $pagination->currentPage == $pageNumber ? 'selected' : '' }}">
        {{ $pageNumber }}
    </a>
@endforeach

@if ($next = $pagination->next)
    <a href="{{ $page->baseUrl }}{{ $next }}">&gt;</a>
    <a href="{{ $page->baseUrl }}{{ $pagination->last }}">&gt;&gt;</a>
@else
    &gt; &gt;&gt;
@endif
```

Чтобы отобразить элементы на каждой странице, выполните итерацию по коллекции `$pagination->items`:

```
@foreach ($pagination->items as $post)
    <h3><a href="{{ $post->getUrl() }}">{{ $post->title }}</a></h3>
    <p class="text-sm">by {{ $post->author }} • {{ date('F j, Y', $post->date) }}</p>
    <div>{!! $post->getContent() !!}</div>
@endforeach
```
