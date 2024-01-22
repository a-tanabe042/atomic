import {  useEffect } from "react";
import { useSetRecoilState, useRecoilValue } from "recoil";
import {
  displayModeState,
  isSqlTableVisibleState,
  mainDisplayAreaState,
  isSidebarVisibleState,
  isConsoleVisibleState,
} from "../../../state";


export const useDisplayControl = () => {
  const displayMode = useRecoilValue(displayModeState);
  const isSqlTableVisible = useRecoilValue(isSqlTableVisibleState);
  const setIsSidebarVisible = useSetRecoilState(isSidebarVisibleState);
  const setIsConsoleVisible = useSetRecoilState(isConsoleVisibleState);
  const setMainDisplayArea = useSetRecoilState(mainDisplayAreaState);

  //Sidebar,Console表示制御
  useEffect(() => {
    switch (displayMode) {
      case 0:
        setIsSidebarVisible(false);
        setIsConsoleVisible(false);
        break;
      case 1:
        setIsSidebarVisible(false);
        setIsConsoleVisible(false);
        break;
      case 2:
        setIsSidebarVisible(false);
        setIsConsoleVisible(false);
        break;
      case 3:
        setIsSidebarVisible(false);
        setIsConsoleVisible(false);
        break;
      case 4:
        setIsSidebarVisible(false);
        setIsConsoleVisible(false);
        break;
      case 5:
        setIsSidebarVisible(true);
        setIsConsoleVisible(true);
        break;
      default:
        setIsSidebarVisible(false);
        setIsConsoleVisible(false);
        break;
    }
    //親階層
    let newMainDisplayArea = "";
    switch (displayMode) {
      case 0:
        newMainDisplayArea = isSqlTableVisible
          ? "flex flex-1 flex-row-reverse overflow-auto"
          : "flex flex-1 overflow-auto";
        break;
      case 1:
        newMainDisplayArea = isSqlTableVisible
          ? "flex flex-1 flex-row-reverse overflow-auto"
          : "flex flex-1 overflow-auto";
        break;
      case 2:
        newMainDisplayArea = isSqlTableVisible
          ? "flex flex-1 flex-row-reverse overflow-auto"
          : "flex flex-1 flex-col-reverse overflow-auto";
        break;
      case 3:
        newMainDisplayArea = isSqlTableVisible
          ? "flex flex-1 flex-row-reverse overflow-auto"
          : "flex flex-1 flex-col-reverse overflow-auto";
        break;
      case 4:
        newMainDisplayArea = isSqlTableVisible
          ? "flex flex-1 flex-row-reverse overflow-auto"
          : "flex flex-1 overflow-auto";
        break;
      case 5:
        newMainDisplayArea = isSqlTableVisible
          ? "flex flex-1 flex-row-reverse overflow-auto"
          : "flex flex-1 overflow-auto";
        break;
      default:
        newMainDisplayArea = isSqlTableVisible
          ? "flex flex-1 flex-row-reverse overflow-auto"
          : "flex flex-1 overflow-auto";
        break;
    }
    setMainDisplayArea(newMainDisplayArea);
  }, [
    displayMode,
    isSqlTableVisible,
    setIsSidebarVisible,
    setIsConsoleVisible,
    setMainDisplayArea,
  ]);
};
//子階層
export const subDisplayArea = (displayMode) => {
  switch (displayMode) {
    case 0:
      return "flex flex-col";
    case 1:
      return "flex";
    case 2:
      return "flex flex-1";
    case 3:
      return "flex h-screen";
    case 4:
      return "hidden";
    case 5:
      return "hidden";
    default:
      return "flex h-full";
  }
};
//孫階層
export const detailDisplayItem = (displayMode) => {
  switch (displayMode) {
    case 0:
      return "h-full overflow-auto mockup-browser border bg-base-300 m-1";
    case 1:
      return "overflow-auto mockup-browser border bg-base-300 m-1";
    case 2:
      return "w-full overflow-auto mockup-browser border bg-base-300 m-1";
    case 3:
      return "w-full overflow-auto  mockup-browser border bg-base-300 m-1";
    case 4:
      return "overflow-auto mockup-browser border bg-base-300 m-1";
    case 5:
      return "overflow-auto mockup-browser border bg-base-300 m-1";
    default:
      return "overflow-auto mockup-browser border bg-base-300 m-1";
  }
};
