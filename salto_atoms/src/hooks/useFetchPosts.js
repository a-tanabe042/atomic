import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

const useFetchPosts = () => {
  const API_ENDPOINT = 'api/posts';
  const { data, fetchData } = useFetchApi({});
  const [posts, setPosts] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      const map = data[API_ENDPOINT].data.reduce((acc, {attributes}) => {
        acc[attributes.pos_id] =  attributes.pos_name;
        return acc;
      }, {});
      setPosts(map);
    }
  }, [data]);

  return posts;
};

export default useFetchPosts;
