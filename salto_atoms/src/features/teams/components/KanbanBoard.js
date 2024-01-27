// import { useMemo, useState } from "react";
// import ColumnContainer from "./ColumnContainer";
// import {
//   DndContext,
//   DragOverlay,
//   PointerSensor,
//   useSensor,
//   useSensors,
// } from "@dnd-kit/core";
// import { SortableContext, arrayMove } from "@dnd-kit/sortable";
// import { createPortal } from "react-dom";
// import TaskCard from "./TaskCard";

// const defaultCols = [
//   {
//     id: "todo",
//     title: "未対応",
//   },
//   {
//     id: "doing",
//     title: "対応中",
//   },
//   {
//     id: "done",
//     title: "完了",
//   },
// ];

// const defaultTasks = [
//   {
//     id: "1",
//     columnId: "todo",
//     content: "List admin APIs for dashboard",
//     assignee: "John Doe" 
//   },
//   {
//     id: "2",
//     columnId: "todo",
//     content:
//       "Develop user registration functionality with OTP delivered on SMS after email confirmation and phone number confirmation",
//       assignee: "John Doe" 

//   },
//   {
//     id: "3",
//     columnId: "doing",
//     content: "Conduct security testing",
//     assignee: "John Doe" 

//   },
//   {
//     id: "4",
//     columnId: "doing",
//     content: "Analyze competitors",
//     assignee: "John Doe" 

//   },
//   {
//     id: "5",
//     columnId: "done",
//     content: "Create UI kit documentation",
//     assignee: "John Doe" 

//   },
//   {
//     id: "6",
//     columnId: "done",
//     content: "Dev meeting",
//     assignee: "John Doe" 

//   },
//   {
//     id: "7",
//     columnId: "done",
//     content: "Deliver dashboard prototype",
//     assignee: "John Doe" 

//   },
//   {
//     id: "8",
//     columnId: "todo",
//     content: "Optimize application performance",
//     assignee: "John Doe" 

//   },
//   {
//     id: "9",
//     columnId: "todo",
//     content: "Implement data validation",
//     assignee: "John Doe" 

//   },
//   {
//     id: "10",
//     columnId: "todo",
//     content: "Design database schema",
//     assignee: "John Doe" 

//   },
//   {
//     id: "11",
//     columnId: "todo",
//     content: "Integrate SSL web certificates into workflow",
//     assignee: "John Doe" 

//   },
//   {
//     id: "12",
//     columnId: "doing",
//     content: "Implement error logging and monitoring",
//     assignee: "John Doe" 

//   },
//   {
//     id: "13",
//     columnId: "doing",
//     content: "Design and implement responsive UI",
//     assignee: "John Doe" 
//   },
// ];

// function KanbanBoard() {
//   const [columns, setColumns] = useState(defaultCols);
//   const columnsId = useMemo(() => columns.map((col) => col.id), [columns]);

//   const [tasks, setTasks] = useState(defaultTasks);

//   const [activeColumn, setActiveColumn] = useState(null);
//   const [activeTask, setActiveTask] = useState(null);

//   const sensors = useSensors(
//     useSensor(PointerSensor, {
//       activationConstraint: {
//         distance: 10,
//       },
//     })
//   );

//   return (
//        <div
//       className="
//         flex
//         items-center
  
//     "
//     >
//       <DndContext
//         sensors={sensors}
//         onDragStart={onDragStart}
//         onDragEnd={onDragEnd}
//         onDragOver={onDragOver}
//       >
//         <div className="m-auto flex gap-4">
//           <div className="flex gap-4">
//             <SortableContext items={columnsId}>
//               {columns.map((col) => (
//                 <ColumnContainer
//                   key={col.id}
//                   column={col}
//                   deleteColumn={deleteColumn}
//                   updateColumn={updateColumn}
//                   createTask={createTask}
//                   deleteTask={deleteTask}
//                   updateTask={updateTask}
//                   tasks={tasks.filter((task) => task.columnId === col.id)}
//                 />
//               ))}
//             </SortableContext>
//           </div>
//         </div>

//         {createPortal(
//           <DragOverlay>
//             {activeColumn && (
//               <ColumnContainer
//                 column={activeColumn}
//                 deleteColumn={deleteColumn}
//                 updateColumn={updateColumn}
//                 createTask={createTask}
//                 deleteTask={deleteTask}
//                 updateTask={updateTask}
//                 tasks={tasks.filter(
//                   (task) => task.columnId === activeColumn.id
//                 )}
//               />
//             )}
//             {activeTask && (
//               <TaskCard
//                 task={activeTask}
//                 deleteTask={deleteTask}
//                 updateTask={updateTask}
//               />
//             )}
//           </DragOverlay>,
//           document.body
//         )}
//       </DndContext>
//     </div>   
//   );

//   function createTask(columnId, assignee = "Unassigned") {
//     const newTask = {
//       id: generateId(),
//       columnId,
//       content: `Task ${tasks.length + 1}`,
//       assignee,
//     };
  
//     setTasks([...tasks, newTask]);
//   }
  

//   function deleteTask(id) {
//     const newTasks = tasks.filter((task) => task.id !== id);
//     setTasks(newTasks);
//   }

//   function updateTask(id, content, assignee) {
//     const newTasks = tasks.map((task) => {
//       if (task.id !== id) return task;
//       return { ...task, content, assignee };
//     });

//     setTasks(newTasks);
//   }

//   function deleteColumn(id) {
//     const filteredColumns = columns.filter((col) => col.id !== id);
//     setColumns(filteredColumns);

//     const newTasks = tasks.filter((t) => t.columnId !== id);
//     setTasks(newTasks);
//   }

//   function updateColumn(id, title) {
//     const newColumns = columns.map((col) => {
//       if (col.id !== id) return col;
//       return { ...col, title };
//     });

//     setColumns(newColumns);
//   }

//   function onDragStart(event) {
//     if (event.active.data.current?.type === "Column") {
//       setActiveColumn(event.active.data.current.column);
//       return;
//     }

//     if (event.active.data.current?.type === "Task") {
//       setActiveTask(event.active.data.current.task);
//       return;
//     }
//   }

//   function onDragEnd(event) {
//     setActiveColumn(null);
//     setActiveTask(null);

//     const { active, over } = event;
//     if (!over) return;

//     const activeId = active.id;
//     const overId = over.id;

//     if (activeId === overId) return;

//     const isActiveAColumn = active.data.current?.type === "Column";
//     if (!isActiveAColumn) return;

//     console.log("DRAG END");

//     setColumns((columns) => {
//       const activeColumnIndex = columns.findIndex((col) => col.id === activeId);

//       const overColumnIndex = columns.findIndex((col) => col.id === overId);

//       return arrayMove(columns, activeColumnIndex, overColumnIndex);
//     });
//   }

//   function onDragOver(event) {
//     const { active, over } = event;
//     if (!over) return;

//     const activeId = active.id;
//     const overId = over.id;

//     if (activeId === overId) return;

//     const isActiveATask = active.data.current?.type === "Task";
//     const isOverATask = over.data.current?.type === "Task";

//     if (!isActiveATask) return;

//     // Im dropping a Task over another Task
//     if (isActiveATask && isOverATask) {
//       setTasks((tasks) => {
//         const activeIndex = tasks.findIndex((t) => t.id === activeId);
//         const overIndex = tasks.findIndex((t) => t.id === overId);

//         if (tasks[activeIndex].columnId != tasks[overIndex].columnId) {
//           // Fix introduced after video recording
//           tasks[activeIndex].columnId = tasks[overIndex].columnId;
//           return arrayMove(tasks, activeIndex, overIndex - 1);
//         }

//         return arrayMove(tasks, activeIndex, overIndex);
//       });
//     }

//     const isOverAColumn = over.data.current?.type === "Column";

//     // Im dropping a Task over a column
//     if (isActiveATask && isOverAColumn) {
//       setTasks((tasks) => {
//         const activeIndex = tasks.findIndex((t) => t.id === activeId);

//         tasks[activeIndex].columnId = overId;
//         console.log("DROPPING TASK OVER COLUMN", { activeIndex });
//         return arrayMove(tasks, activeIndex, activeIndex);
//       });
//     }
//   }
// }

// function generateId() {
//   /* Generate a random number between 0 and 10000 */
//   return Math.floor(Math.random() * 10001);
// }

// export default KanbanBoard;
