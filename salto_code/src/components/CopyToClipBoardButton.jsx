import React, { useState } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faClipboard } from '@fortawesome/free-regular-svg-icons';

const CopyToClipBoardButton = ({ data }) => {
  const [isCopied, setIsCopied] = useState(false);

  const handleCopy = async () => {
    try {
      await navigator.clipboard.writeText(data);
      setIsCopied(true);
      setTimeout(() => setIsCopied(false), 2000); // 2秒後に状態をリセット
    } catch (err) {
      console.error('Failed to copy: ', err);
    }
  };

  return (
    <button onClick={handleCopy} className="text-gray-700 hover:text-gray-700 transition-colors duration-150">
      <FontAwesomeIcon icon={faClipboard} />
      {isCopied && <span className="ml-2 text-sm text-gray-700">コピーしました!</span>}
    </button>
  );
};

export default CopyToClipBoardButton;
