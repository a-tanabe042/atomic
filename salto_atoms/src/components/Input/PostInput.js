import React, { useState, useEffect } from "react";
import useFetchPosts from "../../hooks/useFetchPosts";

/* 役職フォーム */
const PostInput = ({ postId, setPostId }) => {
  const posts = useFetchPosts();
  const [selectedPost, setSelectedPost] = useState(
    postId || ""
  );

  useEffect(() => {
    setSelectedPost(postId);
  }, [postId]);

  const handleChange = (e) => {
    const newPostId = e.target.value;
    setSelectedPost(newPostId);
    setPostId(newPostId);
  };

  return (
    <div className="flex-1">
      <label htmlFor="post" className="label">
        役職
      </label>
      <select
        id="post"
        className="select w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
        value={selectedPost}
        onChange={handleChange}
      >
        <option value="">選択して下さい</option>
        {posts.map((pos) => (
          <option key={pos.pos_id} value={pos.pos_id}>
            {pos.pos_name}
          </option>
        ))}
      </select>
    </div>
  );
};

export default PostInput;
