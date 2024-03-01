import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

const useFetchSections = () => {
  const API_ENDPOINT = 'api/sections';
  const { data, fetchData } = useFetchApi({});
  const [sections, setSections] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      const map = data[API_ENDPOINT].data.reduce((acc, {attributes}) => {
        acc[attributes.section_id] =  attributes.section_name;
        return acc;
      }, {});
      setSections(map);
    }
  }, [data]);

  return sections;
};

export default useFetchSections;
