import React from "react";
import Datepicker from "react-tailwindcss-datepicker";

const JoinDateInput = ({ joinDate, setJoinDate }) => {
  const handleValueChange = (newValue) => {
    console.log("newValue:", newValue);
    if (newValue && newValue.startDate) {
      setJoinDate(new Date(newValue.startDate));
    } else {
      setJoinDate(null); // Clear date if newValue is invalid
    }
  };

  return (
    <div>
      <label className="label">入社日</label>
      <Datepicker
        useRange={false}
        asSingle={true}
        value={{ startDate: joinDate, endDate: joinDate }}
        onChange={handleValueChange}
        showShortcuts={true}
        displayFormat={"YYYY/MM/DD"}
        inputClassName="input input-bordered w-full border border-gray-300 rounded-lg bg-slate-100 text-black" 

      />
    </div>
  );
};

export default JoinDateInput;
