import React from "react";
import SidebarSubmenu from "./SidebarSubmenu";
import routes from "../routes/sidebar";
import RightSideBarNavLink from './RightSideBarNavLink';

// Routeの型を定義します
interface Route {
  name: string;
  path?: string; // パスがない項目もあるかもしれないため、オプショナルにします
  submenu?: Route[]; // submenuもまたRouteの配列を持つ可能性があります
}

const RightSidebar: React.FC = () => {
  // `settings`と`otherRoutes`のフィルタリングには定義した型を使用します
  const settings = routes.filter((route: Route) => route.name === "設定");
  const otherRoutes = routes.filter((route: Route) => route.name !== "設定");

  return (
    <div className="w-30 mr-5 my-8 bg-base-100 shadow-xl rounded-2xl flex flex-col">
      <ul className="p-4 overflow-y-auto flex-1">
        {otherRoutes.map((route, k) => (
          <li key={k} className="my-2">
            {route.submenu ? (
              <SidebarSubmenu {...route} />
            ) : (
              <RightSideBarNavLink route={route} />
            )}
          </li>
        ))}
      </ul>
      <ul className="p-4">
        {settings.map((route, k) => (
          <li key={k} className="my-2">
            {route.submenu ? (
              <SidebarSubmenu {...route} />
            ) : (
              <RightSideBarNavLink route={route} />
            )}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default RightSidebar;
