import React from "react";
import { Console } from "./Console";
import { ProblemNavigator } from "./ProblemNavigator";

export const CodeEditorFooter = () => {
  return (
    <div className="flex flex-col lg:flex-row h-full">
      <div className="flex-grow overflow-hidden">
        <Console />
      </div>
      <div className="w-76 m-1 mt-6 bg-slate-300 bg-opacity-10 rounded-lg">
        <ProblemNavigator />
      </div>
    </div>
  );
};

