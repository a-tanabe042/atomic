import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

/* 役職の取得 */
const useFetchPosts = () => {
  const API_ENDPOINT = 'api/posts';
  const { data: postData, fetchData: fetchPosts } = useFetchApi({});
  const [postsList, setPostsList] = useState([]);

  useEffect(() => {
    fetchPosts(API_ENDPOINT);
  }, [fetchPosts]);

  useEffect(() => {
    if (postData && postData[API_ENDPOINT]) {
      const postsArray = postData[API_ENDPOINT].data.map(({ attributes: post }) => ({
        pos_id: post.pos_id,
        pos_name: post.pos_name
      }));
      setPostsList(postsArray);
    }
  }, [postData]);

  return postsList;
};

export default useFetchPosts;
