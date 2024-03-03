import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

/* 所属部署の取得 */
const useFetchPosts = () => {
  const API_ENDPOINT = 'api/posts';
  const { data, fetchData } = useFetchApi({});
  const [posts, setPosts] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      const postArray = data[API_ENDPOINT].data.map(({ attributes }) => ({
        pos_id: attributes.pos_id,
        pos_name: attributes.pos_name
      }));
      setPosts(postArray);
    }
  }, [data]);

  return posts;
};

export default useFetchPosts;
