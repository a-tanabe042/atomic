import React from 'react';
import MoonIcon from "@heroicons/react/24/outline/MoonIcon";
import SunIcon from "@heroicons/react/24/outline/SunIcon";
import { themeChange } from "theme-change";

const ThemeSwitch = ({ currentTheme, setCurrentTheme }) => {
    const toggleTheme = () => {
      const newTheme = currentTheme === "light" ? "dark" : "light";
      setCurrentTheme(newTheme);
      localStorage.setItem("theme", newTheme);
      document.documentElement.setAttribute('data-theme', newTheme);
      themeChange(); 
    };
  
    return (
      <label className="swap swap-rotate">
        <input type="checkbox" onChange={toggleTheme} checked={currentTheme === "dark"} />
        {currentTheme === "light" ? (
          <SunIcon className="fill-current w-6 h-6 swap-off" />
        ) : (
          <MoonIcon className="fill-current w-6 h-6 swap-on" />
        )}
      </label>
    );
  };
  

export default ThemeSwitch;
