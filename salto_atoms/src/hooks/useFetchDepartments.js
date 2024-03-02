import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

{/* 所属部署の取得 */} 
const useFetchDepartments = () => {
  const API_ENDPOINT = 'api/departments';
  const { data, fetchData } = useFetchApi({});
  const [departments, setDepartments] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      const departmentsArray = data[API_ENDPOINT].data.map(({ attributes }) => ({
        dep_id: attributes.dep_id,
        dep_name: attributes.dep_name
      }));
      setDepartments(departmentsArray);
    }
  }, [data]);
  

  return departments;
};

export default useFetchDepartments;
