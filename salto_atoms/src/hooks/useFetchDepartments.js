import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

const useFetchDepartments = () => {
  const { data, fetchData } = useFetchApi({});
  const [departments, setDepartments] = useState([]);

  useEffect(() => {
    fetchData('api/departments');
  }, [fetchData]);

  useEffect(() => {
    if (data && data['api/departments']) {
      const departmentMap = data['api/departments'].data.reduce((acc, {attributes}) => {
        acc[attributes.dep_id] = attributes.dep_name;
        return acc;
      }, {});
      setDepartments(departmentMap);
    }
  }, [data]);

  return departments;
};

export default useFetchDepartments;
