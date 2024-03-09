import React from "react";
import UserIcon from "@heroicons/react/24/outline/UserIcon";
import Cog6ToothIcon from "@heroicons/react/24/outline/Cog6ToothIcon";
import BookOpenIcon from "@heroicons/react/24/outline/BookOpenIcon";
import BuildingOfficeIcon from "@heroicons/react/24/outline/BuildingOffice2Icon";

const iconClasses = `h-7 w-7`;
const submenuIconClasses = `h-7 w-7`;

const routes = [
  {
    path: "/app/member-list",
    icon: <BookOpenIcon className={iconClasses} />,
    name: "Member List",
  },
  {
    path: "",
    icon: <Cog6ToothIcon className={`${iconClasses} inline`} />,
    name: "Settings",
    submenu: [
      {
        path: "/app/settings-profile",
        icon: <UserIcon className={submenuIconClasses} />,
        name: "Profile Settings",
      },
      {
        path: "/app/affiliation",
        icon: <BuildingOfficeIcon className={iconClasses} />,
        name: "Affiliation",
      },
    ],
  },
];

export default routes;
