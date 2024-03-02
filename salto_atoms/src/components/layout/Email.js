import React from 'react';

{/* MailAddress */} 
const Email = ({ item }) => {
  return (
    <div className='text-center text-xs'>
    <span>{item.attributes.email}</span>
    </div>
  );
};

export default Email;
