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
    name: "社員一覧",
  },
  {
    path: "",
    icon: <Cog6ToothIcon className={`${iconClasses} inline`} />,
    name: "設定",
    submenu: [
      {
        path: "/app/settings-profile",
        icon: <UserIcon className={submenuIconClasses} />,
        name: "プロフィール編集",
      },
      {
        path: "/app/affiliation",
        icon: <BuildingOfficeIcon className={iconClasses} />,
        name: "所属部署",
      },
    ],
  },
];

export default routes;
