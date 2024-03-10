import React from "react";
import { useLocation } from "react-router-dom";
import useToggleDropdown from "../hooks/useToggleDropdown"; 
import RightSidebarDropdown from "../components/dropdown/RightSidebarDropdown"; 

function SidebarSubmenu({ submenu, icon }) {
  const { isExpanded, toggle, dropdownRef } = useToggleDropdown();
  const location = useLocation();

  return (
    <div className="flex flex-col" ref={dropdownRef}>
      <div
        className="w-full p-2 rounded-full  shadow-xl flex items-center justify-center cursor-pointer transition duration-300 hover:bg-gray-100"
        onClick={toggle}
      >
        <div className="w-12 h-12 rounded-full flex items-center justify-center">
          {icon}
        </div>
      </div>
      <div className="mt-1">
      <RightSidebarDropdown isExpanded={isExpanded} submenu={submenu} toggle={toggle} location={location} />
      </div>
    </div>
  );
}

export default SidebarSubmenu;
