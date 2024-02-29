import React from 'react';

function Department({ dep_Id, departments }) {
    // Look up department name using dep_Id; default to 'Unknown' if not found
    const departmentName = departments[dep_Id] || 'Unknown';
    return (
      <span>{departmentName}</span>
    );
  }
  

export default Department;
