<?php
$name = $_POST['name'];

switch ($name)
{
    case 'Loading':
        echo "IM1/IM1";
        break;
    case 'IM1':
        echo "Pathway/Pathway";
        break;
    case 'Pathway':
        echo "IM2/IM2";
        break;
    case 'IM2':
        echo "Dark/Dark";
        break;
    case 'Dark':
        echo "IM3/IM3";
        break;
    case 'IM3':
        echo "Space/Space";
        break;
    case 'Space':
        echo "IM4/IM4";
        break;
    case 'IM4':
        echo "Clouds/Clouds";
        break;
    case 'Clouds':
        echo "IM5/IM5";
        break;
    case 'IM5':
        echo "Frames/Frames";
        break;
    case 'Frames':
        echo "IM6/IM6";
        break;
    case 'IM6':
        echo "Balloon/Balloon";
        break;
    case 'Balloon':
        echo "IM7/IM7";
        break;
    case 'IM7':
        echo "Animation/Animation";
        break;
    default:
        echo "Error/Error";
        break;
}
?>