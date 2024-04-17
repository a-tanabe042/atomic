import React, { ReactNode } from 'react';
import { NavLink } from 'react-router-dom';
import useDisableLinkIfActive from '../hooks/useDisableLinkIfActive';

// Route型を定義します
interface Route {
  path: string;
  icon?: ReactNode; // iconは任意で、Reactのノードです
}

// `route`プロパティの型をRoute型で指定します
interface RightSidebarNavLinkProps {
  route: Route;
}

const RightSidebarNavLink: React.FC<RightSidebarNavLinkProps> = ({ route }) => {
  const isLinkActive = useDisableLinkIfActive(route.path);

  if (isLinkActive) {
    return (
      <div className="block p-2 rounded-full shadow-xl cursor-not-allowed opacity-50">
        <div className="flex items-center justify-center w-12 h-12 rounded-full">
          {route.icon}
        </div>
      </div>
    );
  } else {
    return (
      <NavLink to={route.path} className="block p-2 rounded-full shadow-xl">
        <div className="flex items-center justify-center w-12 h-12 rounded-full">
          {route.icon}
        </div>
      </NavLink>
    );
  }
};

export default RightSidebarNavLink;
