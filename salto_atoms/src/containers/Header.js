import React, { useEffect, useState } from "react";
import { themeChange } from "theme-change";
import { Link } from "react-router-dom";
import Bars3Icon from "@heroicons/react/24/outline/Bars3Icon";
import MoonIcon from "@heroicons/react/24/outline/MoonIcon";
import SunIcon from "@heroicons/react/24/outline/SunIcon";
import useFetchGoogleId from "../hooks/useFetchGoogleId";
import useStrapi from "../hooks/useStrapi";

function Header() {
  const { pageTitle } = (state) => state.header;
  const [currentTheme, setCurrentTheme] = useState(
    localStorage.getItem("theme")
  );
  const [profilePicture, setProfilePicture] = useState("");
  const [, setItemId] = useState(null);

  const accessToken = localStorage.getItem("access_token");
  const googleId = useFetchGoogleId(accessToken);
  const { data: membersData } = useStrapi("user-saltos", {});

  useEffect(() => {
    const user = membersData?.data?.find(
      (user) => user.attributes.google_id === googleId
    );

    if (user) {
      setProfilePicture(user.attributes.picture || "");
      setItemId(user.id);
    }
  }, [membersData, googleId]);

  useEffect(() => {
    themeChange(false);
    if (currentTheme === null) {
      setCurrentTheme(
        window.matchMedia &&
          window.matchMedia("(prefers-color-scheme: dark)").matches
          ? "dark"
          : "light"
      );
    }
  }, []);

  useEffect(() => {
    themeChange(false);
    if (currentTheme === null) {
      if (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
      ) {
        setCurrentTheme("dark");
      } else {
        setCurrentTheme("light");
      }
    }
  }, []);

  function logoutUser() {
    localStorage.removeItem("id_token");
    localStorage.removeItem("access_token");
    window.location.href = "/";
  }

  return (
    <>
      <div className="navbar  flex justify-between bg-base-100  z-10 shadow-md ">
        <div className="">
          <label
            htmlFor="left-sidebar-drawer"
            className="btn lg:hidden"
          >
            <Bars3Icon className="h-4 inline-block w-4" />
          </label>
          <h1 className="text-2xl font-semibold ml-2">{pageTitle}</h1>
        </div>

        <div className="order-last">
          <label className="swap ">
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
              <li className="justify-between">
                <Link to={"/app/settings-profile"}>Profile Settings</Link>
              </li>
              <li className="">
                <Link to={"/app/settings-team"}>所属部署</Link>
              </li>
              <div className="divider mt-0 mb-0"></div>
              <li>
                <a onClick={logoutUser}>Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </>
  );
}

export default Header;
