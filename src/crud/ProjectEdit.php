<?php
require_once ".../bootstrap.php";

use Models\Project;


// Helper functions
function redirect_to_root(){
    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

// Add new project logic
if(isset($_GET['name'])){
    $project = new Project();
    $project->setName($_GET['name']);
    $entityManager->persist($project);
    $entityManager->flush();
    redirect_to_root();
}

// Delete project logic
if(isset($_GET['delete'])){
    $user = $entityManager->find('Models\Project', $_GET['delete']);
    $entityManager->remove($user);
    $entityManager->flush();
    redirect_to_root();
}

// Update project logic
if(isset($_POST['update_name'])){
    $user = $entityManager->find('Models\Project', $_POST['update_id']);
    $user->setName($_POST['update_name']);
    $entityManager->flush();
    redirect_to_root();
}

// Projects listed in table with edit actions

$counter=0; 

print("<pre>Find all Projects: " . "<br>");
$projects = $entityManager->getRepository('Models\Project')->findAll();
print("<table>");
foreach($projects as $p)
    $counter++; 
    print("<tr>" 
            . "<td>" . $counter . "</td>" 
            . "<td>" . $p->getName() . "</td>" 
            . "<td><a href=\"?delete={$p->getId()}\">DELETE</a>☢️</td>" 
            . "<td><a href=\"?updatable={$p->getId()}\">UPDATE</a>♻️</td>"
        . "</tr>");
print("</table>"); 
print("</pre><hr>");




//Project update actions
if(isset($_GET['updatable']) &&  $_GET['updatable'] !== ''){
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
// else {
//     print <p>" Field can not be empty!" </p>
// }

//Create new project actions
print("<pre>Add new Project: " . "</pre>")
?>
<form action="" method="GET">
  <label for="name">Project name: </label><br>
  <input type="text" name="name" value="Doe"><br>
  <input type="submit" value="Submit">
</form> 
<hr>