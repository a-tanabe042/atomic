import { useEffect, useState } from 'react';
import useFetchApi from './useFetchApi';
import { Section } from '../../types';

interface ApiResponse {
  data: {
    id: string;
    attributes: {
      section_name: string;
    };
  }[];
}

/* 所属課の取得 */
const useFetchSections = () => {
  const API_ENDPOINT = 'api/sections';
  const { data: sectionsData, fetchData: fetchSections } = useFetchApi();
  const [sectionsList, setSectionsList] = useState<Section[]>([]);

  useEffect(() => {
    fetchSections(API_ENDPOINT);
  }, [fetchSections]);

  useEffect(() => {
    if (sectionsData && sectionsData[API_ENDPOINT]) {
      const sectionsArray = (sectionsData[API_ENDPOINT] as ApiResponse).data.map(({ id, attributes }) => ({
        section_id: id,
        section_name: attributes.section_name
      }));
      setSectionsList(sectionsArray);
    }
  }, [sectionsData]);

  return sectionsList;
};

export default useFetchSections;
