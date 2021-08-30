const defaults = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: {
        content: [
            // Only way to not rebuild infinitely is to *not* watch './source/assets/build'
            './source/404.blade.php',
            './source/index.blade.php',
            './source/_assets/**/*.{js,vue}',
            './source/_components/**/*.{html,php,md}',
            './source/_layouts/**/*.{html,php,md}',
            './source/docs/**/*.{html,php,md}',
        ],
        // TODO doesn't work with patterns in JIT mode
        // safelist: [/language/, /hljs/, /algolia/, /docsearch/, /ds-/],
        safelist: ['language', 'hljs', 'algolia', 'docsearch', 'ds-'],
    },
    theme: {
        screens: {
            sm: '576px',
            md: '768px',
            lg: '992px',
            xl: '1200px',
        },
        extend: {
            colors: {
                black: '#222b2f',

                'grey-darkest': '#364349',
                'grey-darker': '#596a73',
                'grey-dark': '#70818a',
                grey: '#f2f5f8',
                'grey-light': '#dae4e9',
                'grey-lighter': '#f3f7f9',
                'grey-lightest': '#fafcfc',

                'brown-lightest': '#F7F6F5',

                yellow: '#ffed4a',

                'teal-light': '#AEF2FD',

                'blue-darkest': '#0A2440',
                'blue-darker': '#0F2F53',
                'blue-dark': '#45658a',
                blue: '#3C6492',
                'blue-lighter': '#2D81DF',

                'indigo-darker': '#3E6389',
                'indigo-dark': '#143154',
                'indigo-lighter': '#e1e6ea',

                'purple-darker': '#562b61',
                'purple-dark': '#773580',
                purple: '#96539f',
                'purple-light': '#a779e9',
                'purple-lighter': '#cbabf8',

                'pink-dark': '#eb5286',
                pink: '#ee6e99',
                'pink-lighter': '#FFD8D8',
            },
            maxWidth: {
                25: '25px',
                sm: '30rem',
                md: '35rem',
                lg: '45rem',
                xl: '55rem',
                '2xl': '65rem',
                '3xl': '75rem',
                '4xl': '90rem',
                '5xl': '100rem',
            },
            borderWidth: {
                5: '5px',
            },
            fontFamily: {
                sans: ['proxima-nova', ...defaults.fontFamily.sans],
            },
            // Same as v2 defaults except for 6xl, keeping for now to override line heights
            fontSize: {
                xs: '0.75rem',
                sm: '0.875rem',
                base: '1rem',
                lg: '1.125rem',
                xl: '1.25rem',
                '2xl': '1.5rem',
                '3xl': '1.875rem',
                '4xl': '2.25rem',
                '5xl': '3rem',
                '6xl': '4rem',
            },
            height: {
                70: '20rem',
                76: '24rem',
            },
            lineHeight: {
                0: 0.5,
            },
            width: {
                82: '26rem',
                112: '32rem',
            },
            borderColor: (theme) => ({
                ...theme('colors'),
                DEFAULT: theme('colors.grey-light'),
            }),
        },
    },
};
