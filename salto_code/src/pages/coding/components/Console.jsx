import React, {useState} from "react";
import  UserInfo  from "../../../api/UserInfo";
import  UserBasic  from "../../../api/UserBasic";
import  Department  from "../../../api/Department";
import  Post  from "../../../api/Post";

export const Console = () => {
    const [currentTab, setCurrentTab] = useState("user_info");
    return(
        <div className="flex1 overflow-hidden">
        <div>
          {tabData.map((tab) => (
            <button
              key={tab.id}
              onClick={() => setCurrentTab(tab.id)}
              className={`bg-gray-950 bg-opacity-80 rounded px-2 ${
                currentTab === tab.id
                  ? "text-yellow-400 shadow-lg scale-95 hover:scale-100"
                  : "text-white opacity-70 scale-90 hover:scale-95"
              }`}
            >
              {tab.label}
            </button>
          ))}
        </div>

        <div className="overflow-hidden rounded-lg bg-gray-950 bg-opacity-80 text-white font-mono p-3 h-80">
          {tabData.map(
            (tab) =>
              currentTab === tab.id && (
                <div
                  key={tab.id}
                  className="overflow-auto max-h-[300px] min-h-[300px]"
                >
                  <tab.component />
                </div>
              )
          )}
        </div>
      </div>
    );
};

const tabData = [
    { id: "user_info", label: "user_info", component: UserInfo },
    { id: "user_basic", label: "user_basic", component: UserBasic },
    { id: "department", label: "department", component: Department },
    { id: "post", label: "post", component: Post }
  ];