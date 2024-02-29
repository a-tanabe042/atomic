import React from "react";

const Name = ({ item }) => {
  return (
    <div className="text-xs flex justify-center">
    {item.attributes.dep_name} 
    </div>
  );
};

export default Name;
