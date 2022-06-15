<?php
require_once "../../DB/dbConfig.php";
$crud = new Crud($db);

$Profiles_SteamID64 = $_POST['Profiles_SteamID64'];
$IsWipe = $_POST['IsWipe'];
$ChangelogTitle = $_POST['ChangelogTitle'];
$ChangelogFeatures = $_POST['ChangelogFeatures'];
$ChangelogKnownIssues = $_POST['ChangelogKnownIssues'];
$ChangelogBugFixes = $_POST['ChangelogBugFixes'];



$sqlArray = array(
  'Profiles_SteamID64' => $Profiles_SteamID64,
  'IsWipe' => $IsWipe,
  'ChangelogTitle' => $ChangelogTitle,
  'ChangelogFeatures' => $ChangelogFeatures,
  'ChangelogKnownIssues' => $ChangelogKnownIssues,
  'ChangelogBugFixes' => $ChangelogBugFixes,
);

$changelog = $crud->Save('Changelog', $sqlArray);

if($changelog > 0){
//Success
  echo 1;
}else{
//Failed
  echo 0;
}
