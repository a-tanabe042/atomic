import React from "react";

/* ログインユーザー名前フォーム */
const UserNameInput = ({ firstName, setFirstName, lastName, setLastName }) => {
  return (
    <div className="flex items-center space-x-4 w-full"> 
      <div className="flex-1">
        <label htmlFor="firstName"  className="label">性</label>
        <input
          id="firstName"
          type="text"
          value={firstName}
          onChange={(e) => setFirstName(e.target.value)}
          className="input input-bordered w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
          placeholder="First Name"
        />
      </div>
      <div className="flex-1"> 
        <label htmlFor="lastName"  className="label">名</label>
        <input
          id="lastName"
          type="text"
          value={lastName}
          onChange={(e) => setLastName(e.target.value)}
          className="input input-bordered w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
          placeholder="Last Name"
        />
      </div>
    </div>
  );
};

export default UserNameInput;
