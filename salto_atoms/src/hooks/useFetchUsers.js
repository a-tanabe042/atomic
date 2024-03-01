import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

const useFetchUsers = () => {
  const { data, fetchData } = useFetchApi({});
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetchData('api/user-saltos');
  }, [fetchData]);

  useEffect(() => {
    if (data && data['api/user-saltos']) {
      setUsers(data['api/user-saltos'].data);
    }
  }, [data]);

  return users;
};

export default useFetchUsers;
