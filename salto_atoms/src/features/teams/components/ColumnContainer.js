// import { SortableContext, useSortable } from "@dnd-kit/sortable";
// import { useMemo, useState } from "react";
// import PlusIcon from "@heroicons/react/24/outline/PlusIcon";
// import TaskCard from "./TaskCard";
// import TitleCard from "../../../components/Cards/TitleCard";



// function ColumnContainer({
//   column,
//   createTask,
//   tasks,
//   deleteTask,
//   updateTask,
// }) {
//   const [editMode, setEditMode] = useState(false);

//   const tasksIds = useMemo(() => tasks.map((task) => task.id), [tasks]);

//   const { setNodeRef, transform, transition, isDragging } = useSortable({
//     id: column.id,
//     data: { type: "Column", column },
//     disabled: editMode,
//   });

//   const style = {
//     transition,
//     transform: transform ? CSS.Transform.toString(transform) : undefined,
//   };

//   if (isDragging) {
//     return <div ref={setNodeRef} style={style} />;
//   }

//   const titleWithTaskCount = `${column.title} (${tasks.length})`;
//   const showAddAndTrash = column.title === '未対応';

//   return (
//     <TitleCard title={titleWithTaskCount}>
      
//       <div
//           ref={setNodeRef}
//           style={style}
//           className="bg-columnBackgroundColor flex-grow w-full h-full rounded-md flex flex-col" 
//         >
//         <div className="flex flex-grow flex-col gap-4 p-2 overflow-x-hidden overflow-y-auto border-gray-100">
//           <SortableContext items={tasksIds}>
//             {tasks.map((task) => (
//               <TaskCard
//                 key={task.id}
//                 task={task}
//                 deleteTask={deleteTask}
//                 updateTask={updateTask}
//                 showTrashIcon={showAddAndTrash}
              
//               />
//             ))}
//           </SortableContext>
//         </div>

//         {showAddAndTrash && (
//           <button
//             onClick={() => createTask(column.id)}
//             className="flex gap-2 items-center border-columnBackgroundColor border-2 rounded-md p-4 border-x-columnBackgroundColor hover:bg-mainBackgroundColor hover:text-rose-500 active:bg-black"
//           >
//             <PlusIcon className="h-8 w-8" />
//             Add task
//           </button>
//         )}
//       </div>
//     </TitleCard>
//   );
// }

// export default ColumnContainer;
