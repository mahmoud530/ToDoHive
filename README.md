# Download details
- please upon downloading uncompress these 3 folders
1. .vscode
2. images
3. mail
- and import the database named case01

# About ToDo Hive

- its a Planner website that allows users to work on their projects with their team

- a user can be a Team Leader or a Team member 

- a team leader is the only person who can create a project and he has to subscribe to a plan first

- a project contains team members according to a Leader's Subscription Plan and a user can add or delete member from the project details page

- a project contains unlimited sprints with a timeframe specified by the user that cannot be older than the current date and cannot be shorter than 2 weeks or be longer than 4 weeks  ( Both team members and team leaders can add a sprint)

- sprint details contains all the tasks inside that sprint according to status (ToDo, testing, in progress, Done) and a user can filter tasks according to task priority

- Every sprint contains a counter for how many days are left for that sprint to expire and upon expiration no user can add anymore tasks

- any user(whether a leader or a member ) can create and assign tasks to any member or to himself through the add task button inside sprint details, and can choose task category, priority, and deadline ( which can't be added older than current details),

- upon assigning a task the assignee receives an email with the task name and the reporter's name

- any user can access the task details, which is a page that contains all the data about the task and who the assignee and the reporter are and anyone can add comments, upload files along with their comments, or download already commented files, also the commenter can delete only the comments they added

- a reporter or an assignee can both edit task status or task priority

- the assignee can re-assign a task through the share task icon on the top right where he gets a list with any member except himself

- the project contains search bar on projects and a search bar on sprints, along with a filter on task priorities

- a team leader have the option to upgrade his subscription plan

- lastly a profile page where a user gets a display of all his tasks and can change his password

# Folders
- [USER] a user interface containing all the previous
- [ADMIN] an admin interface where an admin can view, edit, add, or delete subscription plans
- [DIAGRAMS] a folder containig 3 diagrams (usecase, sitemap , ERD)
