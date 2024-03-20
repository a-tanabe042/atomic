import React, { useEffect } from "react";
import { useRecoilState } from "recoil";
import { sidebarSectionState } from "../../state";
import TitleCard from "../../components/cards/TitleCard";
import { SidebarSectionType } from "../../types";




const Welcome: React.FC = () => {
  const [sidebarSections, setSidebarSections] = useRecoilState<SidebarSectionType[]>(sidebarSectionState);

  useEffect(() => {
    const newSidebarSections: SidebarSectionType[] = [
      {
        id: "1",
        title: "大項目1",
        description: "中項目1(大項目についての説明)",
        content:
          "<ul><li>React</li><li>Tailwind CSS</li><li>DaisyUI</li></ul><br><br><br><br><br><br><br><br><br><br><br>",
        isActive: true,
      },
      {
        id: "2",
        title: "大項目2",
        description: "中項目2(大項目についての説明)",
        content: "<p>Profileの設定をおねがいします。</p>",
        isActive: true,
      },
    ];
    setSidebarSections(newSidebarSections);
  }, [setSidebarSections]);

  return (
    <>
      <TitleCard title="Welcomeページ">
        {sidebarSections.map((sidebarSection) => (
          <article key={sidebarSection.id} className="prose">
            <h2 id={sidebarSection.id}>{sidebarSection.title}</h2>
            <p>{sidebarSection.description}</p>
            <div dangerouslySetInnerHTML={{ __html: sidebarSection.content }} />
          </article>
        ))}
      </TitleCard>
    </>
  );
};

export default Welcome;
