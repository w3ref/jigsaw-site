---
extends: _layouts.documentation
section: documentation_content
---

#### [Создание контента Вашего сайта](/docs/content)
## Язык Разметки - Markdown

Есть ли страницы, которые Вы бы предпочли писать в Markdown, чем в Blade? [Мы знаем это чувство](https://github.com/tighten/jigsaw-site/tree/master/source/docs).

Использовать Markdown в Jigsaw так же просто, как использовать расширение ` .markdown` или `.md` и указать некоторые детали во вступительной части YAML.

Например, предположим, что у Вас есть этот макет и Вы хотите заполнить раздел `content` с помощью Markdown:

```html
<html>
    <head>...</head>
    <body>
        @yield('content')
    </body>
</html>
```

Если бы этот макет был назван `master` в папке `_layouts`, Вы могли бы создать страницу Markdown, которая использовала бы этот макет следующим образом:

```markdown
---
extends: _layouts.master
section: content
---

# Мой классный заголовок!

Мой потрясающий контент!
```

Конечным результатом будет сгенерированная страница, которая выглядела бы так:

```html
<html>
    <head>...</head>
    <body>
        <h1>Мой классный заголовок!</h1>
        <p>Мой потрясающий контент!</p>
    </body>
</html>
```

### Пользовательские переменные содержимого фасада

Представьте, что у Вас есть макет с именем `post.blade.php` в папке `_layouts`, который выглядит следующим образом:

> __layouts/post.blade.php_

```html
@extends('_layouts.master')

@section('content')
    <h1>{{ $page->title }}</h1>
    <h2>by {{ $page->author }}</h2>

    @yield('postContent')
@endsection
```

Вы можете заполнить переменные `title` и `author`, добавив настраиваемые ключи в заголовок YAML:

> _my-post.md_

```markdown
---
extends: _layouts.post
section: postContent
title: "Jigsaw потрясающий!"
author: "Адам Уотан"
---

Jigsaw - один из лучших генераторов статических сайтов всех времен.
```

...which would generate this:

```html
<html>
    <head>...</head>
    <body>
        <h1>Jigsaw потрясающий!</h1>
        <h2>от Адама Уотана</h2>

        <p>
            Jigsaw - один из лучших генераторов статических сайтов всех времен.
        </p>
    </body>
</html>
```

<br>

### Форматирование дат

Процессор YAML преобразует любые даты, которые он находит в начальной части файла Markdown, в целочисленные временные метки. При выводе переменной даты в шаблоне Blade Вы можете использовать функцию `date()`, чтобы указать формат даты. Например:


> _my-post.md_

```markdown
---
extends: _layouts.post
section: postContent
date: 2021-02-28
---
```

> __layouts/post.blade.php_

```html
<p>Форматированная дата {{ date('d.m.Y', $post->date) }}</p>
```


<br>

### Указание постоянной ссылки

Вы можете указать `permalink` в начальной части YAML, чтобы переопределить путь по умолчанию к файлу при создании Вашего сайта. Это может быть использовано, например, для создания [пользовательской страницы 404](/docs/custom-404-page), которая выводится в `404.html` (вместо страницы по умолчанию `404/index.html`):

> _source/404.md_

```
---
extends: _layouts.master
section: content
permalink: 404.html
---

### Извините, данная страница не существует.
```

