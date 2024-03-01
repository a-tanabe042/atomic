import React from 'react';

const Affiliation = ({ item, departments, sections, groups }) => {
  const departmentName = departments[item.attributes.dep_id] || 'Unknown';  
  const sectionName = sections[item.attributes.section_id] || 'Unknown';  
  const groupName = groups[item.attributes.group_id] || 'Unknown';  
  
  return (
    <span>{departmentName} {sectionName} {groupName}</span>
  );
};

export default Affiliation;
