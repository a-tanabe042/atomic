import React from "react";

/* 役職 */
const Post = ({ item, posts }) => {
  const postName = posts[item.attributes.pos_id - 1]?.pos_name || "";
  return (
    <div className="text-center text-xs">
      <span>{postName}</span>
    </div>
  );
};

export default Post;
