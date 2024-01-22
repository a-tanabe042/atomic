import { useEffect } from 'react';
import { useCookie } from '../hooks/useCookie';

export const ThemeSwitcher = () => {
  const [theme] = useCookie('theme', 'green');

  // Function to apply the theme
  const applyTheme = (themeValue) => {
    switch (themeValue) {
      case 'purple':
        document.body.style.background = "linear-gradient(90deg, rgba(74,9,72,1) 0%, rgba(182,101,184,1) 49%, rgba(234,138,108,1) 95%)";
        break;
      case 'green':
        document.body.style.background = "linear-gradient(90deg, rgba(131,0,161,1) 0%, rgba(114,135,244,1) 51%, rgba(88,255,131,1) 100%)";
        break;
      case 'blue':
        document.body.style.background = "linear-gradient(90deg, rgba(9,20,74,1) 4%, rgba(101,137,184,1) 49%, rgba(108,203,234,1) 95%)";
        break;
      default:
        document.body.style.background = "linear-gradient(90deg, rgba(131,0,161,1) 0%, rgba(114,135,244,1) 51%, rgba(88,255,131,1) 100%)";
        break;
    }
  };

  // Apply theme on mount and when theme changes
  useEffect(() => {
    if (theme) {
      applyTheme(theme);
    }
  }, [theme]);

  // ここでUIをレンダリングしない
  return null;
};

export default ThemeSwitcher;
