---
extends: _layouts.documentation
section: documentation_content
---

## Слушатели событий

Jigsaw предоставляет три события, к которым Вы можете подключиться, чтобы запускать собственный код до и после обработки Вашей сборки.

- **Событие `beforeBuild` запускается перед обработкой любых файлов `source`**. Это дает Вам возможность программно изменять переменные `config.php`, получать данные из внешних источников или изменять файлы в папке `source`.

- **Событие `afterCollections` запускается после обработки любых коллекций, но до создания любых выходных файлов.** Это дает Вам доступ к проанализированному содержимому элементов коллекции.

- **Событие `afterBuild` запускается после завершения сборки, и все выходные файлы были записаны в каталог `build`.** Это позволяет вам получить список путей к выходным файлам (для использования, например, при создании файла `sitemap.xml`), программно создавайте файлы вывода или позаботьтесь о любых других задачах постобработки.

---

### Регистрация слушателей событий как замыканий

Чтобы добавить прослушиватель событий, перейдите в `bootstrap.php`. Там Вы можете получить доступ к шине событий с помощью переменной `$events`, добавив слушателей, вызвав имя события:

>_bootstrap.php_

```php
$events->beforeBuild(function ($jigsaw) {
   // ваш код здесь
});

$events->afterCollections(function ($jigsaw) {
   // ваш код здесь
});

$events->afterBuild(function ($jigsaw) {
   // ваш код здесь
});
```

В простейшем случае Вы можете определить слушателей событий как замыкания, которые принимают экземпляр Jigsaw. Экземпляр `Jigsaw` содержит ряд [вспомогательных методов](#вспомогательные-методы), позволяющих Вам получить доступ к информации о сайте и взаимодействовать с файлами и настройками конфигурации.

Например, следующий прослушиватель получит текущую погоду из внешнего API и добавит ее как переменную в `config.php`, где на нее можно будет ссылаться в Ваших шаблонах:

>_bootstrap.php_

```php
$events->beforeBuild(function ($jigsaw) {
    $url = "http://api.openweathermap.org/data/2.5/weather?" . http_build_query([
        'q' => $jigsaw->getConfig('city'),
        'appid' => $jigsaw->getConfig('openweathermap_api_key'),
        'units' => 'imperial',
    ]);

    $jigsaw->setConfig('current_weather', json_decode(file_get_contents($url))->main);
});
```

---

### Регистрация слушателей событий как классов

Для более сложных прослушивателей событий Вы можете указать имя класса или массив имен классов вместо замыкания. Эти классы могут находиться либо непосредственно в `bootstrap.php`, либо в отдельном каталоге. Классы слушателей должны иметь метод `handle()`, который принимает экземпляр `Jigsaw`:

>_bootstrap.php_

```php
$events->afterBuild(GenerateSitemap::class);

// или

$events->afterBuild([GenerateSitemap::class, SendNotification::class]);
```

>_listeners/GenerateSitemap.php_

```php
<?php namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;
use samdark\sitemap\Sitemap;

class GenerateSitemap
{
    public function handle(Jigsaw $jigsaw)
    {
        $baseUrl = $jigsaw->getConfig('baseUrl');
        $sitemap = new Sitemap($jigsaw->getDestinationPath() . '/sitemap.xml');

        collect($jigsaw->getOutputPaths())->each(function ($path) use ($baseUrl, $sitemap) {
            if (! $this->isAsset($path)) {
                $sitemap->addItem($baseUrl . $path, time(), Sitemap::DAILY);
            }
        });

        $sitemap->write();
    }

    public function isAsset($path)
    {
        return starts_with($path, '/assets');
    }
}
```

Если для одного события определено несколько слушателей, они будут запущены в том порядке, в котором они были определены.

Чтобы вызвать класс слушателя, который находится в отдельном каталоге, пространство имен класса должно быть добавлено в файл `composer.json`:

>_composer.json_

```json
{
    "autoload": {
        "psr-4": {
            "App\\Listeners\\": "listeners"
        }
    }
}
```

---
<a name="вспомогательные-методы"></a>
### Вспомогательные методы в $jigsaw

Экземпляр `Jigsaw`, доступный каждому слушателю событий, включает следующие вспомогательные методы:

---

`getEnvironment()`

Возвращает текущую среду, например `local` или `production`.

---

`getCollections()`

В `beforeBuild` возвращает массив имен коллекций; в **afterCollections** и **afterBuild** возвращает коллекцию элементов коллекции, привязанную к имени коллекции.

---

`getCollection($collection)` _(только **afterCollections** и **afterBuild**)_

Возвращает элементы в конкретной коллекции, привязанные к их именам файлов `source`. Каждый элемент содержит переменные, определенные для элемента коллекции, а также доступ ко всем методам элемента коллекции, таким как `getContent()`.

---

`getConfig()`

Возвращает массив настроек из `config.php`.

---

`getConfig($key)`

Возвращает конкретную настройку из `config.php`. <br>Точечная нотация (например, `getConfig('collections.posts.items')` может использоваться для получения вложенных элементов.

---

`setConfig($key, $value)`

Добавляет или изменяет параметр в `config.php`. <br>Точечная нотация может использоваться для установки вложенных элементов.

---

`getSourcePath()`

Возвращает абсолютный путь к каталогу `source`.

---

`setSourcePath($path)`

Устанавливает путь к каталогу `source`.

---

`getDestinationPath()`

Возвращает абсолютный путь к каталогу `build`.

---

`setDestinationPath($path)`

Устанавливает путь к каталогу `build`.

---

`getPages()` _(**afterBuild** только)_

Возвращает коллекцию всех сгенерированных выходных файлов. Для каждого элемента ключ содержит путь к выходному файлу относительно каталога `build` (например, `/posts/my-first-post`), а значение содержит содержимое переменной `$page` для источника. файл. Это предоставляет функции [метаданные страницы](/docs/page-metadata), такие как `getPath()` и `getModifiedTime()` для каждой страницы, а также любые переменные, определенные в заголовке YAML страницы.

---

`getOutputPaths()` _(**afterBuild** только)_

Возвращает коллекцию путей к сгенерированным выходным файлам относительно каталога `build`.

---

`readSourceFile($fileName)`

Возвращает содержимое файла из каталога `source`.

---

`writeSourceFile($fileName, $contents)`

Позволяет записать файл в каталог `source`.

---

`readOutputFile($fileName)`

Возвращает содержимое файла из каталога `build`.

---

`writeOutputFile($fileName, $contents)`

Позволяет записать файл в каталог `build`.

---

