import React, { useState, useEffect } from "react";
import { useRecoilValue, useSetRecoilState } from "recoil";
import {
  currentSqlQueryState,
  answerState,
  howToStepsState,
} from "../../../state";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faExclamationTriangle } from "@fortawesome/free-solid-svg-icons";
import RunQueryButton from "./RunQueryButton";
import CopyToClipBoardButton from "../../../components/CopyToClipBoardButton";

const excludedColumns = [
  "id",
  "created_at",
  "created_by_id",
  "updated_by_id",
  "updated_at",
  "published_at",
];

function QueryRunner() {
  const [result, setResult] = useState(null);
  const [error, setError] = useState(null);
  const [showErrorAlert, setShowErrorAlert] = useState(false);
  const [resultFormat, setResultFormat] = useState("table"); // 追加: 結果表示形式
  const query = useRecoilValue(currentSqlQueryState);
  const setAnswerState = useSetRecoilState(answerState);
  const setHowToSteps = useSetRecoilState(howToStepsState);

  useEffect(() => {
    let timer;
    if (showErrorAlert) {
      timer = setTimeout(() => {
        setShowErrorAlert(false);
      }, 1500);
    }
    return () => clearTimeout(timer);
  }, [showErrorAlert]);

  const handleSubmit = async (event) => {
    event.preventDefault();
    setResult(null);
    setError(null);
    setShowErrorAlert(false);

    try {
      let modifiedQuery = query;
      // 特定のテーブル名に 's' を追加
      const tablesToAddS = ["user_info", "user_basic", "department", "post"];
      tablesToAddS.forEach((table) => {
        const regex = new RegExp(`\\b${table}\\b`, "g");
        modifiedQuery = modifiedQuery.replace(regex, `${table}s`);
      });

      const response = await fetch(
        "http://localhost:1337/api/query-runner/run",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ query: modifiedQuery }),
        }
      );

      if (!response.ok) {
        throw new Error(`HTTP Error: ${response.status}`);
      }

      const contentType = response.headers.get("content-type");
      if (contentType && contentType.includes("application/json")) {
        const data = await response.json();
        setAnswerState(data[0]); // Update the Recoil state with the query result
        setResult(data[0]);
        setHowToSteps((prevState) => ({ ...prevState, 3: true }));
      } else {
        throw new Error("Invalid content type");
      }
    } catch (error) {
      setError("クエリの実行中にエラーが発生しました");
      setShowErrorAlert(true);
      setAnswerState(null); // エラー発生時にanswerStateを初期値にリセット
    }
  };

  const columns =
    result && result.length > 0
      ? Object.keys(result[0]).filter(
          (column) => !excludedColumns.includes(column)
        )
      : [];

  const toggleResultFormat = () => {
    setResultFormat(resultFormat === "table" ? "json" : "table");
  };

  return (
    <div className="flex flex-col pr-2">
      <RunQueryButton onSubmit={handleSubmit} />
      {/* Toggle for selecting result format */}
      <div className="flex items-center my-1">
        <input
          type="checkbox"
          className="toggle toggle-sm"
          checked={resultFormat === "json"}
          onChange={toggleResultFormat}
        />
        <span className="ml-2 text-sm">
          {resultFormat === "json" ? "JSON" : "Table"}
        </span>
      </div>

      {/* エラーアラート */}
      {showErrorAlert && (
        <div
          role="alert"
          className="flex w-1/5 text-white text-xs alert alert-error fixed top-0 right-0 mt-4"
        >
          <FontAwesomeIcon icon={faExclamationTriangle} className="mr-2" />
          <span>{error}</span>
        </div>
      )}

      {/* 結果表示 */}
      {result &&
        (resultFormat === "table" ? (
          // テーブル表示のためのdivにmax-heightとoverflow-autoを設定
          <div className="overflow-auto rounded-lg bg-gray-950 bg-opacity-80 text-white font-mono p-3 h-screen max-h-96">
            <table className="table table-xs w-full text-sm text-gray-300">
              <thead>
                <tr>
                  {columns.map((column) => (
                    <th key={column}>{column}</th>
                  ))}
                </tr>
              </thead>
              <tbody>
                {result.map((row, index) => (
                  <tr key={index}>
                    {columns.map((column) => (
                      <td key={`${index}-${column}`} className="px-4 py-2">
                        {row[column]}
                      </td>
                    ))}
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        ) : (
          // JSON表示
          <div className="bg-gray-300 bg-opacity-30 p-3 rounded-lg overflow-auto max-h-[285px] min-h-min">
            <CopyToClipBoardButton data={JSON.stringify(result, null, 2)} />
            <pre className="text-xs text-gray-700">
              {JSON.stringify(result, null, 2)}
            </pre>
          </div>
        ))}
    </div>
  );
}

export default QueryRunner;
