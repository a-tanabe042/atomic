import routes from "../routes/sidebar";
import { NavLink } from "react-router-dom";
import SidebarSubmenu from "./SidebarSubmenu";

function RightSidebar() {
  return (
    <div className="w-30  mr-5 my-8 bg-base-100 shadow-xl rounded-2xl opacity-70">
      <ul className="p-4 overflow-y-auto">
        {routes.map((route, k) => (
          <li key={k} className="my-2">
            {route.submenu ? (
              <SidebarSubmenu {...route} />
            ) : (
              <NavLink
                to={route.path}
                className="block p-2 rounded-full shadow-xl"
              >
                <div className="flex items-center justify-center w-12 h-12 rounded-full">
                  {route.icon}
                </div>
              </NavLink>
            )}
          </li>
        ))}
      </ul>
    </div>
  );
}

export default RightSidebar;
