import React from "react";
import { useRecoilState, useRecoilValue } from "recoil";
import { isSidebarVisibleState,displayModeState} from "../../../state";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {faBarsStaggered} from "@fortawesome/free-solid-svg-icons";

export const IsSidebarButton = () => {
  const [isSidebarVisible,setIsSidebarVisible] = useRecoilState(isSidebarVisibleState);
  const displayMode = useRecoilValue(displayModeState);
  return (
    <>
      <button
        onClick={() => setIsSidebarVisible(!isSidebarVisible)}
        className={`btn ${
          isSidebarVisible
            ? "bg-gray-800 text-white shadow-lg scale-95 hover:scale-100"
            : "bg-base-300 text-base-content opacity-70 scale-90 hover:scale-95"
        } text-white m-1`}
        disabled={displayMode === 1}
      >
        <FontAwesomeIcon icon={faBarsStaggered} />
      </button>
    </>
  );
};
