---
extends: _layouts.documentation
section: documentation_content
---

#### [Создание контента Вашего сайта](/docs/content)
## Шаблоны и части в Blade

Одним из самых больших преимуществ языка шаблонов является возможность создавать переиспользуемые макеты и частичные. Jigsaw дает Вам доступ ко всем функциям шаблонов и управляющим структурам Blade, которые доступны в Laravel (дополнительные сведения о макетах Blade смотрите в [официальной документации Blade](https://laravel.com/docs/7.x/blade)).

### Определение макета

Сами макеты - это просто базовые шаблоны Blade, которые имеют один или несколько вызовов `@yield`, где дочерние шаблоны могут отображать свое содержимое.

Базовый главный макет может выглядеть так:

```
<!DOCTYPE html>
<html>
    <head>
        <title>Удивительная паутина</title>
    </head>
    <body>
        <header>
            Мой удивительный сайт
        </header>

        @yield('content')

        <footer>
            <p>©2016 Удивительная Компания</p>
        </footer>
    </body>
</html>
```

В Jigsaw прямо из коробки есть каталог `/source/_layouts` с основным макетом.

### Расширение макета

Чтобы расширить макет, создайте шаблон, который указывает, какой макет расширять в директиве `@extends`, и какие разделы необходимо заполнить с помощью директивы `@section`:

```
@extends('_layouts.master')

@section('content')
    <div>
        <p>Содержание моей замечательной домашней страницы.</p>
    </div>
@endsection
```

Макеты и частичные данные указываются относительно каталога `source` с использованием _точечной нотации_, где каждая точка представляет собой разделитель каталогов в имени файла, а расширение `.blade.php` опускается.

### Частичные шаблоны

Чтобы включить шаблон в другой шаблон, используйте директиву `@include`:

```
<!DOCTYPE html>
<html>
    <head>
        <title>Удивительная паутина</title>
    </head>
    <body>
        @include('_partials.header')

        @yield('content')

        @include('_partials.footer')
    </body>
</html>
```

Вы можете передать данные в частичные шаблоны, передав ассоциативный массив в качестве второго параметра:

```
<!DOCTYPE html>
<html>
    <head>
        <title>Удивительная паутина</title>
    </head>
    <body>
        @include('_partials.header', ['page_title' => 'My Amazing Site'])

        @yield('content')

        @include('_partials.footer')
    </body>
</html>
```

Затем эти данные доступны в Вашем частичном шаблоне как обычная переменная:

```
<!-- _partials/header.blade.php -->
<header>
    {{ $page_title }}
</header>
```

### Компоненты

Jigsaw поддерживает как классовые, так и анонимные компоненты Blade.

Для отображения компонента Вы можете использовать тег компонента Blade в одном из Ваших шаблонов Blade. Теги компонентов Blade начинаются со строки x-, за которой следует имя кебаба класса компонента:

```
<x-input />
```

В Jigsaw представления автоматически обнаруживаются из каталога `source/_components`; чтобы создать анонимные компоненты в стиле `<x-`, Вам нужно только поместить шаблон Blade в этот каталог.

Компоненты на основе классов могут быть зарегистрированы вручную с помощью `$bladeCompiler->component()`, как подробно описано в разделе [расширение Blade с помощью пользовательских директив](#расширение-blade-с-помощью-настраиваемых-директив) ниже; или они могут быть обнаружены автоматически с помощью пространства имен `Components`. Чтобы автоматически загружать компоненты на основе классов, которые используют пространство имен `Components`, добавьте запись `autoload` в свой файл `composer.json`:

> _composer.json_

```
"autoload": {
    "psr-4": {
        "Components\\": "where/you/want/to/keep/component/classes/"
    }
}
```

...а затем обновите ссылки автозагрузки Composer, запустив `composer dump-autoload` в Вашем терминале.

### Предотвращение рендеринга макетов, частичных шаблонов и компонентов

Поскольку важно, чтобы макеты, части и компоненты никогда не рендерились сами по себе, Вам необходимо указать Jigsaw, когда файл не должен отображаться.

Чтобы предотвратить рендеринг файла или папки, просто поставьте перед ними знак подчеркивания:

<div class="files">
    <div class="folder folder--open">source
        <div class="folder">_assets</div>
        <div class="folder folder--open focus">_layouts
            <div class="file">master.blade.php</div>
        </div>
        <div class="folder">assets</div>
        <div class="file">index.blade.php</div>
    </div>
    <div class="ellipsis">...</div>
</div>

По умолчанию Jigsaw предоставляет Вам каталог `/_layouts`, но Вы можете создавать любые файлы или каталоги, которые Вам нужны; все, что имеет префикс с подчеркиванием, не будет отображаться непосредственно в `/build_local`.

Например, если Вам нужно место для хранения всех Ваших частичных данных, Вы можете создать каталог с именем `_partials`:

<div class="files">
    <div class="folder folder--open">source
        <div class="folder">_assets</div>
        <div class="folder">_layouts</div>
        <div class="folder folder--open focus">_partials
            <div class="file">footer.blade.php</div>
            <div class="file">header.blade.php</div>
        </div>
        <div class="folder">assets</div>
        <div class="file">index.blade.php</div>
    </div>
    <div class="ellipsis">...</div>
</div>

Поскольку каталог `_partials` начинается с символа подчеркивания, эти файлы не будут отображаться при создании Вашего сайта, но по-прежнему будут доступны для `@include` в других Ваших шаблонах.

---

### Расширение Blade с помощью настраиваемых директив

Jigsaw дает Вам возможность расширить Blade с помощью [настраиваемых директив](https://laravel.com/docs/7.x/blade#extending-blade), так же, как Вы можете с Laravel. Для этого создайте файл `blade.php` на корневом уровне Вашего проекта Jigsaw (на том же уровне, что и `config.php`), и верните массив директив с ключом имени директивы, каждая из которых возвращает замыкание.

Например, Вы можете создать специальную директиву `@datetime($timestamp)` для форматирования данной целочисленной метки времени как даты в Ваших шаблонах Blade:

> _blade.php_

```
return [
    'datetime' => function ($timestamp) {
        return '<?php echo date("l, F j, Y", ' . $timestamp . '); ?>';
    }
];
```

В качестве альтернативы файл `blade.php` получает переменную с именем `$bladeCompiler`, которая предоставляет экземпляр `\Illuminate\View\Compilers\BladeCompiler`. С его помощью Вы можете создавать собственные директивы Blade, [компоненты с псевдонимами](https://laravel.com/docs/7.x/blade#extending-blade) с именами `@include` или другие расширенные управляющие структуры Blade:

> _blade.php_

```php
<?php

/** @var \Illuminate\View\Compilers\BladeCompiler $bladeCompiler */

$bladeCompiler->directive('datetime', function ($timestamp) {
    return '<?php echo date("l, F j, Y", ' . $timestamp . '); ?>';
});

$bladeCompiler->aliasComponent('_components.alert');

$bladeCompiler->include('includes.copyright');
```

> _page.blade.php_

```php
/** до */

@component('_components.alert')
    Pay attention to this!
@endcomponent

@include('_partials.meta.copyright', ['year' => '2021'])


/** после */

@alert
    Pay attention to this!
@endalert

@copyright(['year' => '2021'])
```

---

### Указание путей подсказки Blade

Чтобы использовать пути/пространства имен Blade-подсказок в разметке (например, `email:components::section`), укажите путь к каталогу с помощью ключа `viewHintPaths` в `config.php`:

> _config.php_

```php
<?php

return [
    'viewHintPaths' => [
        'email:templates' => __DIR__.'/source/_layouts',
        'email:components' => __DIR__.'/source/_components',
        'email:partials' => __DIR__.'/source/_partials'
    ]
];
```
