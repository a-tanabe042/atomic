import React, { useEffect } from "react";
import { useRecoilState, useRecoilValue } from "recoil";
import {
  tabsState,
  displayModeState,
  isSqlTableVisibleState,
  iframeContentState,
} from "../../../state";
import {
  useDisplayControl,
  subDisplayArea,
  detailDisplayItem,
} from "./useDisplayControl";
import { AnswerDataHTML } from "../../../api/AnswerDataHTML";

export const PreviewIframe = () => {
  const [iframeContent, setIframeContent] = useRecoilState(iframeContentState);
  const displayMode = useRecoilValue(displayModeState);
  const tabs = useRecoilValue(tabsState);
  const isSqlTableVisible = useRecoilValue(isSqlTableVisibleState);

  useDisplayControl(displayMode, isSqlTableVisible);

  useEffect(() => {
    // 以前と同じロジックで iframe の内容を更新
    const htmlContent =
      tabs.find((tab) => tab.language === "html")?.content || "";
    const cssContent =
      tabs.find((tab) => tab.language === "css")?.content || "";
    const jsContent =
      tabs.find((tab) => tab.language === "javascript")?.content || "";

    const combinedContent = `
      <html>
        <head>
          <style>${cssContent}</style>
        </head>
        <body>
          ${htmlContent}
          <script type="text/javascript">${jsContent}</script>
        </body>
      </html>
    `;
    setIframeContent(combinedContent);
  }, [tabs, setIframeContent]);

  return (
    <>
      <div className={subDisplayArea(displayMode)}>
        <div className={detailDisplayItem(displayMode)}>
          <div className="mockup-browser-toolbar">
            <div className="input">https://answer.com</div>
          </div>
          <div className="h-full rounded-lg">
            <iframe
              id="answer"
              title="Answer Preview"
              srcDoc={AnswerDataHTML}
              className=" h-full w-full overflow-auto"
            ></iframe>
          </div>
        </div>

        <div className={detailDisplayItem(displayMode)}>
          <div className="mockup-browser-toolbar">
            <div className="input">https://preview.com</div>
          </div>
          <div className="h-full rounded-lg">
            <iframe
              id="preview"
              title="Code Preview"
              srcDoc={iframeContent}
              className=" h-full w-full"
            ></iframe>
          </div>
        </div>
      </div>
    </>
  );
};
