// FirstNameInput.js
import React from "react";

const UserNameInput = ({ firstName, setFirstName, lastName, setLastName }) => {
  return (
    <div className="">
      <div>
        <label className="label">性</label>
        <input
          type="text"
          value={firstName}
          onChange={(e) => setFirstName(e.target.value)}
          className="input input-bordered w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
          placeholder="First Name"
        />
      </div>
      <div>
        <label className="label">名</label>
        <input
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
