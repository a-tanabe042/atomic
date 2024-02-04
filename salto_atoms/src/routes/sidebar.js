import React from "react";
// 既存のアイコンのインポート
// import BellIcon from "@heroicons/react/24/outline/BellIcon";
// import DocumentTextIcon from "@heroicons/react/24/outline/DocumentTextIcon";
import Squares2X2Icon from "@heroicons/react/24/outline/Squares2X2Icon";
// import TableCellsIcon from "@heroicons/react/24/outline/TableCellsIcon";
// import WalletIcon from "@heroicons/react/24/outline/WalletIcon";
import CodeBracketSquareIcon from "@heroicons/react/24/outline/CodeBracketSquareIcon";
// import DocumentIcon from "@heroicons/react/24/outline/DocumentIcon";
// import ExclamationTriangleIcon from "@heroicons/react/24/outline/ExclamationTriangleIcon";
// import CalendarDaysIcon from "@heroicons/react/24/outline/CalendarDaysIcon";
// import ArrowRightOnRectangleIcon from "@heroicons/react/24/outline/ArrowRightOnRectangleIcon";
import UserIcon from "@heroicons/react/24/outline/UserIcon";
import Cog6ToothIcon from "@heroicons/react/24/outline/Cog6ToothIcon";
import BoltIcon from "@heroicons/react/24/outline/BoltIcon";
import ChartBarIcon from "@heroicons/react/24/outline/ChartBarIcon";
// import CurrencyDollarIcon from "@heroicons/react/24/outline/CurrencyDollarIcon";
// import InboxArrowDownIcon from "@heroicons/react/24/outline/InboxArrowDownIcon";
import UsersIcon from "@heroicons/react/24/outline/UsersIcon";
// import KeyIcon from "@heroicons/react/24/outline/KeyIcon";
import DocumentDuplicateIcon from "@heroicons/react/24/outline/DocumentDuplicateIcon";
import BookOpenIcon from "@heroicons/react/24/outline/BookOpenIcon";
import BuildingOfficeIcon from "@heroicons/react/24/outline/BuildingOffice2Icon";

const iconClasses = `h-6 w-6`;
const submenuIconClasses = `h-5 w-5`;

const routes = [
  {
    path: "/app/dashboard",
    icon: <Squares2X2Icon className={iconClasses} />,
    name: "Dashboard",
  },
  {
    path: "/app/code",
    icon: <CodeBracketSquareIcon className={iconClasses} />, // アイコン変更
    name: "Salto Code",
  },
  {
    path: "/app/projects",
    icon: <BoltIcon className={iconClasses} />,
    name: "Projects",
  },
  {
    path: "/app/teams",
    icon: <UsersIcon className={iconClasses} />, // アイコン変更
    name: "Project Teams",
  },
  {
    path: "/app/charts",
    icon: <ChartBarIcon className={iconClasses} />,
    name: "Analytics",
  },
  {
    path: "/app/members",
    icon: <BookOpenIcon className={iconClasses} />, // アイコン変更
    name: "Salto図鑑",
  },
  // {
  //   path: "/app/calendar", // url
  //   icon: <CalendarDaysIcon className={iconClasses} />, // icon component
  //   name: "Calendar", // name that appear in Sidebar
  // },

  // {
  //   path: "", //no url needed as this has submenu
  //   icon: <DocumentDuplicateIcon className={`${iconClasses} inline`} />, // icon component
  //   name: "Pages", // name that appear in Sidebar
  //   submenu: [
  //     {
  //       path: "/login",
  //       icon: <ArrowRightOnRectangleIcon className={submenuIconClasses} />,
  //       name: "Login",
  //     },
  //     {
  //       path: "/register", //url
  //       icon: <UserIcon className={submenuIconClasses} />, // icon component
  //       name: "Register", // name that appear in Sidebar
  //     },
  //     {
  //       path: "/forgot-password",
  //       icon: <KeyIcon className={submenuIconClasses} />,
  //       name: "Forgot Password",
  //     },
  //     {
  //       path: "/app/blank",
  //       icon: <DocumentIcon className={submenuIconClasses} />,
  //       name: "Blank Page",
  //     },
  //     {
  //       path: "/app/404",
  //       icon: <ExclamationTriangleIcon className={submenuIconClasses} />,
  //       name: "404",
  //     },
  //   ],
  // },
  {
    path: "", //no url needed as this has submenu
    icon: <Cog6ToothIcon className={`${iconClasses} inline`} />, // icon component
    name: "Settings", // name that appear in Sidebar
    submenu: [
      {
        path: "/app/settings-profile", //url
        icon: <UserIcon className={submenuIconClasses} />, // icon component
        name: "Profile", // name that appear in Sidebar
      },
      {
        path: "/app/settings-team", // url
        icon: <BuildingOfficeIcon className={submenuIconClasses} />, // icon component
        name: "所属部署", // name that appear in Sidebar
      },
      {
        path: "/app/settings-organization-chart",
        icon:  <DocumentDuplicateIcon className={`${iconClasses} inline`} />,
        name: "組織図",
      },
    ],
  },
  // {
  //   path: "", //no url needed as this has submenu
  //   icon: <DocumentTextIcon className={`${iconClasses} inline`} />, // icon component
  //   name: "Documentation", // name that appear in Sidebar
  //   submenu: [
  //     {
  //       path: "/app/getting-started", // url
  //       icon: <DocumentTextIcon className={submenuIconClasses} />, // icon component
  //       name: "Getting Started", // name that appear in Sidebar
  //     },
  //     {
  //       path: "/app/features",
  //       icon: <TableCellsIcon className={submenuIconClasses} />,
  //       name: "Features",
  //     },
  //     {
  //       path: "/app/components",
  //       icon: <CodeBracketSquareIcon className={submenuIconClasses} />,
  //       name: "Components",
  //     },
  //   ],
  // },
];

export default routes;