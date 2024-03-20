import React from 'react';
import { Link } from 'react-router-dom';
import useDisableLinkIfActive from '../../hooks/useDisableLinkIfActive';

const Logo: React.FC = () => {
  const isLinkActive = useDisableLinkIfActive("/app/welcome");

  return (
    <div className={`flex items-center ${isLinkActive ? 'pointer-events-none' : ''}`}>
      {isLinkActive ? (
        <button className="flex items-center">
          <img className="mask mask-squircle w-10 mr-3" src="/logo192.png" alt="Salto Atoms Logo" />
          <span>SALTO Atoms</span>
        </button>
      ) : (
        <Link to="/app/welcome" className="flex items-center">
          <img className="mask mask-squircle w-10 mr-3" src="/logo192.png" alt="Salto Atoms Logo" />
          <span>SALTO Atoms</span>
        </Link>
      )}
    </div>
  );
};

export default Logo;
