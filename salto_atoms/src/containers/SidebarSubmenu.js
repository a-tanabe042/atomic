import React, { useEffect, useRef, useState } from "react";
import { Link, useLocation } from "react-router-dom";

function SidebarSubmenu({ submenu, icon }) {
  const location = useLocation();
  const [isExpanded, setIsExpanded] = useState(false);
  // ドロップダウンメニューの参照を保持するための ref
  const dropdownRef = useRef(null);

  // ドロップダウンメニュー外のクリックを検出するためのイベントリスナーを追加
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setIsExpanded(false); // メニューの外側がクリックされたら非表示にする
      }
    };

    // イベントリスナーをドキュメントに追加
    document.addEventListener("mousedown", handleClickOutside);

    return () => {
      // コンポーネントがアンマウントされる時にイベントリスナーを削除
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  const toggleSubmenu = (e) => {
    e.stopPropagation(); // イベントの伝播を停止
    setIsExpanded(!isExpanded); // ドロップダウンメニューの表示状態を切り替え
  };

  return (
    <div className="flex flex-col" ref={dropdownRef}>
      <div
        className="w-full p-2 rounded-full transition duration-300 shadow-md flex items-center justify-center cursor-pointer"
        onClick={toggleSubmenu}
      >
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
