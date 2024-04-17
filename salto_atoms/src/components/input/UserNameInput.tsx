import React from "react";

interface UserNameInputProps {
  firstName: string | "";
  setFirstName: (value: string | "") => void;
  lastName: string | "";
  setLastName: (value: string | "") => void;
}

/* ユーザー名フォーム */
const UserNameInput:React.FC<UserNameInputProps> = ({ firstName, setFirstName, lastName, setLastName }) => {
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
