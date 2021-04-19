<?php

use Models\Project;

require_once "bootstrap.php";

$newProjectName = $argv[1];
$project = new Project();
$project->setName($newProjectName);
$entityManager->persist($project);
$entityManager->flush();

echo "Created Project with ID " . $project->getId() . "\n";
