import React from "react";
import { IsIframeButton } from "./IsIframeButton";
import { IsSidebarButton } from "./IsSideBarButton";
import { IsConsoleButton } from "./IsConsoleButton";

export const TabButton = () => {
  return (
    <div className="flex">
      <div className="hover:tooltip hover:tooltip-open hover:tooltip-primary hover:tooltip-bottom" data-tip="Iframe">
      <IsIframeButton />
      </div>
      <div className="hover:tooltip hover:tooltip-open hover:tooltip-primary hover:tooltip-bottom" data-tip="Sidebar">
        <IsSidebarButton />
      </div>
      <div className="hover:tooltip hover:tooltip-open hover:tooltip-primary hover:tooltip-bottom" data-tip="Console">
      <IsConsoleButton />
      </div>
    </div>
  );
};

