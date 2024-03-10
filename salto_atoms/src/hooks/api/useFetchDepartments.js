import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

/* 所属部署の取得 */
const useFetchDepartments = () => {
  const API_ENDPOINT = 'api/departments';
  const { data: departmentsData, fetchData: fetchDepartments } = useFetchApi({});
  const [departmentsList, setDepartmentsList] = useState([]);

  useEffect(() => {
    fetchDepartments(API_ENDPOINT);
  }, [fetchDepartments]);

  useEffect(() => {
    if (departmentsData && departmentsData[API_ENDPOINT]) {
      const departmentsArray = departmentsData[API_ENDPOINT].data.map(({ attributes: department }) => ({
        dep_id: department.dep_id,
        dep_name: department.dep_name
      }));
      setDepartmentsList(departmentsArray);
    }
  }, [departmentsData]);
  

  return departmentsList;
};

export default useFetchDepartments;
