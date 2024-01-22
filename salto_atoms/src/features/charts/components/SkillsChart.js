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


function SkillsChart() {
  const { data: membersData, loading: membersLoading } = useStrapi("user-saltos", {});
  const [chartData, setChartData] = useState();

  useEffect(() => {
    if (membersLoading || !membersData || !membersData.data) return;

    let skillMap = {};
    membersData.data.forEach(user => {
      if (user && user.attributes && user.attributes.skills) {
        user.attributes.skills.forEach(skill => {
          if (skill) {
            skillMap[skill] = (skillMap[skill] || 0) + 1;
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
    let singleCountskills = [];
    let otherskillsCount = 0;
    for (const [skill, count] of Object.entries(skillMap)) {
      if (count === 0) {
        singleCountskills.push(skill);
        otherskillsCount += 1;
      }
    }

    // 数が1の項目を除外
    singleCountskills.forEach(skill => {
      delete skillMap[skill];
    });

    // ソートと色の設定
    const sortedskills = Object.entries(skillMap).sort((a, b) => b[1] - a[1]);
    const skillLabels = sortedskills.map(item => item[0]);
    const skillValues = sortedskills.map(item => item[1]);

    // その他の項目を追加
    if (otherskillsCount > 0) {
      skillLabels.push("Others");
      skillValues.push(otherskillsCount);
    }

    const backgroundColors = skillLabels.map((label, index) => 
      index < 5 ? fixedColors[index % fixedColors.length] : generateRandomColor()
    );

    setChartData({
      labels: skillLabels,
      datasets: [
        {
          label: '# of skills',
          data: skillValues,
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
    <TitleCard title={"Skill Sets by Category"}>
      {chartData && <Doughnut options={options} data={chartData} />}
    </TitleCard>
  );
}

export default SkillsChart;
