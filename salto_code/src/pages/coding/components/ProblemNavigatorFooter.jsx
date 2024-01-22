import React, { useEffect } from "react";
import { useRecoilState, useRecoilValue} from "recoil";
import { problemsState, currentProblemIndexState } from "../../../state";
import { useCookie } from "../../../hooks/useCookie"; // useCookie フックをインポート

export const ProblemNavigatorFooter = () => {
  const [currentProblemIndex, setCurrentProblemIndex] = useCookie("currentProblemIndex", 0);
  const [recoilProblemIndex, setRecoilProblemIndex] = useRecoilState(currentProblemIndexState);
  const problems = useRecoilValue(problemsState);
  const maxProblemIndex = problems.length - 1;

  // クッキーとRecoilの状態を同期します。
  useEffect(() => {
    setRecoilProblemIndex(parseInt(currentProblemIndex, 10));
  }, [currentProblemIndex, setRecoilProblemIndex]);

  const incrementIndex = () => {
    if (recoilProblemIndex < maxProblemIndex) {
      setCurrentProblemIndex(recoilProblemIndex + 1);
    }
  };

  const decrementIndex = () => {
    if (recoilProblemIndex > 0) {
      setCurrentProblemIndex(recoilProblemIndex - 1);
    }
  };

  const handleLevelChange = (e) => {
    const newIndex = parseInt(e.target.value, 10);
    if (newIndex >= 0 && newIndex <= maxProblemIndex) {
      setCurrentProblemIndex(newIndex);
    }
  };

  return (
    <>
      <button className="join-item btn hover:scale-105" onClick={decrementIndex}>«</button>
      <select
        value={recoilProblemIndex}
        onChange={handleLevelChange}
        className="w-28 bg-gray-950 text-white flex items-center justify-center pl-8 hover:scale-105"
      >
        {problems.map((_, index) => (
          <option key={index} value={index}>Level {index + 1}</option>
        ))}
      </select>
      <button className="join-item btn hover:scale-105" onClick={incrementIndex}>»</button>
    </>
  );
};
