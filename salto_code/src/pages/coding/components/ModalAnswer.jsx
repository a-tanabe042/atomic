import React, { useState, useEffect } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPlay } from "@fortawesome/free-solid-svg-icons";
import { useRecoilValue, useRecoilState, useSetRecoilState } from "recoil";
import {
  currentProblemIndexState,
  problemsState,
  answerState,
  howToStepsState,
} from "../../../state";
import Lottie from "lottie-react";
import dragon from "../../../assets/lottie/dragon.json";
import congratulations from "../../../assets/lottie/congratulations.json";

function ModalAnswer() {
  const [currentProblemIndex, setCurrentProblemIndex] = useRecoilState(
    currentProblemIndexState
  );
  const problems = useRecoilValue(problemsState);
  const queryResult = useRecoilValue(answerState);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const howToSteps = useRecoilValue(howToStepsState);
  const setHowToSteps = useSetRecoilState(howToStepsState);

  // オブジェクトが等しいかどうかを判断するヘルパー関数
  const isObjectsEqual = (obj1, obj2) => {
    const keys1 = Object.keys(obj1);
    const keys2 = Object.keys(obj2);

    if (keys1.length !== keys2.length) {
      return false;
    }

    return keys1.every(
      (key) => obj2.hasOwnProperty(key) && obj1[key] === obj2[key]
    );
  };

  const isArrayObjectsEqual = (arr1, arr2) => {
    if (!arr1 || !arr2) {
      return !arr1 && !arr2; // 両方がnullまたはundefinedの場合のみtrue
    }

    if (arr1.length !== arr2.length) {
      return false;
    }

    return arr1.every((obj1) =>
      arr2.some((obj2) => isObjectsEqual(obj1, obj2))
    );
  };

  // 正解判定のロジック
  const correctAnswer = problems[currentProblemIndex]?.attributes?.answer;
  const isCorrectAnswer = isArrayObjectsEqual(queryResult, correctAnswer);

  const showModal = () => {
    // チェックボックス1, 2, 3が全てtrueか確認する
    const allStepsCompleted = [1, 2, 3].every((id) => howToSteps[id]);

    if (allStepsCompleted) {
      setHowToSteps((prevState) => ({ ...prevState, 4: true }));
      setIsModalVisible(true);
    } else {
      // 未完了のステップを特定する
      const incompleteSteps = [1, 2, 3].filter((id) => !howToSteps[id]);
      alert(`How To Use ${incompleteSteps.join(", ")}が実行されていません`);
    }
  };

  const closeModal = () => {
    setIsModalVisible(false);
  };

  const goToNextQuestion = () => {
    const newIndex = currentProblemIndex + 1;
    if (newIndex < problems.length) {
      setCurrentProblemIndex(newIndex);
    } else {
      // Redirect to home or any other route when the last question is completed
      window.location.href = "http://localhost:3000/app/code";
    }
    closeModal();
  };

  useEffect(() => {
    let isMounted = true; // マウント状態を追跡する変数

    // クリーンアップ関数
    return () => {
      isMounted = false; // コンポーネントがアンマウントされたら false に設定
    };
  }, [setCurrentProblemIndex]);

  // ステップを生成する関数
  const renderSteps = () => {
    // 最大表示レベルを設定
    const maxDisplayLevel = 10;

    return (
      <ul className="steps steps-vertical">
        {problems.slice(0, maxDisplayLevel).map((_, index) => (
          <li
            key={index}
            className={`step ${
              index <= currentProblemIndex ? "step-primary" : ""
            }`}
          >
            Level {index + 1}
          </li>
        ))}
      </ul>
    );
  };

  return (
    <div>
      <button
        className="btn bg-gray-800 m-1 text-teal-400 w-32 hover:scale-105"
        onClick={showModal}
      >
        <FontAwesomeIcon icon={faPlay} /> 回答する
      </button>
      {isModalVisible && (
        <dialog id="my_modal_4" className="modal bg-white bg-opacity-20" open>
          <div className="modal-box w-4/5 max-w-5xl shadow-xl rounded-lg bg-white">
            <div className="flex items-center justify-center p-4">
              <div className="flex-none">
                {/* ステップを表示 */}
                {renderSteps()}
              </div>
              <div className="flex-grow flex items-center justify-start ml-4">
                {!isCorrectAnswer ? (
                  <div className="flex-none w-1/2 mr-4 rounded-lg bg-red-500">
                    <Lottie
                      animationData={dragon}
                      style={{ width: 300, height: 300 }}
                    />
                  </div>
                ) : (
                  <div className="flex-none w-1/2 rounded-lg bg-yellow-300">
                    <Lottie
                      animationData={congratulations}
                      style={{ width: 300, height: 300 }}
                    />
                  </div>
                )}
                <div>
                  <p
                    className={`text-xl pl-8 font-bold  ${
                      isCorrectAnswer ? "text-yellow-400" : "text-red-500"
                    }`}
                  >
                    {isCorrectAnswer ? "正解！" : "不正解だよ"}
                  </p>
                </div>
              </div>
            </div>
            <div className="modal-action">
              <button
                className="btn bg-teal-500 text-white"
                onClick={closeModal}
              >
                閉じる
              </button>
              {isCorrectAnswer && (
                <button
                  className="btn bg-purple-500 text-white"
                  onClick={goToNextQuestion}
                >
                  {currentProblemIndex === problems.length - 1
                    ? "ホームへ戻る"
                    : "次の問題へ"}
                </button>
              )}
            </div>
          </div>
        </dialog>
      )}
    </div>
  );
}

export default ModalAnswer;
