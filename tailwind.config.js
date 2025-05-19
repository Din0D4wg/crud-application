import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default {
  plugins: [
    tailwindcss(),
  ],
  content: [
    './resources/**/*.{js,jsx,vue,blade.php,html}',
    './**/*.{js,jsx,vue,blade.php,html}',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}