import DashboardStats from "./components/DashboardStats";
import AmountStats from "./components/AmountStats";
import PageStats from "./components/PageStats";

import UserGroupIcon from "@heroicons/react/24/outline/UserGroupIcon";
import UsersIcon from "@heroicons/react/24/outline/UsersIcon";
import CircleStackIcon from "@heroicons/react/24/outline/CircleStackIcon";
import CreditCardIcon from "@heroicons/react/24/outline/CreditCardIcon";
import UserChannels from "./components/UserChannels";
import LineChart from "./components/LineChart";
import BarChart from "./components/BarChart";
import DashboardTopBar from "./components/DashboardTopBar";
import { useDispatch } from "react-redux";
import { showNotification } from "../common/headerSlice";
import DoughnutChart from "./components/DoughnutChart";
import Projects from "../../features/projects";
import Problems from "../../features/code/components/Problems";

const statsData = [
  {
    title: "My Project",
    value: "2",
    icon: <UserGroupIcon className="w-8 h-8" />,
    description: "↗︎ 2",
  },
  {
    title: "Participating Project",
    value: "4",
    icon: <CreditCardIcon className="w-8 h-8" />,
    description: "↗︎ 4",
  },
  {
    title: "Total Task",
    value: "1008",
    icon: <CircleStackIcon className="w-8 h-8" />,
    description: "↗︎ 1008",
  },
  {
    title: "Digestion Task",
    value: "1000",
    icon: <UsersIcon className="w-8 h-8" />,
    description: "↗︎ 1000",
  },
];

const statsCodeData = [
  {
    title: "Course Completed",
    value: "20",
    icon: <UserGroupIcon className="w-8 h-8" />,
    description: "↗︎ 2",
  },
  {
    title: "Create Course",
    value: "4",
    icon: <CreditCardIcon className="w-8 h-8" />,
    description: "↗︎ 4",
  },
  {
    title: "Total good",
    value: "100",
    icon: <CircleStackIcon className="w-8 h-8" />,
    description: "↗︎ 100",
  },
  {
    title: "Total comment",
    value: "20",
    icon: <UsersIcon className="w-8 h-8" />,
    description: "↗︎ 20",
  },
];

function Dashboard() {
  const dispatch = useDispatch();

  const updateDashboardPeriod = (newRange) => {
    // Dashboard range changed, write code to refresh your values
    dispatch(
      showNotification({
        message: `Period updated to ${newRange.startDate} to ${newRange.endDate}`,
        status: 1,
      })
    );
  };

  return (
    <>
      {/** ---------------------- Select Period Content ------------------------- */}
      <DashboardTopBar updateDashboardPeriod={updateDashboardPeriod} />

      {/** ---------------------- Different charts ------------------------- */}
      <div className="grid lg:grid-cols-2  grid-cols-1 gap-6">
        <LineChart />
        <BarChart />
      </div>

      {/* <div className="grid lg:grid-cols-2 mt-10 grid-cols-1 gap-6">
                <AmountStats />
                <PageStats />
            </div> */}

      {/* <div className="grid lg:grid-cols-2 mt-4 grid-cols-1 gap-6">
                <UserChannels />
                <DoughnutChart />
            </div> */}

      {/** ---------------------- Different stats content 1 ------------------------- */}
      <p className="text-2xl font-bold text-yellow-400 my-4">Project Stats(立ち上げプロジェクトと参画プロジェクトの集計と詳細)</p>
      <div className="grid lg:grid-cols-4 my-4 md:grid-cols-2 grid-cols-1 gap-6">
        {statsData.map((d, k) => {
          return <DashboardStats key={k} {...d} colorIndex={k} />;
        })}
      </div>
      <Projects />
      <p className="text-2xl font-bold text-yellow-400 my-4">
        Salto Code Stats(受講中と受講済みのコースの集計と表示)
      </p>
      <div className="grid lg:grid-cols-4 my-4 md:grid-cols-2 grid-cols-1 gap-6">
        {statsCodeData.map((d, k) => {
          return <DashboardStats key={k} {...d} colorIndex={k} />;
        })}
      </div>
      <Problems />
    </>
  );
}

export default Dashboard;
