<section class="flex relative container-content -mb-32 px-4">
    <div class="flex flex-col w-full md:w-4/5 lg:w-2/3 -mr-2">
        @component('_components.code-editor')
            <div class="editor-row">
                <p class="line-number">1</p>
                <div class="line-code">---</div>
            </div>

            <div class="editor-row">
                <p class="line-number">2</p>
                <div class="line-code">
                    <span class="text-pink">title</span>: <span class="text-yellow">"Jigsaw это круто!"</span>
                </div>
            </div>

            <div class="editor-row">
                <p class="line-number">3</p>
                <div class="line-code">---</div>
            </div>

            <div class="editor-row">
                <p class="line-number">5</p>
                <div class="line-code">@@extends('layouts.master')</div>
            </div>

            <div class="editor-row">
                <p class="line-number">6</p>
                <div class="line-code"></div>
            </div>

            <div class="editor-row">
                <p class="line-number">7</p>
                <div class="line-code">@@section('content')</div>
            </div>

            <div class="editor-row">
                <p class="line-number">8</p>
                <div class="line-code ml-4">
                    <span class="text-pink">&lt;h1&gt;</span>@{{ $page->title }}<span class="text-pink">&lt;/h1&gt;</span>
                </div>
            </div>

            <div class="editor-row">
                <p class="line-number">9</p>
                <div class="line-code ml-4">
                    <span class="text-pink">&lt;p&gt;</span>Свяжитесь с нами по <br class="hidden md:block lg:hidden"> @{{ $page->contact_email }}<span class="text-pink">&lt;/p&gt;</span>
                </div>
            </div>

            <div class="editor-row">
                <p class="line-number">10</p>
                <div class="line-code">@@endsection</div>
            </div>
        @endcomponent
    </div>
    <div
        class="absolute hidden md:flex flex-col right-0 w-[26rem] lg:w-[32rem] h-80 lg:h-96 justify-center items-center select-none lg:-mt-12 mr-4"
        style="background:url('/assets/img/browser-illustration.svg') no-repeat center top; background-size: contain;"
    >
        <h1 class="text-grey-darker text-2xl lg:text-4xl">Jigsaw это круто!</h1>

        <p class="text-grey-darker text-base">
            Свяжитесь с нами по
            <a href="mailto:hello@tighten.co?subject='Hello from Jigsaw'" class="text-blue-lighter">hello@tighten.co</a>
        </p>
    </div>
</section>
