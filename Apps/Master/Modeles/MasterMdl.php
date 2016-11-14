<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterMdl
 *
 * @author lio
 */


class MasterMdl {

    public function encryption ($textToEncrypt, $blockSize) {
        $encryptedText = $this->encryptionBase($textToEncrypt, $blockSize);

        return $encryptedText;
    }

    private function encryptionBase($textToEncrypt, $blockSize) {
        // transform string->array and reverse it
        $splitAndReversedText = array_reverse(str_split($textToEncrypt, 1));

        // test block size
        if(sizeof($splitAndReversedText)%$blockSize != 0) { // non null rest -> empty space within last block
            $lastBlockDifference= $blockSize-sizeof($splitAndReversedText)%$blockSize;

            // fill in last block blanks with empty space
            // these will be shifted using a special function
            for($i = 0; $i < $lastBlockDifference; $i++) {
                array_push($splitAndReversedText, '');
            }
        }

        // 1. Convert each char to ascii level
//        $encodedChar = [];
//        foreach ($splitAndReversedText as $initChar) {
//            array_push($encodedChar, $this->asciiBasicTransform($initChar));
//        }

        $nbBlocks = sizeof($splitAndReversedText)/$blockSize;

        // 2. retrieve first key constraint
        $firstKeyConstraint = $this->keygen($nbBlocks, $blockSize);


        // 3. generate random code for each initial character
        $baseBuilder = $this->randAlphabetCode();

        // 4. make comparison between initial text and $baseBuilder, then convert string to number
        $splitAndReversedTextEncoded = [];
        $i = 0;
        foreach ($baseBuilder as $charKey => $charValue) {
            for($j = 0; $j < sizeof($splitAndReversedText); $j++) {
                if($splitAndReversedText[$j] == $charValue[0]) {
                    array_push($splitAndReversedTextEncoded, $charValue[1]);
                }
            }
            $i++;
        }

        return 0;

        $firstLevelAssociation = [];
        $i = 0;

        // create a random association between text and key
//        foreach($firstKeyConstraint as $switch) {
//            array_push($firstLevelAssociation, [$splitAndReversedText[$i], $switch]);
//            $i++;
//        }

        // convert char to int using ascii
//        $convertStringArr = [];
//
//        for($i = 0; $i < sizeof($firstLevelAssociation); $i++) {
//            array_push($convertStringArr, $this->asciiBasicTransform($firstLevelAssociation[$i][0]));
//        }

        // apply first key constraint
        $firstBijectionArray = $this->vigenereFirstKeyConstraint($encodedChar, $firstKeyConstraint);

        // convert to character array
            $encryptedScriptArray = [];

            for($i = 0; $i < sizeof($firstBijectionArray); $i++) {
                array_push($encryptedScriptArray, chr($firstBijectionArray[$i]+96));
            }

        return $encryptedScriptArray;
    }

    private function keygen ($nbBlocks, $blockSize) {
        $keyConstraintFirstLevel = [];
        $totalFirstSwitch = $nbBlocks*$blockSize;

        for($i = 0; $i <$totalFirstSwitch; $i++) {
            array_push($keyConstraintFirstLevel, rand(0,25));
        }

        return $keyConstraintFirstLevel;
    }

    private function asciiBasicTransform ($letter) {
        if($letter) {
            return ord(strtolower($letter))-96;
        } else {
            return 0;
        }
    }

    private function vigenereFirstKeyConstraint($stringArr, $key) {
        $vigenereFirstLevel = [];
        $i = 0;

        foreach ($stringArr as $charInt) {
            $bijection = $charInt+$key[$i];
            array_push($vigenereFirstLevel, $bijection);
            $i++;
        }

        return $vigenereFirstLevel;
    }

    private function randAlphabetCode () {
        // Generate a random correlation between letters and coded number that will create the base of the switch
        $randomNumber = range('1','26');
        $alphabet = range('a','z');

        $uniqueCode = [];

        for($i = 0; $i < 27; $i++) {
            $insert = false;
            do {
                // pick up one random number and only one, then test it
                $valueToInsert = array_rand($randomNumber);

                if(!in_array($valueToInsert, $uniqueCode)) {
                    array_push($uniqueCode, $valueToInsert);
                    $insert = true;
                } else {
                    $insert = false;
                }
            } while ($insert == false);
        }

        $codeCorrelation = [];
        $i = 0;
        foreach ($uniqueCode as $code) {
            array_push($codeCorrelation, [$alphabet[$i], $code]);
            $i++;
        }

        // push empty char too
        array_push($codeCorrelation, ['', 100]);

        return $codeCorrelation;
    }

}
?>
