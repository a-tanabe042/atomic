import React from 'react';

const Department = ({ dep_id, departments }) => {
  const departmentName = departments[dep_id] || 'Unknown';
  
  return (
    <span>{departmentName}</span>
  );
};

export default Department;
