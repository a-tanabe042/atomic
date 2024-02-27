import LineChart from "./components/LineChart";
import BarChart from "./components/BarChart";
import GoalsChart from "./components/GoalsChart";
import SkillsChart from "./components/SkillsChart";
import ScatterChart from "./components/ScatterChart";
import StackBarChart from "./components/StackBarChart";
import SkillsChannels from "./components/SkillsChannels";
import GoalsChannels from "./components/GoalsChannels";

import DashboardStats from "./components/DashboardStats";

import UserGroupIcon from "@heroicons/react/24/outline/UserGroupIcon";
import { useState ,useEffect } from "react";
import useStrapi from "../../hooks/useStrapi";

function Charts() {

  const [userCount, setUserCount] = useState(0); // ユーザー数を格納するステート

  // useStrapi フックを使用して user-saltos データを取得
  const { data: membersData, loading: membersLoading } = useStrapi("user-saltos", {});

  useEffect(() => {
    if (membersLoading || !membersData || !membersData.data) return;
    setUserCount(membersData.data.length); // ユーザー数をセット
  }, [membersData, membersLoading]);

  const statsData = [
    {
      title: "Salto Users",
      value: `${userCount}`, // ユーザー数を動的に表示
      icon: <UserGroupIcon className="w-8 h-8" />,
      description: "",
    },
  ];

  

  return (
    <>
      {/** ---------------------- Different charts ------------------------- */}

      <div className="grid lg:grid-cols-4 mt-2 md:grid-cols-2 grid-cols-1 gap-6 ">
        {statsData.map((d, k) => {
          return <DashboardStats key={k} {...d} colorIndex={k} />;
        })}
      </div>

      <div className="grid lg:grid-cols-2 mt-4 grid-cols-1 gap-6">
        <SkillsChart />
        <GoalsChart />
      </div>

      <div className="grid lg:grid-cols-2 mt-4 grid-cols-1 gap-6">
        <SkillsChannels />
        <GoalsChannels />
      </div>      
      <div className="grid lg:grid-cols-2 mt-0 grid-cols-1 gap-6 mt-4">
        <StackBarChart />
        <BarChart />
      </div>

      <div className="grid lg:grid-cols-2 mt-4 grid-cols-1 gap-6">
        <ScatterChart />
        <LineChart />
      </div>
    </>
  );
}

export default Charts;
