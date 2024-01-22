import React, { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faFolder,
  faComments,
  faBook,
} from "@fortawesome/free-solid-svg-icons";

import { SidebarDescription } from "./SidebarDescription";
import { SidebarFolder } from "./SidebarFolder";
import { SidebarComment } from "./SidebarComment";

const tabsData = [
  { name: "Description", icon: faBook, component: <SidebarDescription /> },
  { name: "Files", icon: faFolder, component: <SidebarFolder /> },
  { name: "Comments", icon: faComments, component: <SidebarComment /> },
];

export const SidebarTabContent = () => {
  const [content, setContent] = useState(<SidebarDescription />);

  const renderTabs = () => {
    return tabsData.map((tab, index) => (
      <li key={index}>
        <button
          className="text-center p-1 mx-1"
          onClick={() => setContent(tab.component)}
        >
          <FontAwesomeIcon icon={tab.icon} color="white" />
          <span className="text-white text-xs text-left">{tab.name}</span>
        </button>
      </li>
    ));
  };

  return (
    <div>
      <ul className="menu menu-vertical lg:menu-horizontal rounded-box">
        {renderTabs()}
      </ul>
      <div className="content p-4 h-full overflow-auto">{content}</div>
    </div>
  );
};
