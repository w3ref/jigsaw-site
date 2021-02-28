---
extends: _layouts.documentation
section: documentation_content
---

## Установка

### Системные Требования

Чтобы использовать Jigsaw, на Вашем компьютере должны быть установлены PHP (минимальная версия 7.3) и [Composer](https://getcomposer.org/). Вам также необязательно потребуется установить Node.js и NPM, если Вы хотите использовать [Laravel Mix](https://laravel.com/docs/7.x/mix) для компиляции CSS и Javascript.

---

### 1. Создать каталог проекта

Сначала создайте новый каталог для своего сайта:

```
$ mkdir my-site
```

### 2. Установите Jigsaw через Composer

Затем перейдите в каталог Вашего нового проекта и установите Jigsaw с помощью Composer:

```
$ cd my-site
$ composer require tightenco/jigsaw
```

### 3. Инициализируйте свой проект

Наконец, из каталога Вашего проекта запустите команду Jigsaw `init`, чтобы сформировать структуру каталогов по умолчанию:

```
$ ./vendor/bin/jigsaw init
```

В качестве альтернативы, быстро приступите к работе, используя [стартовый шаблон](/docs/starter-templates), который открывает вам полностью сконфигурированный, профессионально разработанный сайт, готовый к настройке с вашим контентом. Вы можете использовать один из встроенных шаблонов Jigsaw для блога или сайта документации с открытым исходным кодом или [использовать сторонний шаблон](/docs/starter-templates#установка-стороннего-начального-шаблона).

```
$ ./vendor/bin/jigsaw init blog
```

или

```
$ ./vendor/bin/jigsaw init docs
```

---

### Структура каталогов

По умолчанию Jigsaw предоставляет следующую структуру каталогов:

<div class="files">
    <div class="folder folder--open">source
        <div class="folder folder--open">_assets
            <div class="folder folder--open">js
                <div class="file">main.js</div>
            </div>
            <div class="folder folder--open">sass
                <div class="file">main.scss</div>
            </div>
        </div>
        <div class="folder folder--open">_layouts
            <div class="file">master.blade.php</div>
        </div>
        <div class="folder folder--open">assets
            <div class="folder folder--open">build
                <div class="folder folder--open">js
                    <div class="file">main.js</div>
                </div>
                <div class="folder folder--open">sass
                    <div class="file">main.css</div>
                </div>
                <div class="file">mix-manifest.json</div>
            </div>
            <div class="folder folder--open">images
                <div class="file">jigsaw.png</div>
            </div>
        </div>
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

Каталог `/source` содержит фактическое содержимое Вашего сайта. Здесь будут храниться все страницы Вашего сайта, CSS, Javascript, изображения и т. д.

В корне каталога Jigsaw предоставляет файл `config.php`, в котором Вы можете указать параметры конфигурации для своего сайта, а также `webpack.mix.js` для настроек, связанных с компиляцией Ваших ресурсов.

Затем узнайте о [создании и предварительном просмотре Вашего сайта](/docs/building-and-previewing).

---
<div class="pt-3"></div>

> Почему в `/source` есть два каталога `assets`, один с префиксом подчеркивания? Узнайте в разделе [Компиляция ресурсов](/docs/compiling-assets) section.
