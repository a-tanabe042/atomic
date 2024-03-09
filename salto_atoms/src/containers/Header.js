import React, { useEffect, useState } from "react";
import { themeChange } from "theme-change";
import { Link } from "react-router-dom";
import MoonIcon from "@heroicons/react/24/outline/MoonIcon";
import SunIcon from "@heroicons/react/24/outline/SunIcon";
import useFetchGoogleId from "../hooks/useFetchGoogleId";
import useFetchLoginUser from "../hooks/useFetchLoginUser";

function Header() {
  const [currentTheme, setCurrentTheme] = useState(
    localStorage.getItem("theme")
  );
  const [profilePicture, setProfilePicture] = useState("");
  const accessToken = localStorage.getItem("access_token");
  const googleId = useFetchGoogleId(accessToken);
  const loginUser = useFetchLoginUser();

  useEffect(() => {
    if (loginUser && loginUser.attributes.google_id === googleId) {
      setProfilePicture(loginUser.attributes.picture || "/logo512.png");
    }
  }, [loginUser, googleId]);

  useEffect(() => {
    if (currentTheme === null) {
      setCurrentTheme(
        window.matchMedia &&
          window.matchMedia("(prefers-color-scheme: dark)").matches
          ? "dark"
          : "light"
      );
    }
    themeChange(false);
  }, [currentTheme]);

  function logoutUser() {
    localStorage.removeItem("id_token");
    localStorage.removeItem("access_token");
    window.location.href = "/";
  }

  return (
    <>
      <div className="navbar  flex justify-between bg-base-100  z-10 shadow-md ">
        <div className="flex items-center font-semibold text-xl space-x-2">
          <Link to={"/app/welcome"} className="flex items-center">
            <img
              className="mask mask-squircle w-10 mr-3"
              src="/logo192.png"
              alt="Salto Atoms Logo"
            />
            <span>SALTO Atoms</span>
          </Link>
        </div>
        {/*テーマ*/}
        <div className="order-last">
          <label className="swap">
            <input type="checkbox" />
            <SunIcon
              data-set-theme="light"
              data-act-class="ACTIVECLASS"
              className={
                "fill-current w-6 h-6 " +
                (currentTheme === "dark" ? "swap-on" : "swap-off")
              }
            />
            <MoonIcon
              data-set-theme="dark"
              data-act-class="ACTIVECLASS"
              className={
                "fill-current w-6 h-6 " +
                (currentTheme === "light" ? "swap-on" : "swap-off")
              }
            />
          </label>
          {/*ユーザーアイコン ドロップダウン*/}
          <div className="dropdown dropdown-end ml-4">
            <label tabIndex={0} className="btn btn-ghost btn-circle avatar">
              <div className="w-10 rounded-full">
                <img src={profilePicture || "/logo512.png"} alt="profile" />
              </div>
            </label>
            <ul
              tabIndex={0}
              className="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
            >
              <li className="justify-between mb-1">
                <Link to={"/app/settings-profile"}>Profile Settings</Link>
              </li>
              <li className="">
                <Link to={"/app/affiliation"}>Affiliation</Link>
              </li>
              <div className="divider mt-0 mb-0"></div>
              <li>
                <button href="" onClick={logoutUser}>
                  Logout
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </>
  );
}

export default Header;
