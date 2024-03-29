import React from "react";
import { Link } from "react-router-dom";

interface RightSidebarDropdownProps {
  isExpanded: boolean;
  submenu: { name: string; path: string; icon: JSX.Element }[];
  toggle: () => void;
  location: { pathname: string };
}

const RightSidebarDropdown:React.FC<RightSidebarDropdownProps> = ({ isExpanded, submenu, toggle, location }) => (
  <div className="flex flex-col">
    {isExpanded && (
      <ul
        tabIndex={0}
        className="menu menu-compact dropdown-content p-2 shadow bg-base-100 rounded-box w-52 absolute z-10 right-28 bottom-14 "
      >
        {submenu.map((m, index) => (
          <li key={index} className="justify-between mb-1">
            <Link
              to={m.path}
              onClick={toggle}
              className={`block p-2 rounded-md ${location.pathname === m.path ? "bg-base-800" : "hover:bg-gray-100"}`}
            >
              <div className="flex items-center ">
                {m.icon}
                <span className="ml-1">{m.name}</span>
              </div>
            </Link>
          </li>
        ))}
      </ul>
    )}
  </div>
);

export default RightSidebarDropdown;
