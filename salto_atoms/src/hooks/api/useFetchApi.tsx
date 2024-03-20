import { useCallback, useState } from "react";
import { useSetRecoilState } from "recoil";
import { loadingState } from "../../state"; // 適宜パスを調整してください
import { errorState } from "../../state"; // 適宜パスを調整してください

const API_HOST = process.env.REACT_APP_API_HOST as string;

interface Data {
  [key: string]: any;
}

// APIの利用を簡易化するフック
const useFetchApi = () => {
  const [data, setData] = useState<Data>({});
  const setLoading = useSetRecoilState(loadingState);
  const setError = useSetRecoilState(errorState);

  // エラーハンドリングを一元化する関数をuseCallbackでメモ化
  const handleError = useCallback((e: unknown) => {
    if (e instanceof Error) {
      // エラーがErrorインスタンスの場合、そのメッセージを使用
      setError(e.message);
    } else {
      // それ以外の場合、一般的なエラーメッセージを設定
      setError("An unknown error occurred");
    }
  }, [setError]);

  const fetchData = useCallback(async (endpoint: string): Promise<void> => {
    setLoading(true);
    try {
      const response = await fetch(`${API_HOST}/${endpoint}`);
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      const result = await response.json();
      setData((prevData) => ({
        ...prevData,
        [endpoint]: result,
      }));
    } catch (e) {
      handleError(e);
    } finally {
      setLoading(false);
    }
  }, [setLoading, handleError]);

  const createData = useCallback(async (endpoint: string, payload: object): Promise<void> => {
    setLoading(true);
    try {
      const response = await fetch(`${API_HOST}/${endpoint}`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      const result = await response.json();
      setData(result);
    } catch (e) {
      handleError(e);
    } finally {
      setLoading(false);
    }
  }, [setLoading, handleError]);

  const updateData = useCallback(async (endpoint: string, payload: object): Promise<void> => {
    setLoading(true);
    try {
      const response = await fetch(`${API_HOST}/${endpoint}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      if (!response.ok) {
        const errorResponse = await response.text();
        throw new Error(`HTTP error! status: ${response.status}, body: ${errorResponse}`);
      }
      const result = await response.json();
      setData(result);
    } catch (e) {
      handleError(e);
    } finally {
      setLoading(false);
    }
  }, [setLoading, handleError]);

  const deleteData = useCallback(async (endpoint: string): Promise<void> => {
    setLoading(true);
    try {
      const response = await fetch(`${API_HOST}/${endpoint}`, {
        method: "DELETE",
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    } catch (e) {
      handleError(e);
    } finally {
      setLoading(false);
    }
  }, [setLoading, handleError]);

  return { data, fetchData, createData, updateData, deleteData };
};

export default useFetchApi;