import React, { useEffect } from "react";
import { useRecoilState } from "recoil";
import { tabState, selectedProjectState } from "../../state";
import TabsLayout from "../../components/tab/TabsLayout";
import AddNewMember from "./components/AddNewMember";
import TrainingContext from "./components/TrainingStatus"; // 仮のコンポーネント
import ProjectStatus from "./components/ProjectStatus";
import { useCookie } from "../../hooks/useCookie"; // useCookie フックをインポート


function Teams() {
  const [selectedProjectId, setSelectedProjectId] = useCookie("selectedProject", "");
  const [selectedProject, setSelectedProject] = useRecoilState(selectedProjectState);
  const [activeTab, setActiveTab] = useRecoilState(tabState);
  const projects = [
    { id: 1, name: "Salto Codeの作成" },
    { id: 2, name: "Salto Atomsの作成" },
    { id: 3, name: "Salto盛り上げよう会" },
  ];

  useEffect(() => {
    // activeTabとselectedProjectIdの状態を更新
    if (!["Add Member", "Project", "Training"].includes(activeTab)) {
      setActiveTab("Add Member");
    }

    const currentProject = projects.find(p => p.id.toString() === selectedProjectId);
    if (currentProject && selectedProjectId !== currentProject.id.toString()) {
      setSelectedProject(currentProject);
    }
  }, [activeTab, selectedProjectId, projects]);

  const switchTab = (tabName) => {
    setActiveTab(tabName);
  };

  return (
    <>
   <label className="label">
        <span className="label-text">Select Project:</span>
      </label>
      <select
        className="select select-bordered mb-4"
        value={selectedProjectId}
        onChange={(e) => setSelectedProjectId(e.target.value)}
      >
        {projects.map((project) => (
          <option key={project.id} value={project.id}>
            {project.name}
          </option>
        ))}
      </select>

      <TabsLayout
        onTabChange={switchTab}
        tabs={["Add Member", "Project", "Training"]}
      />
      {activeTab === "Add Member" && <AddNewMember project={selectedProject} />}
      {activeTab === "Project" && <ProjectStatus project={selectedProject} />}
      {activeTab === "Training" && (
        <TrainingContext project={selectedProject} />
      )}
    </>
  );
}

export default Teams;
