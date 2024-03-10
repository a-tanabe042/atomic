import React, { useEffect } from "react";
import { useRecoilState } from "recoil";
import { sectionState } from "../../state";
import TitleCard from "../../components/cards/TitleCard";

function Welcome() {
  const [sections, setSections] = useRecoilState(sectionState);

  useEffect(() => {
    const newSections = [
      {
        id: "1",
        title: "大項目1",
        description: "中項目1(大項目についての説明)",
        content:
          "<ul><li>React</li><li>Tailwind CSS</li><li>DaisyUI</li></ul><br><br><br><br><br><br><br><br><br><br><br>",
      },
      {
        id: "2",
        title: "大項目2",
        description: "中項目2(大項目についての説明)",
        content: "<p>Profileの設定をおねがいします。</p>",
      },
    ];
    setSections(newSections);
  }, [setSections]);

  return (
    <>
      <TitleCard title="Welcomeページ" >
        {sections.map((section) => (
          <article key={section.id} className="prose">
            <h2 id={section.id}>{section.title}</h2>
            <p>{section.description}</p>
            <div dangerouslySetInnerHTML={{ __html: section.content }} />
          </article>
        ))}
      </TitleCard>
    </>
  );
}

export default Welcome;
