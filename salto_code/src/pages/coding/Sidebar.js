import React from "react";
import { useRecoilValue } from "recoil";
import { isSidebarVisibleState } from "../../state";
import { SidebarTabContent } from "./components/SidebarTabContent";
import { Breadcrumbs } from "../../components/Breadcrumbs";
import { SidebarFooter } from "./components/SidebarFooter";

export const Sidebar = () => {
  const isSidebarVisible = useRecoilValue(isSidebarVisibleState);

  if (!isSidebarVisible) {
    return null;
  }
  return (
    <aside className="h-screen" style={{ width: "300px", flexShrink: 0 }}>
      <nav className="h-full flex flex-col border-r shadow-md relative">
        {/* パンくずリスト */}
        <Breadcrumbs />
        <div className="h-full overflow-auto">
          <SidebarTabContent />
        </div>
        <SidebarFooter />
      </nav>
    </aside>
  );
};

