import React from "react";
/* ログインユーザー所属部署 */
const UserAffiliation = ({ departments, sections, groups, loginUser }) => {
  const departmentName =
    departments[loginUser.attributes.dep_id - 1]?.dep_name || "";
  const sectionName =
    sections[loginUser.attributes.section_id - 1]?.section_name || "";
  const groupName =
    groups[loginUser.attributes.group_id - 1]?.group_name || "";

  return (
    <div className="mb-4">
      <span>
        {departmentName} {sectionName} {groupName}
      </span>
    </div>
  );
};

export default UserAffiliation;
