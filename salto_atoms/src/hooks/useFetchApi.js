import { useState, useEffect } from 'react';

const apiHost = process.env.REACT_APP_API_HOST;

const useFetchApi = (endpoints) => {
  const [data, setData] = useState({});
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const serializedEndpoints = JSON.stringify(endpoints);

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        setError(null);

        const parsedEndpoints = JSON.parse(serializedEndpoints); // Parse back to use in the effect

        const results = await Promise.all(
          parsedEndpoints.map(({ endpoint, queryCondition }) =>
            fetch(`${apiHost}/${endpoint}`, {
              headers: { 'Content-Type': 'application/json' },
              ...queryCondition,
            })
            .then(response => {
              if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
              return response.json();
            })
          )
        );

        const newData = parsedEndpoints.reduce((acc, { endpoint }, index) => {
          acc[endpoint] = results[index];
          return acc;
        }, {});

        setData(newData);
      } catch (e) {
        setError(e.message);
        console.error("Error fetching data:", e.message);
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  // Use the serialized string as a dependency
  }, [serializedEndpoints]);

  return { data, loading, error };
};

export default useFetchApi;
