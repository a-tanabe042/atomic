import React, { useState } from "react";
import ProjectContext from "../../projects/components/ProjectContext";
import ProjectMemberList from "./ProjectMemberList";
import KanbanBoard from "./KanbanBoard";
import CreateProjectModal from "../../projects/components/CreateProjectModal";

const ProjectStatus = () => {
  const [createProjectModal, setCreateProjectModal] = useState(false);

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
      <div className="mt-4">
       
        <ProjectContext />
      </div>
      <div className="flex justify-end">
        <button 
          onClick={handleCreateProjectClick}
          className="btn btn-error text-white fixed right-5 bottom-5 rounded-full z-10" // Add your styling here
        >
          Edit Project
        </button>
      </div>
      <div>
        <ProjectMemberList />
      </div>
     
      <div>
        <KanbanBoard />
      </div>

      {createProjectModal && (
        <CreateProjectModal
          isOpen={createProjectModal}
          onClose={handleCloseModal}
        />
      )}
    </>
  );
};

export default ProjectStatus;
