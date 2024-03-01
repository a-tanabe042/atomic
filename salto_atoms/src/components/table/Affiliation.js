import React from 'react';

const Affiliation = ({ item, departments, sections, groups }) => {
  const departmentName = departments[item.attributes.dep_id] || 'Unknown';  
  const sectionName = sections[item.attributes.section_id] || 'Unknown';  
  const groupName = groups[item.attributes.group_id] || 'Unknown';  
  
  return (
    <div className='text-center text-xs'>
      <span>{departmentName}</span>
      <span>{sectionName}</span>
      <span>{groupName}</span>
    </div>
  );
};

export default Affiliation;
