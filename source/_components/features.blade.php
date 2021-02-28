<section class="flex flex-col items-center bg-white py-12 md:py-16">
    <div class="flex flex-col md:flex-row items-center container-content mb-8 px-4 sm:px-6">
        <div class="flex-col md:w-1/2 md:pr-10 lg:pr-20 pb-8 md:pb-0">
            <h3 class="mb-5 text-blue-darker">
                Шаблоны Blade, как и в Ваших приложениях Laravel.
            </h3>

            <p class="text-blue mb-0">
                Blade - это мощный, простой и красивый язык шаблонов, но до сих пор он не подходил, если Вы создавали простой статический сайт, не нуждающийся в сложном PHP-сервере. Jigsaw переносит Blade в мир статических сайтов, поэтому Вы можете использовать тот же механизм шаблонов для простых веб-сайтов, что и для сложных веб-приложений.
            </p>
        </div>

        <div class="w-full md:w-1/2">
            @component('_components.code-editor')
                <div class="editor-row">
                    <p class="line-number">1</p>
                    <div class="line-code">@@extends('_layouts.master')</div>
                </div>

                <div class="editor-row">
                    <p class="line-number">2</p>
                    <div class="line-code">@@section('body')</div>
                </div>

                <div class="editor-row">
                    <p class="line-number">3</p>
                    <div class="line-code ml-4"><span class="text-pink-dark">&lt;h1&gt;</span>Привет мир<span class="text-pink-dark">&lt;/h1&gt;</span></div>
                </div>

                <div class="editor-row">
                    <p class="line-number">4</p>
                    <div class="line-code">@@endsection</div>
                </div>
            @endcomponent
        </div>
    </div>

    <div class="flex flex-col md:flex-row items-center container-content mt-6 px-4 sm:px-6">
        <div class="flex-col md:w-1/2 md:pr-10 lg:pr-20 pb-8 md:pb-0">
            <h3 class="mb-5 text-blue-darker">
                Используйте Markdown для страниц, ориентированных на контент.
            </h3>

            <p class="text-blue">
                Markdown - это фантастический формат написания таких вещей, как статьи, сообщения в блогах или страницы документации. Jigsaw позволяет без труда создать макет в Blade и заполнить его контентом, написанным на Markdown.
            </p>

            <a href="/docs/installation" title="Read the Jigsaw documentation"
                class="text-purple hover:text-purple-darker text-base no-underline hover:underline">
                Узнайте больше в документации <img src="/assets/img/icon-arrow.svg" class="inline-block w-4 -mb-1" alt="Узнайте больше в документации">
            </a>
        </div>

        <div class="w-full md:w-1/2">
            @component('_components.code-editor')
                <div class="editor-row">
                    <p class="line-number">1</p>
                    <div class="line-code">---</div>
                </div>

                <div class="editor-row">
                    <p class="line-number">2</p>
                    <div class="line-code">extends: layouts.post</div>
                </div>

                <div class="editor-row">
                    <p class="line-number">3</p>
                    <div class="line-code">section: content</div>
                </div>

                <div class="editor-row">
                    <p class="line-number">4</p>
                    <div class="line-code">---</div>
                </div>

                <div class="editor-row">
                    <p class="line-number">5</p>
                    <div class="line-code"></div>
                </div>

                <div class="editor-row">
                    <p class="line-number">6</p>
                    <div class="line-code"># Привет мир!</div>
                </div>

                <div class="editor-row">
                    <p class="line-number">7</p>
                    <div class="line-code">Добро пожаловать в будущее.</div>
                </div>
            @endcomponent
        </div>
    </div>
</section>
