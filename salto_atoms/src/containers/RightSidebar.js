import routes from "../routes/sidebar";
import { NavLink } from "react-router-dom";
import SidebarSubmenu from "./SidebarSubmenu";

function RightSidebar() {
  return (
    <div className="w-30 bg-base-100 m-5  rounded-2xl"> {/* サイドバーの幅と背景を調整 */}
      <label htmlFor="right-sidebar-drawer" className="drawer-overlay"></label>
      <ul className="p-4 overflow-y-auto"> {/* 'menu'クラスを削除し、パディングとスクロール設定を追加 */}
        {routes.map((route, k) => (
            <li key={k} className="my-2"> {/* リスト項目のマージンを調整 */}
              {route.submenu ? (
                <SidebarSubmenu {...route} />
              ) : (
                <NavLink
                  end
                  to={route.path}
                  className={({ isActive }) =>
                    `block p-2 rounded-full transition duration-300 shadow-md
                     ${isActive ? "bg-gray-300 text-white" : "text-gray-700 hover:bg-gray-100"}` 
                  }
                >
                  <div className="flex items-center justify-center w-12 h-12 rounded-full"> {/* アイコンを中央に配置し、丸くする */}
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
