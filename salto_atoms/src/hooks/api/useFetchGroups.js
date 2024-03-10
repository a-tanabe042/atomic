import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

/* 所属グループの取得 */
const useFetchGroups = () => {
  const API_ENDPOINT = 'api/groups';
  const { data: groupsData, fetchData: fetchGroups } = useFetchApi({});
  const [groupsList, setGroupsList] = useState([]);

  useEffect(() => {
    fetchGroups(API_ENDPOINT);
  }, [fetchGroups]);

  useEffect(() => {
    if (groupsData && groupsData[API_ENDPOINT]) {
      const groupsArray = groupsData[API_ENDPOINT].data.map(({ attributes: group }) => ({
        group_id: group.group_id,
        group_name: group.group_name
      }));
      setGroupsList(groupsArray);
    }
  }, [groupsData]);

  return groupsList;
};

export default useFetchGroups;
