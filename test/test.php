<? // should be rewritten ?>
<?}// should be rewritten ?>
<?='text'; // should be rewritten ?>
<? // should be rewritten ?>
<?{ // should be rewritten ?> 
<?} // should be rewritten ?> 
<?echo 'text';// should be rewritten ?>
<?
// should be rewritten
?>
<?if(1==2){ //should be rewritten} ?>
<?(1==2)?$a=1:$a=2; //should be rewritten} ?>
<?($whatever="something"); // should be rewritten ?>
<?$test=1;// should be rewritten ?>

<?PHP_CONST //should be rewritten but currently not supported in RegEx ?>
<?PHPCONST //should be rewritten but currently not supported in RegEx ?>

<?php //should not be rewritten ?>
<?xml //should not be rewritten ?>
<?PHP //should not be rewritten ?>
