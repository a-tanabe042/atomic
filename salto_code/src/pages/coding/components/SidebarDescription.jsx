import React, { useEffect } from "react";
import { useRecoilValue } from "recoil";
import { currentProblemIndexState, problemsState } from "../../../state";
import { StepCheckbox } from "../../../components/StepCheckbox";

import Lottie from "lottie-react";
import catAnimation from "../../../assets/lottie/cat.json";
import dogAnimation from "../../../assets/lottie/dog.json";

import how_to_add_button from "../../../assets/img/how_to_add_button.jpg";
import how_to_query_button from "../../../assets/img/how_to_query_button.jpg";
import how_to_answer_button from "../../../assets/img/how_to_answer_button.jpg";
import how_to_level_button from "../../../assets/img/how_to_level_button.jpg";

export const SidebarDescription = () => {
  const currentProblemIndex = useRecoilValue(currentProblemIndexState);
  const problems = useRecoilValue(problemsState);
  const currentProblem = problems[currentProblemIndex];

  useEffect(() => {
    // Your logic here to handle the index update
    console.log("Index updated:", currentProblemIndex);
  }, [currentProblemIndex]);

  // Define steps for the sidebar
  const howToSteps = [
    { id: 1, src: how_to_add_button, text: "でファイルを作成" },
    { id: 2, src: null, text: "CodeEditorに回答を入力" },
    { id: 3, src: how_to_query_button, text: "を押す" },
    { id: 4, src: how_to_answer_button, text: "を押す" },
  ];

  // Determine which animation to display
  const isDog = currentProblemIndex % 2 === 0;
  const animationData = isDog ? dogAnimation : catAnimation;
  const animationClass = isDog
    ? "absolute right-0 bottom-1 w-32 h-32"
    : "absolute right-0 w-32 h-32";

  return (
    <div>
      <h2 className="text-2xl font-bold text-yellow-400 ">
        Level {currentProblemIndex + 1}
      </h2>
      {currentProblem && (
        <div className="relative mb-2 px-2 py-6 pb-24 text-base text-white bg-white bg-opacity-20 rounded-lg">
          {currentProblem.attributes.text}
          <div className={animationClass}>
            <Lottie animationData={animationData} loop={true} />
          </div>
        </div>
      )}
      <h2 className="text-2xl font-bold text-blue-400">How To Use</h2>
      <div className="relative mb-2 rounded-lg bg-slate-50 bg-opacity-20">
        {howToSteps.map((step) => (
          <div key={step.id} className="form-control p-1 rounded-lg">
            <label className="label">
              <span className="flex label-text text-white items-center">
                <p className="text-lg font-bold mr-2">{step.id}.</p>
                {step.src && (
                  <img
                    key={step.id}
                    src={step.src}
                    alt={step.id}
                    className="w-auto h-8 rounded-lg mr-1"
                  />
                )}
                {step.text}
              </span>
              <StepCheckbox stepId={step.id} />
            </label>
          </div>
        ))}
      </div>
      <div className="relative mb-2 p-2 font-bold text-base text-white bg-white bg-opacity-20 rounded-lg">
        <span>別の問題へ移動</span>
        <br />
        <img
          key="how_to_level_button"
          src={how_to_level_button}
          alt="how_to_level_button"
          className="w-auto h-8 rounded-lg mr-1 mt-2 "
        />
      </div>
    </div>
  );
};

export default SidebarDescription;
