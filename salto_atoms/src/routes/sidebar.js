import React from "react";
import UserIcon from "@heroicons/react/24/outline/UserIcon";
import Cog6ToothIcon from "@heroicons/react/24/outline/Cog6ToothIcon";
import ChartBarIcon from "@heroicons/react/24/outline/ChartBarIcon";
import BookOpenIcon from "@heroicons/react/24/outline/BookOpenIcon";
import BuildingOfficeIcon from "@heroicons/react/24/outline/BuildingOffice2Icon";

const iconClasses = `h-6 w-6`;
const submenuIconClasses = `h-5 w-5`;

const routes = [
  {
    path: "/app/members",
    icon: <BookOpenIcon className={iconClasses} />, // アイコン変更
    name: "Salto 図鑑",
  },
  {
    path: "/app/charts",
    icon: <ChartBarIcon className={iconClasses} />,
    name: "Analytics",
  },
  {
    path: "", 
    icon: <Cog6ToothIcon className={`${iconClasses} inline`} />, 
    name: "Settings", 
    submenu: [
      {
        path: "/app/settings-profile", 
        icon: <UserIcon className={submenuIconClasses} />, 
        name: "Profile", 
      },
      {
        path: "/app/settings-team", 
        icon: <BuildingOfficeIcon className={submenuIconClasses} />, 
        name: "所属部署", 
      },
 
    ],
  },
];

export default routes;