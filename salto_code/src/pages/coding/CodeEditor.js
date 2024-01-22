import React, { useState, useEffect, useCallback } from "react";
import { Editor } from "@monaco-editor/react";
import { useRecoilState, useSetRecoilState, useRecoilValue } from "recoil";
import {
  currentSqlQueryState,
  isSqlTableVisibleState,
  displayModeState,
  howToStepsState,
  sqlTabContentState,
  tabsState,
} from "../../state";
import { CodeEditorFooter } from "./components/CodeEditorFooter";
import QueryRunner from "./components/QueryRunner";
import { CodeEditorHeader } from "./components/CodeEditorHeader";
import { mainDisplayAreaState, isConsoleVisibleState } from "../../state";
import { PreviewIframe } from "./components/PreviewIframe";

export const CodeEditor = () => {
  const [tabs, setTabs] = useRecoilState(tabsState);
  const setSqlQuery = useSetRecoilState(currentSqlQueryState);
  const isConsoleVisible = useRecoilValue(isConsoleVisibleState);
  const [isSqlTableVisible, setIsSqlTableVisible] = useRecoilState(
    isSqlTableVisibleState
  );
  const mainDisplayArea = useRecoilValue(mainDisplayAreaState);
  const setDisplayMode = useSetRecoilState(displayModeState);
  const setHowToSteps = useSetRecoilState(howToStepsState);
  // .sql タブのコンテンツを追跡するための useState フック
  const [sqlTabContent, setSqlTabContent] = useRecoilState(sqlTabContentState);

  //QueryRunner.jsx Query Send
  useEffect(() => {
    const sqlTab = tabs.find((tab) => tab.name.endsWith(".sql"));
    if (sqlTab && sqlTab.content !== sqlTabContent) {
      setSqlTabContent(sqlTab.content); // Recoilの状態を更新
      setSqlQuery(sqlTab.content); // SQLクエリの更新
    }
  }, [tabs, setSqlQuery, sqlTabContent, setSqlTabContent]);

  //.sqlファイルを作成したときの処理
  useEffect(() => {
    const hasSqlFile = tabs.some((tab) => tab.name.endsWith(".sql"));
    setIsSqlTableVisible(hasSqlFile);

    if (hasSqlFile) {
      setDisplayMode(5); // .sqlファイルが存在する場合、displayModeを5に設定
    }
  }, [tabs, setIsSqlTableVisible, setDisplayMode]);

  //SQLクエリーを更新したときの処理
  useEffect(() => {
    const sqlTab = tabs.find((tab) => tab.name.endsWith(".sql"));
    if (sqlTab) {
      setSqlQuery(sqlTab.content);
    }
  }, [tabs, setSqlQuery]);

  const updateTabContent = useCallback(
    (tabName, newContent) => {
      setTabs(
        tabs.map((tab) =>
          tab.name === tabName ? { ...tab, content: newContent } : tab
        )
      );
      if (newContent) {
        setHowToSteps((prevState) => ({ ...prevState, 2: true }));
      }
    },
    [tabs, setTabs, setHowToSteps]
  );

  // .sql タブが更新されたときの処理
  useEffect(() => {
    const sqlTab = tabs.find((tab) => tab.name.endsWith(".sql"));
    if (sqlTab && sqlTab.content !== sqlTabContent) {
      setSqlTabContent(sqlTab.content);
      setSqlQuery(sqlTab.content);

      // ここで特定のステップ以降の全てのステップをリセット
      setHowToSteps((prevSteps) => {
        const updatedSteps = { ...prevSteps };
        // ID 1以降の全てのステップをリセット
        Object.keys(updatedSteps).forEach((id) => {
          if (parseInt(id) > 2) {
            updatedSteps[id] = false;
          }
        });
        return updatedSteps;
      });
    }
  }, [tabs, setSqlQuery, sqlTabContent, setHowToSteps]);

  return (
    <div className="flex flex-col h-screen py-1 px-2  text-white">
      <div>
        <CodeEditorHeader />
      </div>
      <div className={mainDisplayArea}>
        {/* エディター */}
        <div className="flex flex-1 overflow-auto">
          {tabs
            .filter((tab) => tab.isVisible)
            .map((tab) => (
              <div
                key={tab.name}
                className="flex-1 h-full overflow-hidden rounded-lg mr-1"
              >
                <Editor
                  value={tab.content}
                  onChange={(value) => updateTabContent(tab.name, value)}
                  height="100%"
                  theme="vs-dark"
                  language={tab.language}
                  options={{
                    minimap: { enabled: false },
                    padding: {
                      top: 10,
                      bottom: 10,
                    },
                  }}
                />
              </div>
            ))}
        </div>
        {/* Iframe */}
        <PreviewIframe />
        {/* SQLテーブル */}
        <div
          className={`${
            isSqlTableVisible
              ? " flex-1 mockup-browser "
              : "hidden"
          } h-full p-2 mx-1 `}
        >
          {isSqlTableVisible && <QueryRunner />}
        </div>
      </div>
      {isConsoleVisible && (
        <div className="mt-1">
          <CodeEditorFooter />
        </div>
      )}
    </div>
  );
};
