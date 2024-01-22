import React from 'react';
import { CodeEditor } from './CodeEditor';
import { Sidebar } from './Sidebar';
import { ThemeSwitcher } from '../../components/ThemeSwitcher'; // パスは適宜調整

function CodingInterface() {
  // ThemeSwitcher コンポーネントを使用してテーマを適用
  return (
    
    <div className="flex h-screen w-full overflow-hidden">
      <Sidebar />
      <div className="flex-grow overflow-y-auto">
        <CodeEditor />
        <ThemeSwitcher />
      </div>
      
    </div>
  );
}

export default CodingInterface;
