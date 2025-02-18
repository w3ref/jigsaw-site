@extends('_layouts.master')

@section('body')
<header class="w-full bg-white absolute z-10 shadow-md px-4 md:px-6">
    <nav class="flex items-center max-w-[75rem] mx-auto py-4" aria-role="navigation">
        <a class="flex flex-shrink-0 lg:flex-1 items-center mr-1" href="/" title="Jigsaw by Tighten">
            <img src="/assets/img/jigsaw-logo.svg" alt="Jigsaw logo" class="w-10 lg:w-11 mr-3 shadow border-2 border-white rounded-lg" />

            <h1 class="hidden mr-4 ml-4 uppercase tracking-wide text-blue-darker text-lg lg:text-2xl font-normal lg:ml-0 lg:inline-block">
                Jigsaw
            </h1>
        </a>

        <div class="w-full flex items-center lg:max-w-xl xl:max-w-[45rem] border-2 border-indigo-lighter rounded bg-grey">
            <img src="/assets/img/icon-search.svg" class="absolute z-10 h-4 ml-2">

            <input id="docsearch" type="text" class="w-full pl-8 pr-2 py-2 bg-grey" placeholder='Поиск в документации (Нажмите "/" для фокуса)' />
        </div>

        <div class="hidden lg:flex lg:flex-1 items-center">
            <a href="https://github.com/tighten/jigsaw" title="Contribute to Jigsaw on GitHub" class="flex mr-3 text-blue-darker pl-8">
                <img src="/assets/img/GitHub.svg" alt="GitHub alien logo">
            </a>

            <p class="text-sm text-blue-dark mb-0 leading-tight">
                Проект автора
                <a href="https://tighten.co" title="Tighten | Product Development for Web + Mobile"
                    class="text-purple">Tighten</a>
            </p>
        </div>

        <navigation-toggle></navigation-toggle>
    </nav>
</header>

<div class="bg-brown-lightest min-h-screen pt-16 md:pt-24 lg:pt-32 px-0 md:px-6">
    <div class="flex flex-col lg:flex-row justify-center max-w-[75rem] mx-auto">
        <navigation :links='@json($page->navigation)'></navigation>

        <div class="markdown bg-white w-full lg:max-w-xl xl:max-w-[45rem] md:mb-6 lg:mb-10 px-6 xl:px-10 pt-4 pb-8 font-normal sm:shadow md:rounded-lg" v-pre>
            @yield('documentation_content')
        </div>

        <navigation-on-page :headings="pageHeadings"></navigation-on-page>
    </div>

    <footer class="py-8 flex flex-col sm:flex-row justify-center items-center text-center">
        <p class="text-grey-dark font-normal text-xs sm:text-sm my-1">Принесено Вам прекрасными людьми из
            <a href="https://tighten.co" class="text-purple hover:text-purple-darker font-normal no-underline sm:pr-4" title="Tighten | Product Development for Web + Mobile | Laravel + Vue.js">Tighten</a>
        </p>

        <a href="https://github.com/tighten/jigsaw" class="sm:border-l border-purple-light sm:pl-4 text-purple text-xs sm:text-sm hover:text-purple-darker font-normal no-underline my-1"
            title="Jigsaw on GitHub">Проблемы/Запросы функций</a>
    </footer>
</div>
@endsection

@section('scripts')
    <script src="{{ mix('js/app.js', 'assets/build') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
    <script type="text/javascript">
        docsearch({
            apiKey: 'edec3348f3b1c2798189bf1337aad17d',
            indexName: 'jigsaw_su',
            inputSelector: '#docsearch'
        });

        document.addEventListener('keydown', (e) => {
            if (e.keyCode == 191) {
                document.getElementById('docsearch').focus();
                e.preventDefault()
            }
            if (e.keyCode == 27) {
                document.getElementById('docsearch').blur();
                e.preventDefault()
            }
        });
    </script>
@endsection
