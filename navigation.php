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
    'Collections' => [
        'root' => '/docs/collections',
        'children' => [
            'Extending Parent Templates' => ['root' => '/docs/collections-extending-parent-templates'],
            'Paths' => ['root' => '/docs/collections-paths'],
            'Sorting' => ['root' => '/docs/collections-sorting'],
            'Filtering' => ['root' => '/docs/collections-filtering'],
            'Mapping' => ['root' => '/docs/collections-mapping'],
            'Pagination' => ['root' => '/docs/collections-pagination'],
            'Variables and Functions' => ['root' => '/docs/collections-variables-and-functions'],
            'Remote Collections' => ['root' => '/docs/collections-remote-collections'],
        ],
    ],
    'Красивые URL-адреса' => ['root' => '/docs/pretty-urls'],
    'Пользовательская страница 404' => ['root' => '/docs/custom-404-page'],
    'Слушатели событий' => ['root' => '/docs/event-listeners'],
    'Деплой сайта' => ['root' => '/docs/deploying-your-site'],
];
