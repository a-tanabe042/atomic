import { useState } from "react";
import TitleCard from "../../../components/Cards/TitleCard";

import IsClickLanguage from "./IsClickLanguage";
import ProblemsData from "../../../utils/problemsData";

function Problems() {
  const apiURL = process.env.REACT_APP_CODE_API_URL;
  const [problems,] = useState(ProblemsData);

  const getPaymentStatus = (
    status,
    isCategory = false,
    isDescription = false,
    isCount = false
  ) => {
    if (isCategory)
      return <div className="badge badge-ghost badge-lg">{status}</div>;
    if (isDescription)
      return (
        <button className="btn btn-success text-lg font-bold  shadow-lg text-white btn-md transition duration-150 ease-in-out transform hover:scale-110 focus:outline-none focus:ring focus:ring-green-300 w-full">
          {status}
        </button>
      );
    if (isCount)
      return (
        <div className="badge badge-ghost badge-lg font-bold text-2xl">
          {status}
        </div>
      );
    if (status === "未受講")
      return <div className="badge badge-ghost badge-lg">{status}</div>;
    if (status === "受講中")
      return (
        <div className="badge badge-secondary badge-lg text-white">
          {status}
        </div>
      );
    if (status === "受講済")
      return (
        <div className="badge badge-primary badge-lg text-white">{status}</div>
      );
    if (status === "新卒研修")
      return <div className="badge badge-ghost badge-lg">{status}</div>;
    else return <div className="badge badge-ghost">{status}</div>;
  };

  return (
    <>
      <TitleCard title="Problems" topMargin="mt-2">
        {/* Invoice list in table format loaded constant */}
        <div className="overflow-x-auto w-full">
          <table className="table w-full">
            <thead>
              <tr className="text-center">
                <th>言語</th>
                <th>カテゴリ</th>
                <th>タイトル</th>
                <th>問題数</th>
                <th>ステータス</th>
                <th>いいね数</th>
                <th>作成者</th>
              </tr>
            </thead>
            <tbody className="text-center">
              {problems.map((problem, p) => (
                <tr key={p}>
                  <td>
                    <IsClickLanguage languages={problem.language} />
                  </td>
                  <td>{getPaymentStatus(problem.category, true)}</td>
                  <td>
                    <a
                      href={`${apiURL}/${problem.parameter}`}
                      className="btn btn-success text-lg font-bold shadow-lg text-white btn-md transition duration-150 ease-in-out transform hover:scale-110 focus:outline-none focus:ring focus:ring-green-300 w-full"
                    >
                      {problem.problem_description}
                    </a>
                  </td>
                  <td className="text-xs">
                    {getPaymentStatus(
                      problem.problem_count,
                      false,
                      false,
                      true
                    )}
                    問
                  </td>
                  <td>{getPaymentStatus(problem.status)}</td>
                  <td className="text-xs">
                    {getPaymentStatus(problem.like_count, false, false, true)}
                    いいね
                  </td>
                  <td>
                    <div className="flex items-center space-x-3">
                      <div className="avatar">
                        <div className="mask mask-circle w-12 h-12">
                          <img src={problem.avatar} alt="Avatar" />
                        </div>
                      </div>
                      <div>
                        <div className="font-bold">{problem.name}</div>
                      </div>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </TitleCard>
    </>
  );
}

export default Problems;
