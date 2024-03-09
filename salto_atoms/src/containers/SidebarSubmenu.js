import React, { useState } from "react";
import { Link, useLocation } from "react-router-dom";

function SidebarSubmenu({ submenu, icon }) {
  const location = useLocation();
  // ドロップダウンの開閉状態を管理するstate。初期値は非表示(false)。
  const [isExpanded, setIsExpanded] = useState(false);

  // ドロップダウンを開閉する関数。イベントの伝播を停止して、状態を切り替える。
  const toggleSubmenu = (e) => {
    e.stopPropagation(); // イベントの伝播を停止
    setIsExpanded(!isExpanded); // 状態を切り替える
  };

  // ドキュメント全体のクリックを監視してドロップダウンを閉じるロジックを削除します。
  // ユーザーの操作によってのみドロップダウンの状態が変更されるようにするためです。

  return (
    <div className="flex flex-col">
      <div className="w-full p-2 rounded-full transition duration-300 shadow-md flex items-center justify-center cursor-pointer" onClick={toggleSubmenu}>
        <div className="w-12 h-12 rounded-full flex items-center justify-center">
          {icon}
        </div>
      </div>

      {isExpanded && (
        <ul
          tabIndex={0}
          className="menu menu-compact dropdown-content p-2 shadow bg-base-100 rounded-box w-52 absolute z-10 right-0 mr-10 mt-20"
        >
          {submenu.map((m, index) => (
            <li key={index} className="justify-between mb-1">
              <Link
                to={m.path}
                className={`block p-2 rounded-md ${location.pathname === m.path ? "bg-base-800" : "hover:bg-gray-100"}`}
              >
                {m.name}
              </Link>
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}

export default SidebarSubmenu;
