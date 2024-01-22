import React, { useState } from 'react';
import Html from "../../../assets/img/html-5.png"
import Css from "../../../assets/img/css-3.png"
import JavaScript from "../../../assets/img/js.png"
import MySql from "../../../assets/img/mysql.png"

const IsClickLanguage = ({ languages }) => {
  const [isClicked, setIsClicked] = useState(false);

  const handleClick = () => {
    setIsClicked(!isClicked);
  };

  const getImageSrc = (language) => {
    switch (language.toLowerCase()) {
      case "html":
        return Html;
      case "css":
        return Css;
      case "javascript":
        return JavaScript;
      case "mysql":
        return MySql;
      default:
        return "https://reqres.in/img/faces/1-image.jpg";
    }
  };
  
  return (
    <div className={`flex`} onClick={handleClick}>
      {languages.map((language, index) => (
        <img
          key={index}
          className={`w-16 h-16 p-1 ${isClicked ? 'mr-6' : 'mr-0'} rounded-lg shadow-sm ${index !== 0 ? '-ml-6' : 'ml-0'} object-cover`}
          src={getImageSrc(language)}
          alt={`Avatar ${language}`}
          style={{ minWidth: '64px', minHeight: '64px' }} // Use inline style to ensure the minimum width and height
        />
      ))}
    </div>
  );
};

export default IsClickLanguage;
