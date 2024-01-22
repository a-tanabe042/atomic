import React from "react";
import { useRecoilValue,useRecoilState} from "recoil";
import { isConsoleVisibleState, isSqlTableVisibleState } from "../../../state";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {faTerminal} from "@fortawesome/free-solid-svg-icons";

export const IsConsoleButton = () => {
    const [isConsoleVisible,setIsConsoleVisible] = useRecoilState(isConsoleVisibleState);
    const isSqlTableVisible = useRecoilValue(isSqlTableVisibleState);
    return(
        <>
        {!isSqlTableVisible && (
        <button
        onClick={() => setIsConsoleVisible(!isConsoleVisible)}
        className={`btn ${
          isConsoleVisible
            ? "bg-gray-800 text-white shadow-lg scale-95 hover:scale-100"
            : "bg-base-300 text-base-content opacity-70 scale-90 hover:scale-95"
        } text-white m-1`}
      >
        <FontAwesomeIcon icon={faTerminal} />
      </button>
      )}
        </>
    )
}