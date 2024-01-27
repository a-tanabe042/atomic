import { useEffect } from 'react';
import { useRecoilState } from 'recoil';
import { problemsState } from '../state';
import { useParams } from 'react-router-dom';

function EducationalMaterials() {
  const apiHost = process.env.REACT_APP_API_HOST;
  const { parameter } = useParams(); // URLパラメータから 'parameter' を取得
  const [, setProblems] = useRecoilState(problemsState); // Recoilの状態を使用

  useEffect(() => {
    // データを取得する非同期関数
    const fetchData = async () => {
      try {
        // APIから教材データを取得
        const response = await fetch(`${apiHost}/api/educational-materials?parameter=${parameter}`);
        if (!response.ok) {
          // レスポンスが不正の場合、エラーをスロー
          throw new Error('Network response was not ok');
        }
        const json = await response.json();

        // 取得したデータをフィルタリング
        const filteredData = json.data.filter(item => item.attributes.parameter === parameter);

        // Recoilの状態を更新
        setProblems(filteredData);
      } catch (error) {
        // エラーが発生した場合、コンソールにエラーメッセージを表示
        console.error('Fetching data failed:', error);
      }
    };

    fetchData(); // データ取得関数を実行
  }, [parameter, setProblems]); // 依存配列にparameterとsetProblemsを設定

  return null; // このコンポーネントはUIをレンダリングしない
}

export default EducationalMaterials;
