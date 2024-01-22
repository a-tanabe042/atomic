import React, { useEffect, useRef } from "react";
import * as monaco from "monaco-editor";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCode } from "@fortawesome/free-solid-svg-icons";
import { useRecoilValue } from "recoil";
import {
  currentSqlQueryState,
  currentProblemIndexState,
  problemsState,
} from "../../../state";

function ModalTips() {
  const diffEditorRef = useRef(null);
  const userQuery = useRecoilValue(currentSqlQueryState);
  const currentProblemIndex = useRecoilValue(currentProblemIndexState);
  const problems = useRecoilValue(problemsState);

  const initializeMonaco = () => {
    if (diffEditorRef.current !== null) {
      return;
    }

    const editorContainer = document.getElementById("editor-container");
    const currentProblem = problems[currentProblemIndex];
    const originalModel = monaco.editor.createModel(
      currentProblem?.attributes?.problem || "",
      "sql"
    );
    const modifiedModel = monaco.editor.createModel(userQuery || "", "sql");

    monaco.editor.setTheme("vs-dark");
    diffEditorRef.current = monaco.editor.createDiffEditor(editorContainer, {
      readOnly: true,
    });
    diffEditorRef.current.setModel({
      original: originalModel,
      modified: modifiedModel,
    });
  };

  useEffect(() => {
    return () => {
      if (diffEditorRef.current) {
        diffEditorRef.current.dispose();
        diffEditorRef.current = null;
      }
    };
  }, []);

  const closeModal = () => {
    document.getElementById("modal").close();
    if (diffEditorRef.current) {
      diffEditorRef.current.dispose();
      diffEditorRef.current = null;
    }
  };

  const showModal = () => {
    document.getElementById("modal").showModal();
    initializeMonaco();

    // Add labels above the diff editor
    const editorContainer = document.getElementById("editor-container");
    const answerLabel = document.createElement("div");
    editorContainer.appendChild(answerLabel);

    const userResponseLabel = document.createElement("div");
    editorContainer.appendChild(userResponseLabel);
  };

  return (
    <>
      <button
        className="btn bg-gray-800 m-1 text-yellow-400 w-32 hover:scale-105"
        onClick={showModal}
      >
        <FontAwesomeIcon icon={faCode} /> 答えを見る
      </button>
      <dialog className="modal p-8" id="modal">
        <div className="modal-box w-full max-w-6xl">
          <div
            id="editor-container"
            style={{
              width: "100%",
              height: 600,
              padding: "30px",
              borderRadius: "30",
            }}
          ></div>
          <div className="modal-action">
            <button className="btn" onClick={closeModal}>
              閉じる
            </button>
          </div>
        </div>
      </dialog>
    </>
  );
}

export default ModalTips;
