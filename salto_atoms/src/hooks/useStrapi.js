import { useState, useEffect } from 'react';
const apiHost = process.env.REACT_APP_API_HOST;
const BASE_URL = `${apiHost}/api`;

const useStrapi = (endpoint, queryCondition) => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const url = `${BASE_URL}/${endpoint}`;

  // データの取得
  const findData = async () => {
    try {
      setLoading(true);
      const response = await fetch(url, {
        headers: { 'Content-Type': 'application/json' },
        ...queryCondition,
      });

      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

      const result = await response.json();
      setData(result);
    } catch (e) {
      setError(e.message);
      console.error("Error fetching data:", e.message);
    } finally {
      setLoading(false);
    }
  };

  const queryConditionString = JSON.stringify(queryCondition); // 複雑な式を変数に抽出

  useEffect(() => {
    findData(); 
  }, [url, queryConditionString]); 
  
  // データの更新
  const updateData = async (itemId, updatedData) => {
    const updateUrl = `${url}/${itemId}`;
    try {
      const response = await fetch(updateUrl, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ data: updatedData }),
      });

      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

      const result = await response.json();
      setData(result);  // Update the state with the new data
      return result;
    } catch (e) {
      console.error("Error updating data:", e.message);
      setError(e.message);
      throw e;
    }
  };

  return { data, loading, error, updateData, findData };
};

export default useStrapi;
