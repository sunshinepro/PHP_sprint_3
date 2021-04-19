<?php

use Models\Employee;

require_once "bootstrap.php";

$newEmployeeName = $argv[1];
$employee = new Employee();
$employee->setName($newEmployeeName);
$entityManager->persist($employee);
$entityManager->flush();

echo "Created Employee with ID " . $employee->getId() . "\n";
var_dump($employee);
