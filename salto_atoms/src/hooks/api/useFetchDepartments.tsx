import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';
import { Department } from '../../types'; // 適宜パスを調整してください

interface ApiResponse {
  data: {
    id: string;
    attributes: {
      dep_name: string;
    };
  }[];
}


// 所属部署の取得
const useFetchDepartments = () => {
  const API_ENDPOINT = 'api/departments';
  const { data: departmentsData, fetchData: fetchDepartments } = useFetchApi();
  const [departmentsList, setDepartmentsList] = useState<Department[]>([]);

  useEffect(() => {
    fetchDepartments(API_ENDPOINT);
  }, [fetchDepartments]);

  useEffect(() => {
    if (departmentsData && departmentsData[API_ENDPOINT]) {
      const departmentsArray = (departmentsData[API_ENDPOINT] as ApiResponse).data.map(({ id, attributes }) => ({
        dep_id: id,
        dep_name: attributes.dep_name
      }));
      setDepartmentsList(departmentsArray);
    }
  }, [departmentsData]);

  return departmentsList;
};

export default useFetchDepartments;
