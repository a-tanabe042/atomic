import React, { useState, useEffect } from "react";
import useFetchPosts from "../../hooks/api/useFetchPosts";

interface Post {
  pos_id: string;
  pos_name: string;
}


interface PostInputProps {
  postId: string | "";
  setPostId: (postId: string | "") => void;
}

const PostInput : React.FC<PostInputProps> = ({ postId, setPostId }) => {
  const posts = useFetchPosts();
  const [selectedPost, setSelectedPost] = useState<string | "">(postId);

  useEffect(() => {
    setSelectedPost(postId);
  }, [postId]);

  const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const newPostId = e.target.value || "";
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
        <option value="">選択してください</option>
        {posts.map((pos: Post) => (
          <option key={pos.pos_id} value={pos.pos_id}>
            {pos.pos_name}
          </option>
        ))}
      </select>
    </div>
  );
};

export default PostInput;
