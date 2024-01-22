import React, { useState, useEffect } from "react";
import {
  Chart as ChartJS,
  ArcElement,
  Tooltip,
  Legend,
} from 'chart.js';
import { Doughnut } from 'react-chartjs-2';
import TitleCard from '../../../components/Cards/TitleCard';
import useStrapi from "../../../hooks/useStrapi";

ChartJS.register(ArcElement, Tooltip, Legend);

function generateRandomColor() {
  // Set a minimum value for each color component to ensure brightness
  const minVal = 100; // Adjust this value to control the brightness
  const r = Math.floor(Math.random() * (255 - minVal) + minVal);
  const g = Math.floor(Math.random() * (255 - minVal) + minVal);
  const b = Math.floor(Math.random() * (255 - minVal) + minVal);
  return `rgba(${r}, ${g}, ${b}, 0.8)`;
}


function GoalsChart() {
  const { data: membersData, loading: membersLoading } = useStrapi("user-saltos", {});
  const [chartData, setChartData] = useState();

  useEffect(() => {
    if (membersLoading || !membersData || !membersData.data) return;

    let goalMap = {};
    membersData.data.forEach(user => {
      if (user && user.attributes && user.attributes.goals) {
        user.attributes.goals.forEach(goal => {
          if (goal) {
            goalMap[goal] = (goalMap[goal] || 0) + 1;
          }
        });
      }
    });

    // 固定色の配列
    const fixedColors = [
      'rgba(255, 99, 132, 0.8)', // 赤
      'rgba(54, 162, 235, 0.8)', // 青
      'rgba(255, 206, 86, 0.8)', // 黄色
      'rgba(75, 192, 192, 0.8)', // 緑
      'rgba(153, 102, 255, 0.8)'  // 紫
    ];

    // 数が1の項目を別に管理
    let singleCountGoals = [];
    let otherGoalsCount = 0;
    for (const [goal, count] of Object.entries(goalMap)) {
      if (count === 0) {
        singleCountGoals.push(goal);
        otherGoalsCount += 1;
      }
    }

    // 数が1の項目を除外
    singleCountGoals.forEach(goal => {
      delete goalMap[goal];
    });

    // ソートと色の設定
    const sortedGoals = Object.entries(goalMap).sort((a, b) => b[1] - a[1]);
    const goalLabels = sortedGoals.map(item => item[0]);
    const goalValues = sortedGoals.map(item => item[1]);

    // その他の項目を追加
    if (otherGoalsCount > 0) {
      goalLabels.push("Others");
      goalValues.push(otherGoalsCount);
    }

    const backgroundColors = goalLabels.map((label, index) => 
      index < 5 ? fixedColors[index % fixedColors.length] : generateRandomColor()
    );

    setChartData({
      labels: goalLabels,
      datasets: [
        {
          label: '# of Goals',
          data: goalValues,
          backgroundColor: backgroundColors,
          borderColor: backgroundColors.map(color => color.replace('0.8', '1')),
          borderWidth: 1,
        }
      ],
    });
  }, [membersData, membersLoading]);

  const options = {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
    },
  };

  if (membersLoading) {
    return <div>Loading...</div>;
  }

  if (!membersData || !membersData.data) {
    return <div>No data available</div>;
  }

  return (
    <TitleCard title={"Goals by Category"}>
      {chartData && <Doughnut options={options} data={chartData} />}
    </TitleCard>
  );
}

export default GoalsChart;
