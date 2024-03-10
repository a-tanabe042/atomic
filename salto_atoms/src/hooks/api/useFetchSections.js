import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';

/* 所属課の取得 */
const useFetchSections = () => {
  const API_ENDPOINT = 'api/sections';
  const { data: sectionsData, fetchData: fetchSections } = useFetchApi({});
  const [sectionsList, setSectionsList] = useState([]);

  useEffect(() => {
    fetchSections(API_ENDPOINT);
  }, [fetchSections]);

  useEffect(() => {
    if (sectionsData && sectionsData[API_ENDPOINT]) {
      const sectionsArray = sectionsData[API_ENDPOINT].data.map(({ attributes: section }) => ({
        section_id: section.section_id,
        section_name: section.section_name
      }));
      setSectionsList(sectionsArray);
    }
  }, [sectionsData]);

  return sectionsList;
};

export default useFetchSections;
