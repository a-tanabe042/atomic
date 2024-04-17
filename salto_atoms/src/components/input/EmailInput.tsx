// FirstNameInput.js
import React from "react";

interface EmailInputProps {
  email: string | "";
}

/* メールフォーム */
const EmailInput: React.FC<EmailInputProps> = ({ email }) => {
  return (
    <div className="flex-1">
      <label htmlFor="email" className="label">
        Email
      </label>
      <input
        type="text"
        id="email"
        value={email}
        className="input input-bordered  w-full border border-gray-300  rounded-lg bg-slate-100 text-black"
        placeholder="Email"
        readOnly
      />
    </div>
  );
};

export default EmailInput;
