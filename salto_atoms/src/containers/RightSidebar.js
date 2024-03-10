import routes from "../routes/sidebar";
import { NavLink } from "react-router-dom";
import SidebarSubmenu from "./SidebarSubmenu";

function RightSidebar() {
  return (
    <div className="w-30 bg-base-100 opacity-90 mx-5 my-8 shadow-xl rounded-2xl">
      <label htmlFor="right-sidebar-drawer" className="drawer-overlay"></label>
      <ul className="p-4 overflow-y-auto"> 
        {routes.map((route, k) => (
            <li key={k} className="my-2">
              {route.submenu ? (
                <SidebarSubmenu {...route} />
              ) : (
                <NavLink
                  end
                  to={route.path}
                  className={({ isActive }) =>
                    `block p-2 rounded-full transition duration-300 shadow-xl
                     ${isActive ? "bg-gray-300 text-white" : " hover:bg-gray-100"}` 
                  }
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
