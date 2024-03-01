import { useCallback, useState } from 'react';

const apiHost = process.env.REACT_APP_API_HOST;

const useFetchApi = () => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  // 1.Read
  const fetchData = useCallback(async (endpoint) => {
    setLoading(true);
    try {
      const response = await fetch(`${apiHost}/${endpoint}`);
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      const result = await response.json();
      setData(prevData => ({
        ...prevData,
        [endpoint]: result 
      }));
    } catch (e) {
      setError(e.message);
    } finally {
      setLoading(false);
    }
  }, []);
  

  // 2.Create
  const createData = useCallback(async (endpoint, payload) => {
    setLoading(true);
    try {
      const response = await fetch(`${apiHost}/${endpoint}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      const result = await response.json();
      setData(result);
    } catch (e) {
      setError(e.message);
    } finally {
      setLoading(false);
    }
  }, []);

  // 3.Update
  const updateData = useCallback(async (endpoint, payload) => {
    setLoading(true);
    try {
      const response = await fetch(`${apiHost}/${endpoint}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      const result = await response.json();
      setData(result);
    } catch (e) {
      setError(e.message);
    } finally {
      setLoading(false);
    }
  }, []);

  // 4.Delete
  const deleteData = useCallback(async (endpoint) => {
    setLoading(true);
    try {
      const response = await fetch(`${apiHost}/${endpoint}`, {
        method: 'DELETE',
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    } catch (e) {
      setError(e.message);
    } finally {
      setLoading(false);
    }
  }, []);

  return { data, loading, error, fetchData, createData, updateData, deleteData };
};

export default useFetchApi;
