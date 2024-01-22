import React, { useState } from "react";
import { useRecoilState, useSetRecoilState } from "recoil";
import { tabsState, howToStepsState } from "../../../state";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPlus, faCircleXmark } from "@fortawesome/free-solid-svg-icons";
import { languagesData } from "../../../api/languagesData"; // 必要なデータのインポート

const fileTemplates = [
  { name: "index.html", extension: "html", groupId: 1 },
  { name: "style.css", extension: "css", groupId: 1 },
  { name: "App.js", extension: "js", groupId: 1 },
  { name: "query.sql", extension: "sql", groupId: 2 },
];

export const TabContent = () => {
  const [tabs, setTabs] = useRecoilState(tabsState);
  const setHowToSteps = useSetRecoilState(howToStepsState);
  const [showModal, setShowModal] = useState(false);

  const toggleModal = () => {
    setShowModal(!showModal);
  };

  const addNewTab = (fileName, extension, groupId) => {
    // Check if a file with the same name already exists
    const isFileExist = tabs.some(tab => tab.name === fileName);
    if (isFileExist) {
      alert(`${fileName} は既に存在します。`);
      return;
    }
  
    const existingGroupId = tabs.reduce((acc, tab) => {
      const foundTemplate = fileTemplates.find(template => template.name === tab.name);
      return foundTemplate ? foundTemplate.groupId : acc;
    }, null);
  
    // 異なるグループのファイルが既に存在する場合、エラーを表示
    if (existingGroupId && existingGroupId !== groupId) {
      alert("HTML/CSS/JavaScript と SQL ファイルは同時に作成できません。");
      return;
    }
  
    // 言語データを取得し、タブを追加
    const languageData = languagesData.find((lang) => lang.extension === extension);
    if (!languageData) {
      alert("対応していない拡張子です。");
      return;
    }
  
    setTabs([
      ...tabs,
      {
        name: fileName,
        content: languageData.initialCode.trim(),
        isVisible: true,
        icon: languageData.icon,
        language: languageData.language,
      },
    ]);
  
    setHowToSteps((prevSteps) => {
      const updatedSteps = { ...prevSteps, 1: true };
      Object.keys(updatedSteps).forEach((id) => {
        if (parseInt(id) > 1) {
          updatedSteps[id] = false;
        }
      });
      return updatedSteps;
    });
  };
  const handleTabAction = (action, tabName) => {
    switch (action) {
      case "toggleVisibility":
        setTabs(
          tabs.map((tab) =>
            tab.name === tabName ? { ...tab, isVisible: !tab.isVisible } : tab
          )
        );
        break;

      case "close":
        if (
          window.confirm(`${tabName}を削除しますか？データの復元はできません。`)
        ) {
          setTabs(tabs.filter((tab) => tab.name !== tabName));
          // タブが閉じられた場合、全てのCheckboxをリセットする
          setHowToSteps((prevSteps) => {
            const updatedSteps = { ...prevSteps };
            Object.keys(updatedSteps).forEach((id) => {
              if (parseInt(id) >= 1) {
                updatedSteps[id] = false;
              }
            });
            return updatedSteps;
          });
        }
        break;

      default:
        break;
    }
  };

  return (
    <div className="flex items-center space-x-2 overflow-auto ">
      {tabs.map((tab) => (
        <div
          key={tab.name}
          style={{ fontSize: "0.875rem" }}
          className={`flex items-center rounded-lg px-1 py-1 transition-all duration-300 ease-in-out transform ${
            tab.isVisible
              ? "bg-gray-800 text-white shadow-lg scale-95 hover:scale-100"
              : "bg-base-300 text-base-content opacity-70 scale-90 hover:scale-95"
          }`}
          onClick={() => handleTabAction("toggleVisibility", tab.name)}
        >
          <FontAwesomeIcon
            icon={tab.icon}
            className="h-4 w-4 text-yellow-300 mr-1"
          />
          <span className="mx-1 text-sm">{tab.name}</span>
          <button
            onClick={(e) => {
              e.stopPropagation();
              handleTabAction("close", tab.name);
            }}
            className="ml-auto text-sm p-1 hover:bg-opacity-25"
          >
            <FontAwesomeIcon icon={faCircleXmark} />
          </button>
        </div>
      ))}
      <button onClick={toggleModal} className="btn btn-primary">
        <FontAwesomeIcon icon={faPlus} />
      </button>

      {/* モーダル */}
      {showModal && (
        <div className="modal modal-open">
          <div className="modal-box">
            <h3 className="font-bold text-lg">ファイルを追加</h3>
            <p className="text-xs">HTML/CSS/JavaScript と SQL ファイルは同時に作成できません。</p>
            <div className="py-4">
              {fileTemplates.map((template) => (
                <button
                  key={template.name}
                  className="btn btn-outline btn-primary m-2"
                  onClick={() => {
                    addNewTab(
                      template.name,
                      template.extension,
                      template.groupId
                    );
                    toggleModal();
                  }}
                >
                  {template.name}
                </button>
              ))}
            </div>
            <div className="modal-action">
              <button onClick={toggleModal} className="btn btn-error">
                閉じる
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};
