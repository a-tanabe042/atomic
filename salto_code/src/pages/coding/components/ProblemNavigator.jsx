import React from "react";
import { ProblemNavigatorHeader } from "./ProblemNavigatorHeader";
import { ProblemNavigatorContent } from "./ProblemNavigatorContent";
import { ProblemNavigatorFooter } from "./ProblemNavigatorFooter";
export const ProblemNavigator = () => {
  return (
    <div className="flex flex-col justify-center items-center h-full">
      <div className="flex justify-center">
        <ProblemNavigatorHeader />
      </div>
      <div className="flex  mt-4">
        <ProblemNavigatorContent />
      </div>
      <div className="join flex justify-center mt-4">
        <ProblemNavigatorFooter />
      </div>
    </div>
  );
};
