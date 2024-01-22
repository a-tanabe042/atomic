import React, { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faEllipsisV,
  faUser,
  faPalette,
  faSignOutAlt,
} from "@fortawesome/free-solid-svg-icons";
import { ThemeSelector } from "../../../components/ThemeSelector";

export const SidebarFooter = () => {
  const [isDropdownOpen, setIsDropdownOpen] = useState(false);
  const [isThemeModalOpen, setIsThemeModalOpen] = useState(false);

  const toggleDropdown = () => {
    setIsDropdownOpen(!isDropdownOpen);
  };

  // Define or import the toggleThemeModal function
  const toggleThemeModal = () => {
    setIsThemeModalOpen(!isThemeModalOpen);
  };

  const sidebarData = {
    user: {
      name: "Akifumi Tanabe",
      email: "akifumi.tanabe@salto.link",
      avatarUrl:
        "https://ui-avatars.com/api/?background=c7d2fe&color=3730a3&bold=true",
    },
    menuItems: [
      { icon: faUser, text: "My Page" },
      { icon: faPalette, text: "Theme", action: toggleThemeModal }, // Ensure this function is defined or imported
      { icon: faSignOutAlt, text: "Logout" },
    ],
  };

  return (
    <div className="border-t flex p-4 ml-1 bg-coolGray-50 mt-auto z-30">
      <img
        src={sidebarData.user.avatarUrl}
        alt="User Avatar"
        className="w-10 h-10 rounded-md"
      />
      <div className="flex flex-grow items-center justify-between">
        <div>
          <h4 className="font-semibold text-slate-100 ml-3">
            {sidebarData.user.name}
          </h4>
          <span className="text-xs text-slate-300 ml-3">
            {sidebarData.user.email}
          </span>
        </div>
        <div className="dropdown dropdown-top">
          <div
            tabIndex={0}
            className="m-1 cursor-pointer"
            onClick={toggleDropdown}
          >
            <FontAwesomeIcon
              icon={faEllipsisV}
              size="lg"
              className="text-slate-100 hover:text-slate-300"
            />
          </div>
          {isDropdownOpen && (
            <ul
              tabIndex={0}
              className="dropdown-content menu p-2 shadow bg-base-100 rounded-lg w-52"
            >
              {sidebarData.menuItems.map((item, index) => (
                <li key={index}>
                  <button onClick={item.action} className="text-white">
                    <FontAwesomeIcon
                      icon={item.icon}
                      className="mr-2 text-white"
                    />
                    {item.text}
                  </button>
                </li>
              ))}
            </ul>
          )}
        </div>
      </div>
      
      {isThemeModalOpen && (
        <div className="modal modal-open">
          <div className="modal-box relative">
            <h3 className="font-bold text-lg">Select Theme</h3>
            <ThemeSelector />
            <div className="modal-action">
              <label
                htmlFor="my-modal"
                className="btn"
                onClick={toggleThemeModal}
              >
                Close
              </label>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};
