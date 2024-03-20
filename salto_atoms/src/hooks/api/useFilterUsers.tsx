import { useState, useEffect } from 'react';
import useFetchUsers from './useFetchUsers';
import { UserType } from '../../types'; 

interface FilterCriteriaType {
  [key: string]: any;
}

const useFilterUsers = (filterCriteria: FilterCriteriaType) => {
  const users = useFetchUsers();
  const [filteredUsers, setFilteredUsers] = useState<UserType[]>([]);

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
