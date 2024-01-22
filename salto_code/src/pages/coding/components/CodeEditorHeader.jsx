import React from "react";
import { TabContent } from "./TabContent";
import { TabButton } from "./TabButton";

export const CodeEditorHeader = () => {
  return (
    <div className="flex justify-between items-center rounded-lg mb-2 bg-gray-950 bg-opacity-80 p-2">
      {/* codeTabとaddNewButton (Left tab) */}
      <TabContent />
      {/* button (Right tab) */}
      <TabButton />
    </div>
  );
};
