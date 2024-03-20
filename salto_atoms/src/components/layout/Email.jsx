import React from "react";

/* メールアドレス*/
const Email = ({ item }) => {
  return (
    <div className="text-center text-xs">
      <span>{item.attributes.email}</span>
    </div>
  );
};

export default Email;
