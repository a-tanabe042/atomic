import { useState, useEffect } from "react";
import { useRecoilState } from "recoil";
import { tabState } from "../../state";
import { useDispatch } from "react-redux";
import TitleCard from "../../components/Cards/TitleCard";
import { showNotification } from "../common/headerSlice";
import ProjectMembers from "./components/ProjectMembers";
import ProjectContext from "./components/ProjectContext";
import CreateProjectModal from "./components/CreateProjectModal";
import TabsLayout from "../../components/tab/TabsLayout";

function Projects() {
  const dispatch = useDispatch();
  const [activeTab, setActiveTab] = useRecoilState(tabState);
  const [integrationList, setIntegrationList] = useState(MY_PROJECTS_LIST);
  const [createProjectModal, setCreateProjectModal] = useState(false);

  useEffect(() => {
    // activeTabが変更されたときにプロジェクトリストを更新
    if (!activeTab || !['myProjects', 'allProjects'].includes(activeTab)) {
      setActiveTab('myProjects');
    }
    const updatedList = (
      activeTab === "myProjects" ? MY_PROJECTS_LIST : ALL_PROJECTS_LIST
    ).map((item) => ({ ...item, isActive: false }));

    setIntegrationList(updatedList);
  }, [activeTab]);
  

  // Function to update the active status of a project
  const updateIntegrationStatus = (index) => {
    const newList = integrationList.map((item, idx) => {
      return idx === index ? { ...item, isActive: !item.isActive } : item;
    });
    // Dispatch a notification when the tab changes
    dispatch(
      showNotification({
        message: `Switched to ${
          activeTab === "myProjects" ? "My Projects" : "All Projects"
        }`,
        status: 1,
      })
    );

    setIntegrationList(newList);
  };

  // Find the currently active project
  const activeProject = integrationList.find((item) => item.isActive);

  // Function to switch between tabs
  const switchTab = (tabName) => {
    setActiveTab(tabName);
  };

  // Function to open the create project modal
  const handleCreateProjectClick = () => {
    setCreateProjectModal(true);
  };

  // Function to close the create project modal
  const handleCloseModal = () => {
    setCreateProjectModal(false);
  };

  return (
    <>
    <TabsLayout onTabChange={switchTab} tabs={["myProjects", "allProjects"]} />


      {/* Grid for displaying projects */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mt-2">
        {integrationList.map((project, i) =>
          // Render TitleCard for each active project
          project.isActive || !integrationList.some((item) => item.isActive) ? (
            <TitleCard key={i} title={project.name} topMargin={"mt-2"}>
              <span className="badge badge-outline">{project.badge}</span>
              <p className="flex mt-2">{project.description}</p>

              {/* Toggle for project active status */}
              <div className="flex mt-12 justify-between">
                <ProjectMembers />
                <div className="mt-6 text-right">
                  <input
                    type="checkbox"
                    className="toggle toggle-success toggle-lg"
                    checked={project.isActive}
                    onChange={() => updateIntegrationStatus(i)}
                  />
                </div>
              </div>
            </TitleCard>
          ) : null
        )}
      </div>

      {/* Display additional context for the active project */}
      {activeProject && (
        <div className="mt-4">
          <ProjectContext project={activeProject} />
        </div>
      )}

      {/* Button to create a new project, shown only on My Projects tab */}
      {activeTab === "myProjects" && (
        <button
          className="btn btn-error text-white fixed right-5 bottom-5 rounded-full"
          onClick={handleCreateProjectClick}
        >
          Create Project
        </button>
      )}

      {createProjectModal && (
        <CreateProjectModal
          isOpen={createProjectModal}
          onClose={handleCloseModal}
        />
      )}
    </>
  );
}

export default Projects;

// Dummy data for My Projects
const MY_PROJECTS_LIST = [
  {
    name: "社内研修アプリの作成",
    badge: "個人開発",
    isActive: false,
    description:
      "Slack is an instant messaging program designed by Slack Technologies and owned by Salesforce.",
  },
  {
    name: "社内管理アプリの作成",
    badge: "社内開発",
    isActive: false,
    description:
      "Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook.",
  },
  {
    name: "SALTO盛り上げよう会",
    badge: "社内開発",
    isActive: false,
    description:
      "Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook.",
  },
];

// Dummy data for All Projects
const ALL_PROJECTS_LIST = [
  {
    name: "社内研修アプリの作成",
    badge: "個人開発",
    isActive: false,
    description:
      "Slack is an instant messaging program designed by Slack Technologies and owned by Salesforce.",
  },
  {
    name: "社内管理アプリの作成",
    badge: "社内開発",
    isActive: false,
    description:
      "Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook.",
  },
  {
    name: "SALTO盛り上げよう会",
    badge: "社内開発",
    isActive: false,
    description:
      "Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook.",
  },
  {
    name: "コーポレートサイトの作成",
    badge: "個人開発",
    isActive: false,
    description:
      "Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook.",
  },
  {
    name: "【新卒研修】SQL問題集",
    badge: "社内研修",
    isActive: false,
    description:
      "Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook.",
  },
];
