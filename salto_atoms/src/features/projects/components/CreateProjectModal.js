import React, { useState } from "react";
import { PlusCircleIcon, XCircleIcon } from "@heroicons/react/24/outline";

const CreateProjectModal = ({ isOpen, onClose }) => {
  const [projectName, setProjectName] = useState("");
  const [badge, setBadge] = useState("");
  const [description, setDescription] = useState("");
  const [files, setFiles] = useState([]);
  const [linkUrl, setLinkUrl] = useState("");
  const [githubUrl, setGithubUrl] = useState("");

  const handleSubmit = (e) => {
    e.preventDefault();
    // データベースに保存するロジックを実装
    console.log({
      projectName,
      badge,
      description,
      files,
      linkUrl,
      githubUrl,
    });
    onClose(); // フォーム送信後にモーダルを閉じる
  };

  // ファイル追加処理
  const handleAddFile = () => {
    if (files.length < 3) {
      setFiles([...files, ""]); // 新しいアップロードボタンを追加
    }
  };

  // ファイル更新処理
  const updateFile = (index, value) => {
    let newFiles = [...files];
    newFiles[index] = value;
    setFiles(newFiles);
  };

  if (!isOpen) return null; // モーダルが開かれていない場合は何も表示しない

  return (
    <div className="modal modal-open">
      <div className="modal-box">
        <XCircleIcon
          className="h-6 w-6 absolute right-2 top-2 cursor-pointer"
          onClick={onClose}
        />
        <form onSubmit={handleSubmit}>
          <div className="form-control">
            <label className="label">
              <span className="label-text font-bold text-lg text-gray-700">
                プロジェクト名
              </span>
            </label>
            <input
              type="text"
              placeholder="プロジェクト名を入力"
              className="input input-bordered"
              value={projectName}
              onChange={(e) => setProjectName(e.target.value)}
            />
          </div>
          <div className="form-control">
            <label className="label">
              <span className="label-text font-bold text-lg text-gray-700">
                カテゴリー
              </span>
            </label>
            <select
              className="select select-bordered"
              value={badge}
              onChange={(e) => setBadge(e.target.value)}
            >
              <option disabled selected>
                選択してください
              </option>
              <option value="個人開発">個人開発</option>
              <option value="社内開発">社内開発</option>
              <option value="社内研修">社内研修</option>
            </select>
          </div>
          <div className="form-control">
            <label className="label">
              <span className="label-text font-bold text-lg text-gray-700">
                説明
              </span>
            </label>
            <textarea
              className="textarea textarea-bordered h-32"
              placeholder="プロジェクトの説明"
              value={description}
              onChange={(e) => setDescription(e.target.value)}
            ></textarea>
          </div>
          <div className="form-control">
            <label className="label">
              <span className="label-text font-bold text-lg text-gray-700">
                証跡
              </span>
              <badge className="badge badge-outline ml-2">任意</badge>

            </label>
            <p className="text-xs text-gray-500 ml-1">
              要件定義書.pdf,画面定義書.pdf,テーブル定義書.xlsxなど
            </p>

            {files.map((file, index) => (
              <input
                key={index}
                type="file"
                className="input "
                onChange={(e) => updateFile(index, e.target.files[0])}
              />
            ))}
            {files.length < 3 && (
              <div className="mt-2">
                <PlusCircleIcon
                  className="h-6 w-6 text-primary cursor-pointer"
                  onClick={handleAddFile}
                />
              </div>
            )}
          </div>

          <div className="form-control mt-4">
            <label className="label">
              <span className="label-text font-bold text-lg text-gray-700">
                URL
              </span>
              <badge className="badge badge-outline ml-2">任意</badge>
            </label>
            <input
              type="text"
              placeholder="Link URL"
              className="input input-bordered"
              value={linkUrl}
              onChange={(e) => setLinkUrl(e.target.value)}
            />
          </div>

          <div className="form-control">
            <label className="label">
              <span className="label-text font-bold text-lg text-gray-700">
                GitHub
              </span>
              <badge className="badge badge-outline ml-2">任意</badge>

            </label>
            <input
              type="text"
              placeholder="GitHub URL"
              className="input input-bordered"
              value={githubUrl}
              onChange={(e) => setGithubUrl(e.target.value)}
            />
          </div>

          <div className="modal-action">
            <button type="submit" className="btn btn-primary">
              保存
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default CreateProjectModal;
