import React from "react";
import { useRecoilState, useSetRecoilState } from "recoil";
import { displayModeState, showModalState } from "../../../state";
import html0 from "../../../assets/img/html0.jpg";
import html1 from "../../../assets/img/html1.jpg";
import html2 from "../../../assets/img/html2.jpg";
import html3 from "../../../assets/img/html3.jpg";
import html4 from "../../../assets/img/html4.jpg";
import Lottie from "lottie-react";
import lottieFile from "../../../assets/lottie/iframe.json";

export const IsModalIframe = () => {
  const setDisplayMode = useSetRecoilState(displayModeState);
  const [showModal, setShowModal] = useRecoilState(showModalState);

  const handleLayoutClick = (mode) => {
    setDisplayMode(mode);
    setShowModal(false);
  };

  const resetDisplayMode = () => {
    setDisplayMode(5); // リセットするdisplayModeの値
    setShowModal(false); // モーダルを閉じる
  };
  return (
    <>
      {showModal && (
        <div className="modal modal-open">
          <div className="modal-box w-11/12 max-w-5xl">
            <div className="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4">
              {layouts.map((layout) =>
                layout.id !== 6 ? (
                  <img
                    key={layout.id}
                    src={layout.src}
                    alt={`Display Mode ${layout.mode}`}
                    onClick={() => handleLayoutClick(layout.mode)}
                    className="w-full h-auto cursor-pointer rounded-lg object-cover" // object-cover を追加
                  />
                ) : (
                  <div
                    key={layout.id}
                    onClick={() => handleLayoutClick(layout.mode)}
                    className="w-full h-auto cursor-pointer rounded-lg flex justify-center items-center" // Lottieを中央に配置
                  >
                    <Lottie
                      animationData={lottieFile}
                      style={{ width: "100%", height: "auto" }} // Lottieのスタイル調整
                    />
                  </div>
                )
              )}
            </div>
            <div className="modal-action">
              <button
                onClick={() => setShowModal(false)}
                className="btn btn-primary"
              >
                Close
              </button>
              <button onClick={resetDisplayMode} className="btn btn-secondary">
                Reset
              </button>
            </div>
          </div>
        </div>
      )}
    </>
  );
};

const layouts = [
  { id: 1, src: html0, mode: 0 },
  { id: 2, src: html1, mode: 1 },
  { id: 3, src: html2, mode: 2 },
  { id: 4, src: html3, mode: 3 },
  { id: 5, src: html4, mode: 4 },
  { id: 6, mode: 5 }, // Lottie ファイルのための新しい要素
];