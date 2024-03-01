import React from 'react';

const Post = ({ item, posts}) => {
  const postName = posts[item.attributes.pos_id] || 'Unknown';  
  
  return (
    <span>{postName}</span>
  );
};

export default Post;
