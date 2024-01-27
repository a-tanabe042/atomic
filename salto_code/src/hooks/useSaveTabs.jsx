import { useRecoilValue } from 'recoil';
import { tabsState } from '../state';

export const useSaveTabs = () => {
  const apiHost = process.env.REACT_APP_API_HOST;
  const tabs = useRecoilValue(tabsState);

  const saveTabs = async (googleId) => {
    try {
      const response = await fetch(`${apiHost}/api/editor-tabs`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          data: {
            google_id: googleId,
            tabs: tabs
          }
        }),
      });

      if (!response.ok) {
        throw new Error(`Error: ${response.status} ${response.statusText}`);
      }

      // 保存成功時の処理...
    } catch (error) {
      console.error('Error saving tabs:', error);
    }
  };

  return saveTabs;
};
