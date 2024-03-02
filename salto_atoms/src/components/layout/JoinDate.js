import React from "react";

{/* 入社年月日 */} 
const JoinDate = ({ item }) => {
  return (
    <div className="text-center text-xs">
      <span>{item.attributes.join_date.startDate}</span>
    </div>
  );
};

export default JoinDate;
