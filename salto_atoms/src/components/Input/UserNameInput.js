import React from "react";

/* ユーザー名フォーム */
const UserNameInput = ({ firstName, setFirstName, lastName, setLastName }) => {
  return (
    <div className="flex items-center space-x-4 w-full">
      <div className="flex-1">
        <label htmlFor="firstName" className="label">姓</label>
        <input
          id="firstName"
          type="text"
          value={firstName}
          onChange={(e) => setFirstName(e.target.value)}
          className="input input-bordered w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
          placeholder="姓"
        />
      </div>
      <div className="flex-1">
        <label htmlFor="lastName" className="label">名</label>
        <input
          id="lastName"
          type="text"
          value={lastName}
          onChange={(e) => setLastName(e.target.value)}
          className="input input-bordered w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
          placeholder="名"
        />
      </div>
    </div>
  );
};

export default UserNameInput;
