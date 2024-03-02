import React from 'react';

{/* 役職 */} 
const Post = ({ item, posts}) => {
  const postName = posts[item.attributes.pos_id] || 'Unknown';  
  
  return (
    <div className='text-center text-xs'>
      <span>{postName}</span>
    </div>
  );
};

export default Post;
