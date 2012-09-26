<?php
$name = $_POST['name'];

switch ($name)
{
    case 'PenHolders':
        echo "PenHolders@";
    case 'Violin':
        echo "Violin@";
    case 'Space':
        echo "Space@";
    case 'Clouds':
        echo "Clouds@";
    case 'Frames':
        echo "Frames@";
    case 'Beach':
        echo "Beach";
        break;
    default:
        echo "Error";
        break;
}
?>