import React from 'react';

{/* 部署　課　グループ */} 
const Affiliation = ({ item, departments, sections, groups }) => {
  const departmentName = departments[item.attributes.dep_id]?.dep_name || 'Unknown';
  const sectionName = sections[item.attributes.section_id]?.section_name || 'Unknown';
  const groupName = groups[item.attributes.group_id]?.group_name || 'Unknown';

  return (
    <div className='text-center text-xs'>
      <span>{departmentName}</span>
      {' | '}
      <span>{sectionName}</span>
      {' | '}
      <span>{groupName}</span>
    </div>
  );
};


export default Affiliation;
