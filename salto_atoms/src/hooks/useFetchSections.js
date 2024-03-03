import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

/* 所属課の取得 */
const useFetchSections = () => {
  const API_ENDPOINT = 'api/sections';
  const { data, fetchData } = useFetchApi({});
  const [sections, setSections] = useState([]);

  useEffect(() => {
    fetchData(API_ENDPOINT);
  }, [fetchData]);

  useEffect(() => {
    if (data && data[API_ENDPOINT]) {
      const sectionsArray = data[API_ENDPOINT].data.map(({ attributes }) => ({
        section_id: attributes.section_id,
        section_name: attributes.section_name
      }));
      setSections(sectionsArray);
    }
  }, [data]);
  

  return sections;
};

export default useFetchSections;
