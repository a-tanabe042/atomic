import React from "react";
import { Link } from "react-router-dom";

const UserIconDropdown = ({ profilePicture, logoutUser }) => {
  return (
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
          <Link to={"/app/settings-profile"}>プロフィール編集</Link>
        </li>
        <li>
          <Link to={"/app/affiliation"}>所属部署</Link>
        </li>
        <div className="divider mt-0 mb-0"></div>
        <li>
          <button onClick={logoutUser}>ログアウト</button>
        </li>
      </ul>
    </div>
  );
};

export default UserIconDropdown;
