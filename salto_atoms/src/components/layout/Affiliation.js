import React from "react";

/* 部署　課　グループ */
const Affiliation = ({ item, departments, sections, groups }) => {
  const departmentName =
    departments[item.attributes.dep_id - 1]?.dep_name || "-";
  const sectionName =
    sections[item.attributes.section_id - 1]?.section_name || "-";
  const groupName = groups[item.attributes.group_id - 1]?.group_name || "-";

  return (
    <div className="text-center text-xs">
      <span>{departmentName}</span>
      <span>{sectionName}</span>
      <span>{groupName}</span>
    </div>
  );
};

export default Affiliation;
