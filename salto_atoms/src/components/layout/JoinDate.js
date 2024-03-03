import React from "react";

/* 日付 */
const JoinDate = ({ item }) => {
  const joinDate = item.attributes.join_date && new Date(item.attributes.join_date.startDate);

  const formattedDate = joinDate
    ? joinDate.toLocaleDateString("ja-JP", {
      year: "numeric",
      month: "2-digit",
      day: "2-digit",
    })
    : "-";

  return (
    <div className="text-center text-xs">
      <span>{formattedDate}</span>
    </div>
  );
};

export default JoinDate;
