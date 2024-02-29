import React from 'react';

const ErrorMessage = ({ message }) => {
  if (!message) return null;

  return (
    <div style={{ color: 'red', margin: '20px 0' }}>
      エラーが発生しました: {message}
    </div>
  );
};

export default ErrorMessage;
