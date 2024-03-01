import React from 'react';

const Post = ({ item, posts}) => {
  const postName = posts[item.attributes.pos_id] || 'Unknown';  
  
  return (
    <div className='text-center text-xs'>
      <span>{postName}</span>
    </div>
  );
};

export default Post;
