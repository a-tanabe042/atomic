import React from "react";

/*　ユーザーネーム */
const UserName = ({ item }) => {
  return (
    <div className="flex items-center space-x-3">
      <div className="avatar">
        <div className="mask mask-squircle w-8 h-8">
          <img src={item.attributes.picture} alt="Avatar" />
        </div>
      </div>
      <div>
        <div className="font-bold text-xs">{item.attributes.first_name}</div>
        <div className="text-xs text-gray-500">{item.attributes.last_name}</div>
      </div>
    </div>
  );
};

export default UserName;
