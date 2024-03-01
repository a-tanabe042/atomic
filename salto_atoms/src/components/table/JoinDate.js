import React from "react";

const JoinDate = ({ item }) => {
  return (
    <div className="text-center text-xs">
      <span>{item.attributes.join_date.startDate}</span>
    </div>
  );
};

export default JoinDate;
