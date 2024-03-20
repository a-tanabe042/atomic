import { useState, useEffect } from 'react';
import useFetchUsers from './useFetchUsers';
import { User } from '../../types'; 

interface FilterCriteria {
  [key: string]: any;
}

const useFilterUsers = (filterCriteria: FilterCriteria) => {
  const users = useFetchUsers();
  const [filteredUsers, setFilteredUsers] = useState<User[]>([]);

  useEffect(() => {
    const filtered = users.filter(user =>
      Object.entries(filterCriteria).every(([key, value]) =>
        user.attributes[key] === value
      )
    );
    setFilteredUsers(filtered);
  }, [users, filterCriteria]);

  return filteredUsers;
};

export default useFilterUsers;
