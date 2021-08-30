module.exports = {
  theme: {
    borderColor: theme => ({
      default: theme('colors.grey-light'),
      ...theme('colors'),
    }),
    colors: {
      'transparent': 'transparent',

      'black': '#222b2f',
      'grey-darkest': '#364349',
      'grey-darker': '#596a73',
      'grey-dark': '#70818a',
      'grey': '#f2f5f8',
      'grey-light': '#dae4e9',
      'grey-lighter': '#f3f7f9',
      'grey-lightest': '#fafcfc',
      'white': '#ffffff',

      'brown-lightest': '#F7F6F5',

      'yellow': '#ffed4a',

      'teal-light': '#AEF2FD',

      'blue-darkest': '#0A2440',
      'blue-darker': '#0F2F53',
      'blue-dark': '#45658a',
      'blue': '#3C6492',
      'blue-lighter': '#2D81DF',

      'indigo-darker': '#3E6389',
      'indigo-dark': '#143154',
      'indigo-lighter': '#e1e6ea',

      'purple-darker': '#562b61',
      'purple-dark': '#773580',
      'purple': '#96539f',
      'purple-light': '#a779e9',
      'purple-lighter': '#cbabf8',

      'pink-dark': '#eb5286',
      'pink': '#ee6e99',
      'pink-lighter': '#FFD8D8',
    },
    maxWidth: {
      '25':'25px',
      'xs': '20rem',
      'sm': '30rem',
      'md': '35rem',
      'lg': '45rem',
      'xl': '55rem',
      '2xl': '65rem',
      '3xl': '75rem',
      '4xl': '90rem',
      '5xl': '100rem',
      'full': '100%',
    },
    screens: {
      'sm': '576px',
      'md': '768px',
      'lg': '992px',
      'xl': '1200px',
    },
    extend: {
      borderWidth: {
        '5': '5px',
      },
      fontFamily: {
        'sans': [
          'proxima-nova',
          'system-ui',
          'BlinkMacSystemFont',
          '-apple-system',
          'Segoe UI',
          'Roboto',
          'Oxygen',
          'Ubuntu',
          'Cantarell',
          'Fira Sans',
          'Droid Sans',
          'Helvetica Neue',
          'sans-serif',
        ],
      },
      height: {
        '70': '20rem',
        '76': '24rem',
      },
      leading: {
        '0': .5,
      },
      width: {
        '82': '26rem',
        '112': '32rem',
      },
    },
  },
  variants: {
    // ...
  },
  plugins: [
    // ...
  ],
}
