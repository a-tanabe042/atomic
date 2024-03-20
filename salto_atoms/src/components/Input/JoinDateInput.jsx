import React from "react";
import Datepicker from "react-tailwindcss-datepicker";

/* 日付フォーム */
const JoinDateInput = ({ joinDate, setJoinDate }) => {

  const handleValueChange = (value) => {
    setJoinDate(value);
  };

  return (
    <div className="flex-1"> 
      <label htmlFor="joinDate" className="label">入社日</label>
      <Datepicker
        id="joinDate"
        useRange={false}
        asSingle={true}
        value={joinDate} 
        onChange={handleValueChange}
        showShortcuts={true}
        displayFormat={"YYYY/MM/DD"} 
        inputClassName="input input-bordered w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
      />
    </div>
  );
};

export default JoinDateInput;
