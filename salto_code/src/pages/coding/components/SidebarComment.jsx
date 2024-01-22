import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faThumbsUp } from "@fortawesome/free-solid-svg-icons";

const ChatMessage = ({ comment }) => (
  <div
    className={`chat ${
      comment.type === "instructor" ? "chat-end" : "chat-start"
    }`}
  >
    <div className="chat-image avatar">
      <div className="w-8 rounded-full">
        <img alt="User avatar" src={comment.imageUrl} />
      </div>
    </div>
    <div className="chat-header text-xs">{comment.user}</div>
    <div className="relative text-xs bg-gray-800 py-2 px-4 shadow rounded-xl">
      {comment.message}
      <br />
      {comment.messageUrl && (
        <a
          href={comment.messageUrl}
          target="_blank"
          rel="noopener noreferrer"
          className="text-blue-500 hover:text-blue-700"
        >
          詳細を見る
        </a>
      )}
      <button className="text-gray-500">
      <FontAwesomeIcon icon={faThumbsUp} className="rounded-full" />
      </button>
    </div>
  </div>
);

export const SidebarComment = () => {
  return (
    <div className="h-full overflow-auto text-xs text-white">
      {commentsData.map((comment) => (
        <ChatMessage key={comment.id} comment={comment} />
      ))}
    </div>
  );
};

const commentsData = [
  {
    id: "1", // 一意のID
    user: "質問者A",
    message: "SQLのおすすめの教材を教えて",
    messageUrl: "", // この場合、リンクは表示されません
    imageUrl: "https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg",
    type: "student",
  },
  {
    id: "2", // 一意のID
    user: "回答者A",
    message: "SQL完全攻略虎の巻",
    messageUrl: "https://salto.site",
    imageUrl:
      "https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg",
    type: "instructor",
  },
  {
    id: "3", 
    user: "回答者B",
    message: "実践向けの教材を作成しました",
    messageUrl: "https://salto.site",
    imageUrl:
      "https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg",
    type: "instructor",
  },
  // 他のコメント
];
