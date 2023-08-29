module.exports = {
  content: [
    './resources/js/**/*.vue',
    './resources/js/**/**/*.vue',
    './resources/css/*.css'
  ],
  safelist: [
    {
      pattern: /bg-(red|green|blue|yellow)-200/,
    },
    {
      pattern: /text-(red|green|blue|yellow)-(600|800)/,
    },
    {
      pattern: /border-(red|green|blue|yellow)-600/,
    },
  ]
}
