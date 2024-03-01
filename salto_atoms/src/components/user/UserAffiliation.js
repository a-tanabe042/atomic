import React from "react";

const UserAffiliation = ({ departments, sections, groups, loginUser }) => {
  const departmentName = departments[loginUser.attributes.dep_id] || "";
  const sectionName = sections[loginUser.attributes.section_id] || "";
  const groupName = groups[loginUser.attributes.group_id] || "";

  return (
    <div className="mb-4">
      <h3 className="text-lg font-semibold">所属:</h3>
      <p>{departmentName} {sectionName} {groupName} </p>
    </div>
  );
};

export default UserAffiliation;
