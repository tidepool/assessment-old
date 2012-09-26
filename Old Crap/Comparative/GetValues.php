<?php
$interestArray = populateInterestArray();
$personalityArray = populatePersonalityArray();

function getInterestValue($typeA, $typeB)
{
    Global $interestArray;
    return $interestArray[$typeA][$typeB];
}

function getPersonalityValue($typeA, $typeB)
{
    Global $personalityArray;
    return $personalityArray[$typeA][$typeB];
}

function populatePersonalityArray()
{
    $temp = array();
    //HC
    $temp['HC'] = array();
    $temp['HC']['HC'] = 2;
    $temp['HC']['LC'] = 4;
    $temp['HC']['HE'] = 4;
    $temp['HC']['LE'] = 3;
    $temp['HC']['HA'] = 3;
    $temp['HC']['LA'] = 4;
    $temp['HC']['HN'] = 5;
    $temp['HC']['LN'] = 2;
    $temp['HC']['HO'] = 4;
    $temp['HC']['LO'] = 4;
    //LC
    $temp['LC'] = array();
    $temp['LC']['HC'] = 4;
    $temp['LC']['LC'] = 1;
    $temp['LC']['HE'] = 3;
    $temp['LC']['LE'] = 3;
    $temp['LC']['HA'] = 3;
    $temp['LC']['LA'] = 4;
    $temp['LC']['HN'] = 3;
    $temp['LC']['LN'] = 2;
    $temp['LC']['HO'] = 2;
    $temp['LC']['LO'] = 4;
    //HE
    $temp['HE'] = array();
    $temp['HE']['HC'] = 4;
    $temp['HE']['LC'] = 3;
    $temp['HE']['HE'] = 2;
    $temp['HE']['LE'] = 3;
    $temp['HE']['HA'] = 1;
    $temp['HE']['LA'] = 4;
    $temp['HE']['HN'] = 4;
    $temp['HE']['LN'] = 2;
    $temp['HE']['HO'] = 2;
    $temp['HE']['LO'] = 4;
    //LE
    $temp['LE'] = array();
    $temp['LE']['HC'] = 3;
    $temp['LE']['LC'] = 3;
    $temp['LE']['HE'] = 3;
    $temp['LE']['LE'] = 1;
    $temp['LE']['HA'] = 2;
    $temp['LE']['LA'] = 2;
    $temp['LE']['HN'] = 5;
    $temp['LE']['LN'] = 2;
    $temp['LE']['HO'] = 2;
    $temp['LE']['LO'] = 3;
    //HA
    $temp['HA'] = array();
    $temp['HA']['HC'] = 3;
    $temp['HA']['LC'] = 3;
    $temp['HA']['HE'] = 1;
    $temp['HA']['LE'] = 2;
    $temp['HA']['HA'] = 1;
    $temp['HA']['LA'] = 2;
    $temp['HA']['HN'] = 3;
    $temp['HA']['LN'] = 1;
    $temp['HA']['HO'] = 1;
    $temp['HA']['LO'] = 3;
    //LA
    $temp['LA'] = array();
    $temp['LA']['HC'] = 4;
    $temp['LA']['LC'] = 4;
    $temp['LA']['HE'] = 4;
    $temp['LA']['LE'] = 2;
    $temp['LA']['HA'] = 2;
    $temp['LA']['LA'] = 3;
    $temp['LA']['HN'] = 5;
    $temp['LA']['LN'] = 2;
    $temp['LA']['HO'] = 2;
    $temp['LA']['LO'] = 4;
    //HN
    $temp['HN'] = array();
    $temp['HN']['HC'] = 5;
    $temp['HN']['LC'] = 3;
    $temp['HN']['HE'] = 4;
    $temp['HN']['LE'] = 5;
    $temp['HN']['HA'] = 3;
    $temp['HN']['LA'] = 5;
    $temp['HN']['HN'] = 4;
    $temp['HN']['LN'] = 5;
    $temp['HN']['HO'] = 3;
    $temp['HN']['LO'] = 5;
    //LN
    $temp['LN'] = array();
    $temp['LN']['HC'] = 2;
    $temp['LN']['LC'] = 2;
    $temp['LN']['HE'] = 2;
    $temp['LN']['LE'] = 2;
    $temp['LN']['HA'] = 1;
    $temp['LN']['LA'] = 2;
    $temp['LN']['HN'] = 5;
    $temp['LN']['LN'] = 1;
    $temp['LN']['HO'] = 2;
    $temp['LN']['LO'] = 3;
    //HO
    $temp['HO'] = array();
    $temp['HO']['HC'] = 4;
    $temp['HO']['LC'] = 2;
    $temp['HO']['HE'] = 2;
    $temp['HO']['LE'] = 2;
    $temp['HO']['HA'] = 1;
    $temp['HO']['LA'] = 2;
    $temp['HO']['HN'] = 3;
    $temp['HO']['LN'] = 2;
    $temp['HO']['HO'] = 1;
    $temp['HO']['LO'] = 3;
    //LO
    $temp['LO'] = array();
    $temp['LO']['HC'] = 4;
    $temp['LO']['LC'] = 4;
    $temp['LO']['HE'] = 4;
    $temp['LO']['LE'] = 3;
    $temp['LO']['HA'] = 3;
    $temp['LO']['LA'] = 4;
    $temp['LO']['HN'] = 5;
    $temp['LO']['LN'] = 3;
    $temp['LO']['HO'] = 3;
    $temp['LO']['LO'] = 4;

    return $temp;
}

function populateInterestArray()
{
   $temp = array();
    //artistic
    $temp['A'] = array();
    $temp['A']['A'] = 1;
    $temp['A']['C'] = 2;
    $temp['A']['E'] = 3;
    $temp['A']['S'] = 4;
    $temp['A']['R'] = 3;
    $temp['A']['I'] = 2;
    //Conventional
    $temp['C'] = array();
    $temp['C']['A'] = 2;
    $temp['C']['C'] = 1;
    $temp['C']['E'] = 2;
    $temp['C']['S'] = 3;
    $temp['C']['R'] = 4;
    $temp['C']['I'] = 3;
    //Enterprising
    $temp['E'] = array();
    $temp['E']['A'] = 3;
    $temp['E']['C'] = 2;
    $temp['E']['E'] = 1;
    $temp['E']['S'] = 2;
    $temp['E']['R'] = 3;
    $temp['E']['I'] = 4;
    //Social
    $temp['S'] = array();
    $temp['S']['A'] = 4;
    $temp['S']['C'] = 3;
    $temp['S']['E'] = 2;
    $temp['S']['S'] = 1;
    $temp['S']['R'] = 2;
    $temp['S']['I'] = 3;
    //Realistic
    $temp['R'] = array();
    $temp['R']['A'] = 3;
    $temp['R']['C'] = 4;
    $temp['R']['E'] = 3;
    $temp['R']['S'] = 2;
    $temp['R']['R'] = 1;
    $temp['R']['I'] = 2;
    //Investigative
    $temp['I'] = array();
    $temp['I']['A'] = 2;
    $temp['I']['C'] = 3;
    $temp['I']['E'] = 4;
    $temp['I']['S'] = 3;
    $temp['I']['R'] = 2;
    $temp['I']['I'] = 1;

    return $temp;
}
?>