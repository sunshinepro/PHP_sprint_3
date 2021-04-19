<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./tableDesign.css">
    <title>Project management with entities</title>
</head>
<body>
<header>
    <!-- <a href="./scr/crud/EmployeeEdit.php">Employees</a>
    <a href="./scr/crud/ProjectEdit.php">Projects</a> -->
</header>

<?php
require_once "./bootstrap.php";

use Models\Employee;
use Models\Project;


// Helper functions
function redirect_to_root(){
    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

// Add new project
if(isset($_GET['name'])){
    $project = new Project();
    $project->setName($_GET['name']);
    $entityManager->persist($project);
    $entityManager->flush();
    redirect_to_root();
}

// Delete project
if(isset($_GET['delete'])){
    $user = $entityManager->find('Models\Project', $_GET['delete']);
    $entityManager->remove($user);
    $entityManager->flush();
    redirect_to_root();
}

// Update
if(isset($_POST['update_name'])){
    $user = $entityManager->find('Models\Project', $_POST['update_id']);
    $user->setName($_POST['update_name']);
    $entityManager->flush();
    redirect_to_root();
}

// print("<pre>Find Project by id: " . "<br>");
// // $project = $entityManager->find('Project', 66);
// // ... SELECT + WHERE ID
// $project = $entityManager->find('Models\Project', 3); // jei naudojame namespaceus
// $project !== NULL ? print $project->getId() . ' ' . $project->getName() : '';
// print("</pre><hr>");

// print("<pre>Find Project(s) by other property (name): " . "<br>");
// // ... SELECT + WHERE Name
// $projects = $entityManager->getRepository('Models\Project')->findBy(array('name' => 'Dress'));
// $projects[0] !== NULL ? print $projects[0]->getId() . ' ' . $projects[0]->getName() : '';
// print("</pre><hr>");

// print("<pre>Find Project(s) by other property (name): " . "<br>");
// $projects = $entityManager->getRepository('Models\Project')->findBy(array('name' => 'Doe'));
// print("<table>");
// foreach($projects as $p)
//     print("<tr>" 
//             . "<td>" . $p->getId()  . "</td>" 
//             . "<td>" . $p->getName() . "</td>" 
//             . "<td><a href=\"?delete={$p->getId()}\">DELETE</a></td>" 
//             . "<td><a href=\"?updatable={$p->getId()}\">UPDATE</a></td>"
//         . "</tr>");
// print("</table>"); 
// print("</pre><hr>");

// print("<pre>Find Project(s) by other property (name) sorted by another property (id): " . "<br>");
// $projects = $entityManager->getRepository('Models\Project')->findBy(array('name' => 'Doe'), array('id' => 'DESC'));
// print("<table>");
// foreach($projects as $p)
//     print("<tr>" 
//             . "<td>" . $p->getId()  . "</td>" 
//             . "<td>" . $p->getName() . "</td>" 
//             . "<td><a href=\"?delete={$p->getId()}\">DELETE</a></td>" 
//             . "<td><a href=\"?updatable={$p->getId()}\">UPDATE</a></td>"
//         . "</tr>");
// print("</table>"); 
// print("</pre><hr>");

// $c=1; 
print("<pre>Find all Projects: " . "<br>");
$projects = $entityManager->getRepository('Models\Project')->findAll();
print("<table>
<tr>
    <th>Row Number</th>
    <th>Project name</th>
    <th>Employee</th>
    <th>Action</th>
</tr>");

foreach($projects as $p)
      print("<tr>" 
            . "<td>" . $p->getId() . "</td>" 
            . "<td>" . $p->getName() . "</td>" 
            . "<td>" . $p->getName() . "</td>" 
            . "<td><a href=\"?delete={$p->getId()}\">DELETE</a>☢️<a href=\"?updatable={$p->getId()}\">UPDATE</a>♻️</td>"
        . "</tr>");
print("</table>"); 
print("</pre><hr>");
// $c++;



if(isset($_GET['updatable'])){
    $project = $entityManager->find('Models\Project', $_GET['updatable']);
    print("<pre>Update Project: </pre>");
    print("
        <form action=\"\" method=\"POST\">
            <input type=\"hidden\" name=\"update_id\" value=\"{$project->getId()}\">
            <label for=\"name\">Project name: </label><br>
            <input type=\"text\" name=\"update_name\" value=\"{$project->getName()}\"><br>
            <input type=\"submit\" value=\"Submit\">
        
            <button type=\"submit\" name=\"cancel\">Cancel</button>


         </form>"
        );
    print("<hr>");
}

print("<pre> Add new Project: " . "</pre>")
?>
<form action="" method="GET">
  <label for="name">Project name: </label><br>
  <input type="text" name="name" value="Doe"><br>
  <input type="submit" value="Submit">
</form> 
<hr>
</body>
</html>