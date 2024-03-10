import { useCallback, useState } from 'react';
import { useSetRecoilState } from 'recoil';
import { loadingState } from '../../state'; 
import { errorState } from '../../state'; 

const API_HOST = process.env.REACT_APP_API_HOST;

/* APIの取得 CRUD */
const useFetchApi = () => {
  const [data, setData] = useState({});
  const setLoading = useSetRecoilState(loadingState);
  const setError = useSetRecoilState(errorState);

  const fetchData = useCallback(async (endpoint) => {
    setLoading(true);
    try {
      const response = await fetch(`${API_HOST}/${endpoint}`);
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      const result = await response.json();
      setData(prevData => ({
        ...prevData,
        [endpoint]: result 
      }));
    } catch (e) {
      setError(e.toString());
    } finally {
      setLoading(false);
    }
  }, [setError, setLoading]);
  
  const createData = useCallback(async (endpoint, payload) => {
    setLoading(true);
    try {
      const response = await fetch(`${API_HOST}/${endpoint}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      const result = await response.json();
      setData(result);
    } catch (e) {
      setError(e.toString());
    } finally {
      setLoading(false);
    }
  }, [setError, setLoading]);

  const updateData = useCallback(async (endpoint, payload) => {
    setLoading(true);
    try {
      const response = await fetch(`${API_HOST}/${endpoint}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });
      if (!response.ok) {
        const errorResponse = await response.text(); 
        throw new Error(`HTTP error! status: ${response.status}, body: ${errorResponse}`);
      }
      const result = await response.json();
      setData(result);
    } catch (e) {
      setError(e.toString()); 
    } finally {
      setLoading(false);
    }
  }, [setError, setLoading]);

  const deleteData = useCallback(async (endpoint) => {
    setLoading(true);
    try {
      const response = await fetch(`${API_HOST}/${endpoint}`, {
        method: 'DELETE',
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    } catch (e) {
      setError(e.toString());
    } finally {
      setLoading(false);
    }
  }, [setError, setLoading]);

  return { data, fetchData, createData, updateData, deleteData };
};

export default useFetchApi;



