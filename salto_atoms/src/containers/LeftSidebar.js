// LeftSidebar コンポーネント
import React from 'react';
import { useRecoilValue } from 'recoil';
import { sectionState } from '../state'; // 適切なパスに修正してください
import SectionNav from "../components/nav/SectionNav";

function LeftSidebar() {
  const sections = useRecoilValue(sectionState);

  return (
    <div className="w-40 bg-base-100 my-8 shadow-xl rounded-2xl opacity-70">
      <SectionNav sections={sections} />
    </div>
  );
}

export default LeftSidebar;
