---
extends: _layouts.documentation
section: documentation_content
---

#### [Коллекции](/docs/collections)
## Картография

Вы можете сопоставить элементы своей коллекции, добавив ключ `map` в массив коллекции в `config.php` и указав обратный вызов, который принимает элемент коллекции. Каждый элемент является экземпляром класса `TightenCo\Jigsaw\Collection\CollectionItem`, из которого Вы можете создать экземпляр своего собственного пользовательского класса, используя статический метод `fromItem()`. Ваш собственный класс может включать вспомогательные методы, которые могут быть слишком сложными для хранения в Вашем массиве `config.php`.

> _config.php_

```
<?php

return [
    'collections' => [
        'posts' => [
            'map' => function ($post) {
                return Post::fromItem($post);
            }
        ],
    ],
];
```

Ваш собственный класс `Post` должен расширять `TightenCo\Jigsaw\Collection\CollectionItem` и может включать вспомогательные функции, ссылаться и/или изменять переменные страницы и т.д.:

```
<?php

use TightenCo\Jigsaw\Collection\CollectionItem;

class Post extends CollectionItem
{
    public function getAuthorNames()
    {
        return implode(', ', $this->author);
    }
}
```
