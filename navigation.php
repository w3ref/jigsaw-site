<?php

return [
    'Установка' => [
        'root' => '/docs/installation',
        'children' => [
            'Использование стартового шаблона' => ['root' => '/docs/starter-templates'],
        ],
    ],
    'Сборка и Препросмотр' => [
        'root' => '/docs/building-and-previewing',
        'children' => [
            'Среды' => ['root' => '/docs/building-and-previewing-environments'],
        ],
    ],
    'Компиляция Ресурсов' => ['root' => '/docs/compiling-assets'],
    'Создание контента Вашего сайта' => [
        'root' => '/docs/content',
        'children' => [
            'Шаблоны и части Blade' => ['root' => '/docs/content-blade'],
            'Язык разметки' => ['root' => '/docs/content-markdown'],
            'Другие типы файлов' => ['root' => '/docs/content-other-file-types'],
        ],
    ],
    'Переменные сайта' => ['root' => '/docs/site-variables'],
    'Вспомогательные методы' => ['root' => '/docs/helper-methods'],
    'Метаданные страницы' => ['root' => '/docs/page-metadata'],
    'Коллекции' => [
        'root' => '/docs/collections',
        'children' => [
            'Расширение родительских шаблонов' => ['root' => '/docs/collections-extending-parent-templates'],
            'Пути' => ['root' => '/docs/collections-paths'],
            'Сортировка' => ['root' => '/docs/collections-sorting'],
            'Фильтрация' => ['root' => '/docs/collections-filtering'],
            'Картография' => ['root' => '/docs/collections-mapping'],
            'Пагинация' => ['root' => '/docs/collections-pagination'],
            'Переменные и функции' => ['root' => '/docs/collections-variables-and-functions'],
            'Удаленные коллекции' => ['root' => '/docs/collections-remote-collections'],
        ],
    ],
    'Красивые URL-адреса' => ['root' => '/docs/pretty-urls'],
    'Пользовательская страница 404' => ['root' => '/docs/custom-404-page'],
    'Слушатели событий' => ['root' => '/docs/event-listeners'],
    'Деплой сайта' => ['root' => '/docs/deploying-your-site'],
];
