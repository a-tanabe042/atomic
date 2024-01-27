// import { useState } from "react";
// import  TrashIcon  from "@heroicons/react/24/outline/TrashIcon";
// import { useSortable } from "@dnd-kit/sortable";
// import { CSS } from "@dnd-kit/utilities";

// function TaskCard({ task, deleteTask, updateTask, showTrashIcon }) {
//   const [mouseIsOver, setMouseIsOver] = useState(false);
//   const [editMode, setEditMode] = useState(true);

//   const {
//     setNodeRef,
//     attributes,
//     listeners,
//     transform,
//     transition,
//     isDragging,
//   } = useSortable({
//     id: task.id,
//     data: {
//       type: "Task",
//       task,
//     },
//     disabled: editMode,
//   });

//   const style = {
//     transition,
//     transform: CSS.Transform.toString(transform),
//   };

//   const toggleEditMode = () => {
//     setEditMode((prev) => !prev);
//     setMouseIsOver(false);
//   };

//   if (isDragging) {
//     return (
//       <div
//         ref={setNodeRef}
//         style={style}
//         className="opacity-30 bg-mainBackgroundColor p-2.5 h-24 min-h-24 flex items-center text-left rounded-xl border-2 border-rose-500 cursor-grab relative"
//       />
//     );
//   }

//   if (editMode) {
//     return (
      
//       <div
//         ref={setNodeRef}
//         style={style}
//         {...attributes}
//         {...listeners}
//         className="p-2.5 h-32 min-w-[320px] flex items-center text-left rounded-lg hover:ring-2 hover:ring-inset hover:ring-rose-500 cursor-grab relative"
//       >
//         <textarea
//           className="h-full w-full border-none rounded bg-transparent focus:outline-none min-w-[320px]"
//           value={task.content}
//           autoFocus
//           placeholder="Task content here"
//           onBlur={toggleEditMode}
//           onKeyDown={(e) => {
//             if (e.key === "Enter" && e.shiftKey) {
//               toggleEditMode();
//             }
//           }}
//           onChange={(e) => updateTask(task.id, e.target.value)}
//         />
//       </div>
//     );
//   }

//   return (
//     <div className="border border-gray-300 rounded-lg shadow-sm ">
//       <div
//         ref={setNodeRef}
//         style={style}
//         {...attributes}
//         {...listeners}
//         onClick={toggleEditMode}
//         className="p-2 h-24 flex items-center text-left rounded-lg hover:ring-2 hover:ring-inset hover:ring-rose-500 cursor-grab relative min-w-[320px]"
//         onMouseEnter={() => setMouseIsOver(true)}
//         onMouseLeave={() => setMouseIsOver(false)}
//       >
//         <p className="my-auto h-full w-full overflow-y-auto overflow-x-hidden mr-1 p-1">
//           {task.content}
//         </p>

//         {mouseIsOver && showTrashIcon && (
//           <button
//             onClick={() => deleteTask(task.id)}
//             className=""
//           >
//             <TrashIcon className="h-8 w-8" />
//           </button>
//         )}
//       </div>
//     </div>
//   );
// }

// export default TaskCard;
