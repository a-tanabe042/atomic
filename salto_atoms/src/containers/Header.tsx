import React, { useEffect, useState } from "react";
import { themeChange } from "theme-change";
import Logo from "../components/common/Logo";
import UserIconDropdown from "../components/dropdown/UserIconDropdown";
import ThemeSwitch from "../components/common/ThemeSwitch"; 
import useFetchGoogleId from "../hooks/api/useFetchGoogleId";
import useFetchLoginUser from "../hooks/api/useFetchLoginUser";

interface User {
  attributes: {
    google_id: string;
    picture?: string;
  };
}

const Header: React.FC = () => {
  const [currentTheme, setCurrentTheme] = useState<string>(() => {
    return localStorage.getItem("theme") || (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
  });
  const [profilePicture, setProfilePicture] = useState<string>("");
  const accessToken = localStorage.getItem("access_token") || "";
  const googleId = useFetchGoogleId(accessToken);
  const loginUser = useFetchLoginUser() as User | null;

  useEffect(() => {
    if (loginUser && loginUser.attributes.google_id === googleId) {
      setProfilePicture(loginUser.attributes.picture || "/logo512.png");
    }
  }, [loginUser, googleId]);

  useEffect(() => {
    themeChange(false); 
  }, [currentTheme]);

  function logoutUser() {
    localStorage.removeItem("id_token");
    localStorage.removeItem("access_token");
    window.location.href = "/";
  }

  return (
    <>
      <div className="navbar flex justify-between bg-base-100 z-10 shadow-xl">
        <Logo />
        <div className="order-last flex items-center">
          <ThemeSwitch currentTheme={currentTheme} setCurrentTheme={setCurrentTheme} />
          <UserIconDropdown profilePicture={profilePicture} logoutUser={logoutUser} />
        </div>
      </div>
    </>
  );
};

export default Header;
