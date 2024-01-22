import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faFile, faFolder } from '@fortawesome/free-solid-svg-icons';

export const SidebarFolder = () => {
  const renderFolderContents = (contents) => {
    return contents.map((item, index) => {
      const icon = item.type === "file" ? faFile : faFolder;
      if (item.type === "file") {
        return (
          <li key={index}>
            <p><FontAwesomeIcon icon={icon} className='text-yellow-400' /> {item.name}</p>
          </li>
        );
      } else if (item.type === "folder") {
        return (
          <li key={index}>
            <details open>
              <summary><FontAwesomeIcon icon={icon} className='text-blue-400' /> {item.name}</summary>
              <ul>{renderFolderContents(item.children)}</ul>
            </details>
          </li>
        );
      }
      return null; // If the item is neither a file nor a folder
    });
  };

  return (
    <ul className="menu menu-xs max-w-xs w-full overflow-auto text-white bg-white bg-opacity-10 rounded-lg">
      {renderFolderContents(folderData)}
    </ul>
  );
};
//folder file data

const folderData = [
  { name: "resume.pdf", type: "file" },
  { 
    name: "myDocuments", 
    type: "folder", 
    children: [
      { name: "CoverLetter.docx", type: "file" },
      { name: "CV.docx", type: "file" }
    ]
  },
  { 
    name: "myProjects", 
    type: "folder", 
    children: [
      { 
        name: "projectAlpha", 
        type: "folder", 
        children: [
          { name: "Alpha-1.jpg", type: "file" },
          { name: "Alpha-2.jpg", type: "file" }
        ]
      },
      { 
        name: "projectBeta", 
        type: "folder", 
        children: [
          { name: "Beta-1.jpg", type: "file" },
          { name: "Beta-2.jpg", type: "file" },
          { name: "Readme.txt", type: "file" }
        ]
      }
    ]
  },
  { name: "expenses.xlsx", type: "file" },
  { name: "meeting-notes.docx", type: "file" }
];
