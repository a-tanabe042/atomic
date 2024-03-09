import React, { useEffect, useState, useRef } from "react";
import { Link, useLocation } from "react-router-dom";

function SidebarSubmenu({ submenu, icon }) {
  const location = useLocation();
  const [isExpanded2, setIsExpanded2] = useState(false);
  const submenuRef = useRef(null); // Add a ref to the submenu

  useEffect(() => {
    setIsExpanded2(submenu.some((m) => m.path === location.pathname));
  }, [location.pathname, submenu]);

  useEffect(() => {
    const handleDocumentClick = (event) => {
      // Only toggle if click is outside of the component
      if (submenuRef.current && !submenuRef.current.contains(event.target)) {
        setIsExpanded2(false);
      }
    };

    // Event listener for clicks outside the component
    document.addEventListener("mousedown", handleDocumentClick);

    return () => {
      document.removeEventListener("mousedown", handleDocumentClick);
    };
  }, []);

  const toggleSubmenu = (e) => {
    setIsExpanded2(!isExpanded2);
    e.stopPropagation(); // Prevent the event from propagating to the document
  };

  return (
    <div className="flex flex-col" ref={submenuRef}> {/* Apply ref here */}
      <div className="w-full p-2 rounded-full transition duration-300 shadow-md flex items-center justify-center cursor-pointer" onClick={toggleSubmenu}>
        <div className="w-12 h-12 rounded-full flex items-center justify-center">
          {icon}
        </div>
      </div>

      {isExpanded2 && (
       <ul
         tabIndex={0}
         className="menu menu-compact dropdown-content p-2 shadow bg-base-100 rounded-box w-52 absolute z-10 right-0 mr-10 mt-20"
       >
          {submenu.map((m, index) => (
            <li key={index} className="justify-between mb-1">
              <Link
                to={m.path}
                className={`block p-2 rounded-md ${location.pathname === m.path ? "bg-base-800" : "hover:bg-gray-100"}`}
              >
                {m.name}
              </Link>
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}

export default SidebarSubmenu;
