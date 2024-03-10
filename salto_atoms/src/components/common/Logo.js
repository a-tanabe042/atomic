import React from 'react';
import { Link } from 'react-router-dom';

const Logo = () => {
  return (
    <Link to="/app/welcome" className="flex items-center">
      <img
        className="mask mask-squircle w-10 mr-3"
        src="/logo192.png"
        alt="Salto Atoms Logo"
      />
      <span>SALTO Atoms</span>
    </Link>
  );
};

export default Logo;
