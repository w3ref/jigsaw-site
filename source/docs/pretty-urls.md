---
extends: _layouts.documentation
section: documentation_content
---

## Красивые URL-адреса

По умолчанию все Blade-файлы, _не_ именованные `index.blade.php`, отображаются как `index.html` в подпапке, названной в честь исходного файла.

Например, если у Вас есть файл с именем `about-us.blade.php` в каталоге `/source`:

<div class="files">
    <div class="folder folder--open">source
        <div class="folder">_assets</div>
        <div class="folder">_layouts</div>
        <div class="folder">assets</div>
        <div class="file focus">about-us.blade.php</div>
        <div class="file">blog.blade.php</div>
        <div class="file">index.blade.php</div>
    </div>
    <div class="ellipsis">...</div>
</div>

...он будет отображаться как `index.html` в каталоге `/build/about-us`:

<div class="files">
    <div class="folder folder--open">build_local
        <div class="folder folder--open focus">about-us
            <div class="file">index.html</div>
        </div>
        <div class="folder folder--open">blog
            <div class="file">index.html</div>
        </div>
        <div class="file">index.html</div>
    </div>
    <div class="ellipsis">...</div>
</div>


Это означает, что ваша страница «О нас» будет доступна по адресу `http://example.com/about-us/` вместо `http://example.com/about-us.html`.

### Отключение красивых URL-адресов

Если Вам нужно отключить это поведение, используйте параметр `--pretty=false` при создании Вашего сайта.
