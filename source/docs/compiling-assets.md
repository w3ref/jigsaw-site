---
extends: _layouts.documentation
section: documentation_content
---

## Компиляция ресурсов с помощью Laravel Mix

Сайты Jigsaw настроены с поддержкой [Laravel Mix](https://laravel.com/docs/7.x/mix) из коробки. Если Вы когда-либо использовали Mix в проекте Laravel, Вы уже знаете, как использовать Mix с Jigsaw.

---

### Настройка

Для начала убедитесь, что в Вашей среде установлены Node.js и NPM.

После установки Node.js и NPM подключите зависимости, необходимые для компиляции Ваших ресурсов:

```
$ npm install
```

Более подробные инструкции по установке смотрите в [полной документации Laravel Mix](https://laravel.com/docs/7.x/mix).

### Организация Ваших ресурсов

По умолчанию любые ресурсы, которые Вы хотите обработать с помощью Mix, должны находиться в `/source/_assets`:

<div class="files">
    <div class="folder folder--open">source
        <div class="folder folder--open focus">_assets
            <div class="folder folder--open">js
                <div class="file">app.js</div>
            </div>
            <div class="folder folder--open">css
                <div class="file">main.css</div>
            </div>
        </div>
        <div class="folder folder--open">_layouts
            <div class="file">master.blade.php</div>
        </div>
        <div class="folder folder--open">assets
            <div class="folder">build</div>
            <div class="folder folder--open">images
                <div class="file">jigsaw.png</div>
            </div>
        </div>
        <div class="file">index.blade.php</div>
    </div>
    <div class="folder">tasks</div>
    <div class="folder">vendor</div>
    <div class="ellipsis">...</div>
</div>

Mix ищет каждый тип ресурса _(например, CSS, JS, Sass, Less, и т.д.)_ в подкаталоге, названном в честь этого типа ресурса. Мы рекомендуем следовать этому соглашению, чтобы избежать дополнительной настройки.

По умолчанию, когда Webpack скомпилирует Ваши ресурсы, они будут помещены в соответствующие подкаталоги в `/source/assets/build`:

<div class="files">
    <div class="folder folder--open">source
        <div class="folder folder--open">_assets
            <div class="folder folder--open">js
                <div class="file">app.js</div>
            </div>
            <div class="folder folder--open">css
                <div class="file">main.css</div>
            </div>
        </div>
        <div class="folder folder--open">_layouts
            <div class="file">master.blade.php</div>
        </div>
        <div class="folder folder--open focus">assets
            <div class="folder folder--open">build
                <div class="folder folder--open">css
                    <div class="file">main.css</div>
                </div>
                <div class="folder folder--open">js
                    <div class="file">main.js</div>
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
    <div class="ellipsis">...</div>
</div>

Затем, когда Jigsaw соберет Ваш сайт, весь каталог `/source/assets`, содержащий Ваши файлы `build` (и любые другие каталоги, содержащие статические ресурсы, такие как `images` или `fonts`, которые Вы выберете для хранения там), будет можно скопировать в `/build_local` или `/build_production`.

В Ваших шаблонах Вы можете ссылаться на эти ресурсы с помощью директивы Blade `mix`. Если Вы используете настройку по умолчанию, Ваши скомпилированные ресурсы будут скопированы в каталог Вашего сайта `/assets/build`, который должен быть указан как второй параметр директивы `mix`:

```php
<link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
```

### Компиляция ваших ресурсов

Чтобы скомпилировать Ваши ресурсы, запустите:

```
$ npm run dev
```

Во-первых, Webpack скомпилирует Ваши ресурсы и сохранит их в каталоге `/source/assets/build`. Затем команда Jigsaw `build` будет запущена автоматически для сборки Вашего сайта (включая Ваши скомпилированные ресурсы) в `/build_local`. Затем Вы можете просмотреть свои изменения в браузере.

### Наблюдение за изменениями

Запустите вручную `npm run dev` каждый раз, когда Вы вносите изменения, довольно быстро устаревает.

Вместо этого Вы можете запустить следующую команду, чтобы следить за изменениями в Вашем проекте:

```
$ npm run watch
```

Каждый раз, когда в Вашем проекте изменяется любой файл, Webpack перекомпилирует Ваши ресурсы, а Jigsaw регенерирует Ваши статические HTML-страницы в `/build_local`.

Использование `npm run watch` также включает [Browsersync](https://www.browsersync.io/), поэтому Ваш браузер будет автоматически перезагружаться каждый раз, когда Вы вносите изменения. Он также управляет обслуживанием Вашего сайта локально для Вас, поэтому Вам не нужно запускать собственный локальный сервер PHP.

Вы также можете наблюдать за конкретной средой, запустив `npm run local`, `npm run staging` или `npm run production`.

---

### Изменение местоположения ресурсов

Если Вы хотите изменить исходный каталог для Ваших ресурсов, отредактируйте следующую строку в `webpack.mix.js`:

```js
mix.setPublicPath('source/assets/build');
```

Если Вы хотите изменить каталог назначения для Ваших ресурсов, отредактируйте второй параметр каждого шага компиляции `webpack.mix.js`:

```js
mix.jigsaw()
    .js('source/_assets/js/main.js', 'scripts')
    .postCss('source/_assets/css/main.css', 'styles')
    ...
```

---

### Включение разных препроцессоров

Jigsaw поставляется со следующим файлом `webpack.mix.js` и настроен на использование Tailwind CSS и PostCSS из коробки:

```js
const mix = require('laravel-mix');
require('laravel-mix-jigsaw');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');

mix.jigsaw()
    .js('source/_assets/js/main.js', 'js')
    .postCss('source/_assets/css/main.css', 'css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .options({
        processCssUrls: false,
    })
    .version();
```

Если Вы хотите переключиться на Sass, Less, Coffeescript или воспользоваться другими функциями Mix, не стесняйтесь редактировать этот файл по своему усмотрению. Вот пример того, как может выглядеть использование Less и React:

```js
mix.jigsaw()
    .react('source/_assets/js/main.js', 'js')
    .less('source/_assets/less/main.less', 'css')
    .version();
```

---

### Встраивание Ваших ресурсов

Вы можете встроить свои ресурсы CSS или JavaScript в теги `<style>` или `<script>` на своей странице `<head>`, чтобы сохранить сетевой запрос и избежать блокировки загрузки остальной части страницы. Вспомогательная функция `inline` сделает это:

```
{{ inline(mix('css/main.css', 'assets/build')) }}
```

---

### Примечание для пользователей Sass

Чтобы URL-адреса в Ваших файлах `.scss`, такие как фоновые изображения и шрифты, не обрабатывались и не изменялись Mix, убедитесь, что для параметра `processCssUrls` установлено значение `false` в Вашем файле `webpack.mix.js`.

