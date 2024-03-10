import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

/* 全ユーザー情報の取得 */
const useFetchUsers = () => {
  const API_ENDPOINT = 'api/user-saltos';
  const { data: usersData, fetchData: fetchUsers } = useFetchApi({});
  const [usersList, setUsersList] = useState([]);

  useEffect(() => {
    fetchUsers(API_ENDPOINT);
  }, [fetchUsers]);

  useEffect(() => {
    if (usersData && usersData[API_ENDPOINT]) {
      setUsersList(usersData[API_ENDPOINT].data);
    }
  }, [usersData]);

  return usersList;
};

export default useFetchUsers;
