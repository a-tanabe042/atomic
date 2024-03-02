import { useState, useEffect } from 'react';
import useFetchUsers from './useFetchUsers';

{/* フィルター条件に沿ったユーザー情報の取得 */} 
const useFilterUsers = (filterCriteria) => {
  const users = useFetchUsers();
  const [filterUsers, setFilterUsers] = useState([]);

  useEffect(() => {
    if (users.length > 0) {
      const filter = users.filter(user => {
        return Object.keys(filterCriteria).every(key => 
          user.attributes[key] === filterCriteria[key]
        );
      });
      setFilterUsers(filter);
    }
  }, [users, filterCriteria]);

  return filterUsers;
};

export default useFilterUsers;
