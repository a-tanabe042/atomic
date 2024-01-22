import React from 'react';
import { useCookie } from '../hooks/useCookie'; 

export const ThemeSelector = () => {
  const [, setTheme] = useCookie('theme', 'green');

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

  // Function to handle theme change
  const handleChangeTheme = (newTheme) => {
    setTheme(newTheme);
    applyTheme(newTheme);
  };

  return (
    <div className="p-4 space-x-2">
      <button onClick={() => handleChangeTheme('purple')} className="btn bg-purple-500 hover:bg-purple-700 text-white">
        PURPLE
      </button>
      <button onClick={() => handleChangeTheme('green')} className="btn bg-green-500 hover:bg-green-700 text-white">
        GREEN
      </button>
      <button onClick={() => handleChangeTheme('blue')} className="btn bg-blue-500 hover:bg-blue-700 text-white">
        BLUE
      </button>
    </div>
  );
};
