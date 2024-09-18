import TaskBar from "./TaskBar";


const projects = [
  {
    id: 1,
    project: "Project Management System",
    task: "Create dashboard layout",
    status: "In Progress",
    assigndate: "2024-09-10",
    deadline: "2024-09-20"
  },
  {
    id: 2,
    project: "E-commerce Website",
    task: "Implement payment gateway",
    status: "Not Started",
    assigndate: "2024-09-12",
    deadline: "2024-09-25"
  },
  {
    id: 3,
    project: "Social Media App",
    task: "Fix login issue",
    status: "Completed",
    assigndate: "2024-09-05",
    deadline: "2024-09-15"
  },
  {
    id: 4,
    project: "Blog Platform",
    task: "Add comment section",
    status: "In Review",
    assigndate: "2024-09-08",
    deadline: "2024-09-18"
  },
  {
    id: 5,
    project: "Portfolio Website",
    task: "Update portfolio content",
    status: "In Progress",
    assigndate: "2024-09-11",
    deadline: "2024-09-21"
  }
];

console.log(projects);


const TableThree = () => {
  return (
    <div className="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
      <div className="max-w-full overflow-x-auto">
        <table className="w-full table-auto">
          <thead>
            <tr className="bg-gray-2 text-left dark:bg-meta-4">
              <th className="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11">
                Project
              </th>
              <th className="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                Task Name
              </th>
             
              <th className="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">
                Assign Date
              </th>
              <th className="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">
                Deadline
              </th>
              <th className="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">
                Status
              </th>
              <th className="py-4 px-4 font-medium text-black dark:text-white">
                Actions
              </th>
            </tr>
          </thead>
          <tbody>
          {projects.map((element)=>{
             return <TaskBar key={element.id} {...element} />
          })}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default TableThree;
