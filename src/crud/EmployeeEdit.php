<?php
require_once ".../bootstrap.php";

use Models\Employee;

// Helper functions
function redirect_to_root(){
    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

// Add new employee logic
if(isset($_GET['f_name'])){
    $employee = new Employee();
    $employee->setName($_GET['f_name']);
    $entityManager->persist($employee);
    $entityManager->flush();
    redirect_to_root();
}

// Delete employee logic
if(isset($_GET['delete'])){
    $user = $entityManager->find('Models\Employee', $_GET['delete']);
    $entityManager->remove($user);
    $entityManager->flush();
    redirect_to_root();
}

// Update employee logic
if(isset($_POST['update_name'])){
    $user = $entityManager->find('Models\Employee', $_POST['update_id']);
    $user->setName($_POST['update_name']);
    $entityManager->flush();
    redirect_to_root();
}

//Employees listed in table with edit actions

print("<pre>Find all Employees: " . "<br>");
$employees = $entityManager->getRepository('Models\Employee')->findAll();
print("<table>");
foreach($employees as $e)
    print("<tr>" 
            . "<td>" . $e->getId()  . "</td>" 
            . "<td>" . $e->getName() . "</td>" 
            . "<td><a href=\"?delete={$e->getId()}\">DELETE</a></td>" 
            . "<td><a href=\"?updatable={$e->getId()}\">UPDATE</a></td>"
        . "</tr>");
print("</table>"); 
print("</pre><hr>");


print("<pre>Add new employee: " . "</pre>")
?>
<form action="" method="GET">
  <label for="name">Employe's name: </label><br>
  <input type="text" name="F_name" value="Joe"><br>
  <input type="submit" value="Submit">
</form> 
<hr>
