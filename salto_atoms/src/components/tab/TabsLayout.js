// TabsLayout.js
import { useRecoilState } from 'recoil';
import { tabState } from '../../state';

function TabsLayout({ onTabChange, tabs = [] }) { // デフォルト値を設定
  const [activeTab, setActiveTab] = useRecoilState(tabState);

  const handleTabChange = (tabName) => {
    setActiveTab(tabName);
    if (onTabChange) {
      onTabChange(tabName);
    }
  };

  if (!Array.isArray(tabs) || tabs.length === 0) {
    return null; // tabsが空の配列の場合、何も表示しない
  }

  return (
    <div className="tabs tabs-boxed bg-base-100">
      {tabs.map((tabName) => (
        <button
          key={tabName}
          className={`tab tab-lg ${activeTab === tabName ? "btn btn-success text-white" : ""}`}
          onClick={() => handleTabChange(tabName)}
        >
          {tabName}
        </button>
      ))}
    </div>
  );
}

export default TabsLayout;
