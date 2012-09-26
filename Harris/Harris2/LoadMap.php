<?php
$name = $_POST['name'];

switch ($name)
{
    case 'IM1':
        echo "IM@";
    case 'Pathway':
        echo "Pathway@";
    case 'IM2':
        echo "IM@";
    case 'Dark':
        echo "Dark@";
    case 'IM3':
        echo "IM@";
    case 'Space':
        echo "Space@";
    case 'IM4':
        echo "IM@";
    case 'Clouds':
        echo "Clouds@";
    case 'IM5':
        echo "IM@";
    case 'Frames':
        echo "Frames@";
    case 'IM6':
        echo "IM@";
    case 'Balloons':
        echo "Balloons";
        break;
    default:
        echo "Error";
        break;
}
?>