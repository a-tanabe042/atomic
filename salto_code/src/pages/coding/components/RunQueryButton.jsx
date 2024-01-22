import React from 'react';
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faDatabase } from "@fortawesome/free-solid-svg-icons";

function RunQueryButton({ onSubmit }) {
  return (
    <button onClick={onSubmit} className="btn bg-gray-950 bg-opacity-80 text-yellow-400">
      <FontAwesomeIcon icon={faDatabase} /> Run Query
    </button>
  );
}

export default RunQueryButton;
