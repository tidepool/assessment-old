<?
require_once "WorkTypeGenerator.php";
Header("content-type: application/x-javascript");
$workType = getWorkTypes(100);
//print_r($workType);
foreach($workType as $type)
{
    echo "var workTypes = new Array();";
    echo "function populateWorkTypes(){";
    echo 'workTypes['.$type['name'].']="'.(count($type)-1).'";';
    echo "}";
}
?>