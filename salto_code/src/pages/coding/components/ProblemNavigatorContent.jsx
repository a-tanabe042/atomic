import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faThumbsUp, faComments } from "@fortawesome/free-solid-svg-icons";

export const ProblemNavigatorContent = () => {
    return(
        <div className="flex flex-row">
         <div className="indicator mr-1">
          <span className="indicator-item badge badge-secondary ">230</span>
          <button className="btn hover:scale-105">
            <FontAwesomeIcon icon={faThumbsUp} /> いいね
          </button>
        </div>
        <div className="indicator ml-1">
          <span className="indicator-item badge badge-secondary">999</span>
          <button className="btn hover:scale-105">
            <FontAwesomeIcon icon={faComments} /> コメント
          </button>
        </div>
        </div>
    );
};