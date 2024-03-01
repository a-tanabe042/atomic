import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

const useFetchDepartments = () => {
  const API_ENDPOINT = 'api/departments';
  const { data, fetchData } = useFetchApi({});
  const [departments, setDepartments] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      const map = data[API_ENDPOINT].data.reduce((acc, {attributes}) => {
        acc[attributes.dep_id] = attributes.dep_name;
        return acc;
      }, {});
      setDepartments(map);
    }
  }, [data]);

  return departments;
};

export default useFetchDepartments;
