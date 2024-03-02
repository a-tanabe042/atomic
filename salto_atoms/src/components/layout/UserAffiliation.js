import React from "react";

const UserAffiliation = ({ departments, sections, groups, loginUser }) => {
  // loginUserを使用して正しいIDを取得
  const departmentName = departments[loginUser.attributes.dep_id]?.dep_name || 'Unknown';
  const sectionName = sections[loginUser.attributes.section_id]?.section_name || 'Unknown';
  const groupName = groups[loginUser.attributes.group_id]?.group_name || 'Unknown';

  return (
    <div className="mb-4">
      <span>{departmentName} {sectionName} {groupName}</span>
    </div>
  );
};

export default UserAffiliation;
