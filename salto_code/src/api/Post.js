import React, { useState, useEffect } from 'react';

function UserInfo() {
  const apiHost = process.env.REACT_APP_API_HOST;
  const [userData, setUserData] = useState([]);

  useEffect(() => {
    // APIからデータを取得
    fetch(`${apiHost}/api/posts`)
      .then(response => response.json())
      .then(data => setUserData(data.data))
      .catch(error => console.error('Error fetching data:', error));
  }, []);

  if (!userData || userData.length === 0) {
    return <div>Loading...</div>;
  }

  // 除外するカラム
  const excludedColumns = ['createdAt', 'updatedAt', 'publishedAt'];

  // 最初のデータ項目からカラム名を取得し、除外するカラムを除外
  const columns = Object.keys(userData[0].attributes).filter(column => !excludedColumns.includes(column));

  return (
    <div className="overflow-x-auto">
      <table className="table table-xs w-full text-sm text-gray-300">
      <thead>
          <tr>
            {columns.map(column => (
              <th key={column}>{column}</th>
            ))}
          </tr>
        </thead>
        <tbody>
          {userData.map(user => (
            <tr key={user.id}>
              {columns.map(column => (
                <td key={`${user.id}-${column}`} className="px-4 py-2">
                  {typeof user.attributes[column] === 'object'
                    ? JSON.stringify(user.attributes[column]) // オブジェクトは文字列化
                    : user.attributes[column]}
                </td>
              ))}
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
  
}



export default UserInfo;
