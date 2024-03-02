import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

{/* 全ユーザー情報の取得 */} 
const useFetchUsers = () => {
  const API_ENDPOINT = 'api/user-saltos';
  const { data, fetchData } = useFetchApi({});
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      setUsers(data[API_ENDPOINT].data);
    }
  }, [data]);

  return users;
};

export default useFetchUsers;
