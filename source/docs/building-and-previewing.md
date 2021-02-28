---
extends: _layouts.documentation
section: documentation_content
---

## Сборка и предварительный просмотр

Когда Вы захотите сгенерировать свой сайт, запустите команду `build` из корня Вашего проекта:

`$ ./vendor/bin/jigsaw build`

Jigsaw сгенерирует Ваш статический HTML и по умолчанию поместит его в каталог `/build_local`.

Используя структуру сайта по умолчанию, `/build_local` будет выглядеть так:

<div class="files">
    <div class="folder folder--open focus">build_local
        <div class="folder folder--open">assets
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
        <div class="file">index.html</div>
    </div>
    <div class="folder">source</div>
    <div class="folder">tasks</div>
    <div class="folder">vendor</div>
    <div class="ellipsis">...</div>
</div>

### Предварительный просмотр с помощью PHP

Для быстрого предпросмотра Вашего сайта, используйте команду `serve`:

`$ ./vendor/bin/jigsaw serve`

Теперь Вы можете просматривать свой сайт по адресу `http://localhost:8000` в браузере.

Вы также можете при желании указать среду и порт для обслуживания следующим образом:

`$ ./vendor/bin/jigsaw serve production --port=8080`

Это будет обслуживать Ваш каталог `/build_production` по адресу `http://localhost:8080`.

### Предварительный просмотр с Browsersync

Если Вы [используете Laravel Mix для компиляции своих ресурсов](/docs/compiling-assets) (который включен в настройку Jigsaw по умолчанию), Вы можете предварительно просмотреть свой сайт с помощью Browsersync, просто запустив:

```
$ npm run watch
```

_(Если Вы еще этого не сделали, Вам нужно запустить `npm install` перед запуском `npm run watch`.)_

Browsersync автоматически открывает новую вкладку браузера и перезагружает страницу каждый раз, когда Вы вносите изменения. Очень полезно для быстрого просмотра Ваших изменений!
