import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';
import { Post } from '../../types';

interface ApiResponse{
  data:{
    id: string;
    attributes:{
      pos_name: string;
    }
  }[];
}

/* 役職の取得 */
const useFetchPosts = () => {
  const API_ENDPOINT = 'api/posts';
  const { data: postData, fetchData: fetchPosts } = useFetchApi();
  const [postsList, setPostsList] = useState<Post[]>([]);

  useEffect(() => {
    fetchPosts(API_ENDPOINT);
  }, [fetchPosts]);

  useEffect(() => {
    if (postData && postData[API_ENDPOINT]) {
      const postsArray = (postData[API_ENDPOINT] as ApiResponse).data.map(({ id, attributes }) => ({
        pos_id: id,
        pos_name: attributes.pos_name
      }));
      setPostsList(postsArray);
    }
  }, [postData]);

  return postsList;
};

export default useFetchPosts;
