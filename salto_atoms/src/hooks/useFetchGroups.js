import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

const useFetchGroups = () => {
  const API_ENDPOINT = 'api/groups';
  const { data, fetchData } = useFetchApi({});
  const [groups, setGroups] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      const map = data[API_ENDPOINT].data.reduce((acc, {attributes}) => {
        acc[attributes.group_id] = attributes.group_name;
        return acc;
      }, {});
      setGroups(map);
    }
  }, [data]);

  return groups;
};

export default useFetchGroups;
