<?php

function checkInput($expReg,$input){
    if(preg_match($expReg,$input)){
        return true;
    }
    else{
        return false;
    }
}

