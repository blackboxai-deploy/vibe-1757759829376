/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./admin/*.php", 
    "./includes/*.php",
    "./assets/js/*.js"
  ],
  theme: {
    extend: {
      colors: {
        // Dating Network Pink Theme
        'dating': {
          50: '#fdf2f8',
          100: '#fce7f3',
          200: '#fbcfe8',
          300: '#f9a8d4',
          400: '#f472b6',
          500: '#ec4899',
          600: '#db2777',
          700: '#be185d',
          800: '#9d174d',
          900: '#831843',
        },
        'rose-gradient': {
          'from': '#fdf2f8',
          'to': '#fce7f3',
        }
      },
      fontFamily: {
        'romantic': ['Inter', 'system-ui', 'sans-serif'],
      },
      animation: {
        'heart-beat': 'heartbeat 1.5s ease-in-out infinite',
        'float': 'float 3s ease-in-out infinite',
        'fade-in-up': 'fadeInUp 0.6s ease-out',
        'slide-in': 'slideIn 0.4s ease-out',
        'bounce-heart': 'bounceHeart 0.8s ease-in-out',
        'pulse-pink': 'pulsePink 2s infinite',
      },
      keyframes: {
        heartbeat: {
          '0%, 100%': { transform: 'scale(1)' },
          '50%': { transform: 'scale(1.1)' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-10px)' },
        },
        fadeInUp: {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        slideIn: {
          '0%': { transform: 'translateX(-100%)' },
          '100%': { transform: 'translateX(0)' },
        },
        bounceHeart: {
          '0%, 100%': { transform: 'scale(1)' },
          '25%': { transform: 'scale(1.2)' },
          '50%': { transform: 'scale(1.1)' },
          '75%': { transform: 'scale(1.15)' },
        },
        pulsePink: {
          '0%, 100%': { opacity: '1' },
          '50%': { opacity: '0.7' },
        }
      },
      backdropBlur: {
        xs: '2px',
      },
      boxShadow: {
        'pink': '0 4px 14px 0 rgba(236, 72, 153, 0.15)',
        'pink-lg': '0 10px 25px 0 rgba(236, 72, 153, 0.25)',
        'rose': '0 4px 14px 0 rgba(244, 114, 182, 0.15)',
        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.37)',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
}