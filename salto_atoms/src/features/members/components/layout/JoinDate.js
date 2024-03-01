import React from 'react';

const JoinDate = ({ item }) => {
  return (
    <span>{item.attributes.join_date.startDate}</span>
  );
};

export default JoinDate;
