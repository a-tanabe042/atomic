import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

/* 所属グループの取得 */
const useFetchGroups = () => {
  const API_ENDPOINT = 'api/groups';
  const { data, fetchData } = useFetchApi({});
  const [groups, setGroups] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      const groupsArray = data[API_ENDPOINT].data.map(({ attributes }) => ({
        group_id: attributes.group_id,
        group_name: attributes.group_name
      }));
      setGroups(groupsArray);
    }
  }, [data]);
  

  return groups;
};

export default useFetchGroups;
