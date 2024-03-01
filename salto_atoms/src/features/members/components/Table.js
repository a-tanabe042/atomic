import React from 'react';

function Table({ columns, data }) {
  return (
    <div className="overflow-auto w-full py-2">
      <table className="table w-full">
        <thead>
          <tr>
            {columns.map((column, index) => (
              <th key={index} className="text-xs text-center">{column.header}</th>
            ))}
          </tr>
        </thead>
        <tbody>
          {Array.isArray(data) ? data.map((item, rowIndex) => (
            <tr key={rowIndex} className="bg-white shadow-lg rounded-lg overflow-hidden mb-4">
              {columns.map((column, colIndex) => (
                <td key={colIndex} className="p-4">
                  {column.render(item)}
                </td>
              ))}
            </tr>
          )) : (
            <tr>
              <td colSpan={columns.length}>-</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
}

export default Table;
