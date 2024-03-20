import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';
import { GroupType } from '../../types'; // Groupインターフェースを適切な場所からインポートします

interface ApiResponseType {
  data: {
    id: string;
    attributes: {
      group_name: string;
    };
  }[];
}

// 所属グループの取得
const useFetchGroups = () => {
  const API_ENDPOINT = 'api/groups';
  const { data: groupsData, fetchData: fetchGroups } = useFetchApi();
  const [groupsList, setGroupsList] = useState<GroupType[]>([]); 

  useEffect(() => {
    fetchGroups(API_ENDPOINT);
  }, [fetchGroups]);

  useEffect(() => {
    if (groupsData && groupsData[API_ENDPOINT]) {
      const groupsArray= (groupsData[API_ENDPOINT] as ApiResponseType).data.map(({ id,attributes }) => ({
        group_id: id,
        group_name: attributes.group_name
      }));
      setGroupsList(groupsArray);
    }
  }, [groupsData]);

  return groupsList;
};

export default useFetchGroups;
