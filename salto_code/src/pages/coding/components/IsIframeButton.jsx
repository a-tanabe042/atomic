import React from "react";
import { useRecoilValue, useSetRecoilState } from "recoil";
import { isSqlTableVisibleState, showModalState } from "../../../state";
import Lottie from "lottie-react";
import htmlAnimation from "../../../assets/lottie/html.json"; // iframe.json ファイルのパスを指定
import { IsModalIframe } from "./IsModalIframe";

export const IsIframeButton = () => {
  const setShowModal = useSetRecoilState(showModalState);
  const isSqlTableVisible = useRecoilValue(isSqlTableVisibleState);

  return (
    <>
      {!isSqlTableVisible && (
        <button
          onClick={() => setShowModal(true)}
        >
          <Lottie animationData={htmlAnimation} 
          style={{ width: 60, height: 55 }} />
        </button>
      )}
      <IsModalIframe />
    </>
  );
};
