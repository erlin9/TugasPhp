<?php
/*
********************************************************
  TinyButStrong 1.81
  Template Engine for Pro and Beginners

Web site : http://www.tinybutstrong.com
Forum    : http://www.tinybutstrong.com/index.php?page=forum
Author   : skrol29@freesurf.fr | http://www.skrol29.com
********************************************************

This library is free software. 
You can redistribute and modify it even for commercial usage,
but you must accept and respect the LPGL License (v2.1 or later).
*/

//You can change the TinyButStrong markers in you code.
$tbs_ChrOpen = '[' ;
$tbs_ChrClose = ']' ;

// Render flags.
define('TBS_NOTHING', 0) ;
define('TBS_OUTPUT', 1) ;
define('TBS_EXIT', 2) ;
// Special cache actions.
define('TBS_DELETE', -1) ;
define('TBS_CANCEL', -2) ;
define('TBS_CACHENOW', -3) ;

//Check PHP version
if (doubleval(PHP_VERSION)<4.2) {
	tbs_Misc_Alert('Error','PHP Version Check','Your PHP version is '.PHP_VERSION.' while TinyButStrong needs PHP version 4.2.0 or higher.' ) ;
}

//Init common variables
$tbs_CurrVal = '' ;
$tbs_CurrRec = array() ;

$_tbs_PhpVarLst = False ;
$_tbs_Timer = tbs_Misc_Timer() ;
tbs_Misc_ActualizeChr() ;

//Classes
class clsTbsLocator {
	var $PosBeg = False ;
	var $PosEnd = False ;
	var $FullName = False ;
	var $SubName = False ;
	var $PrmLst = array() ;
	var $PrmPos = False ;
	var $BlockNbr = 0 ;
	var $BlockLst = False ;
}

class clsTinyButStrong {
	//Public properties
	var $Source = '' ; //Current result of the merged template
	var $Render = 3 ;
	//Private properties
	var $_Version = '1.81';
	var $_LastFile = '' ; //The last loaded template file
	var $_StartMerge = 0 ; 
	var $_Timer = False ; //True if a system field about time has been found in the template
	var $_CacheFile = False ; // The name of the file to save the content in.
	var $_DebugTxt = '' ;
	//Public methods
	function LoadTemplate($File) {
		$this->_StartMerge = tbs_Misc_Timer() ;
		tbs_Misc_ActualizeChr() ;
		//Load the file
		tbs_Misc_GetFile($this->Source,$File) ;
		$this->_LastFile = $File ;
		//Include files
		tbs_Misc_ClearPhpVarLst() ;
		tbs_Merge_File($this->Source,'') ; //'tbs_include.onload' is performed inside tbs_Merge_File.
	}
	function GetBlockSource($BlockName,$List=False) {
		$BlockLoc = tbs_Locator_FindBlockLst($this->Source,$BlockName) ;
		if ($BlockLoc->DefFound===False) {
			if ($List) {
				return False ;
			} else {
				return array() ;
			}
		} else {
			if ($List) {
				return $BlockLoc->BlockLst ;
			} else {
				return $BlockLoc->BlockLst[1] ;
			}
		}
	}
	function MergeBlock($BlockName,$SrcId,$Query='',$PageSize=0,$PageNum=0,$RecKnown=0) {
		return tbs_Merge_Block($this->Source,$BlockName,$SrcId,$Query,True,$PageSize,$PageNum,$RecKnown) ;
	}
	function MergeField($FieldName,$Value) {
		tbs_Misc_ClearPhpVarLst() ; //Usefull here because the field can have an file inclusion
		tbs_Merge_Field($this->Source,$FieldName,$Value) ;
	}
	function MergeSpecial($Type) {
		$Type = strtolower($Type) ;
		tbs_Misc_ClearPhpVarLst() ;
		tbs_Merge_Special($this,$Type) ;
	}
	function Show($End=NULL,$MergePhpVar=True,$Output=NULL) {
		//Those parameters are only for comaptibility
		//Now you must use the ->Render property
		tbs_Misc_ClearPhpVarLst() ;

		if ($MergePhpVar) { 
			tbs_Merge_Special($this,'include,include.onshow,var,sys,check,timer') ;
		} else {
			tbs_Merge_Special($this,'include,include.onshow,sys,check,timer') ;
		}

		if ($this->_DebugTxt!=='') $this->Source = $this->_DebugTxt.$this->Source ;
		
		if ($this->_CacheFile!==False) {
			tbs_Cache_Save($this->_CacheFile,$this->Source) ;
		}

		if (is_null($Output)) {
			if (($this->Render & TBS_OUTPUT) == TBS_OUTPUT) echo($this->Source) ;
		} elseif ($Output) {
			echo($this->Source) ;
		}

		if (is_null($End)) {
			if (($this->Render & TBS_EXIT) == TBS_EXIT) exit ;
		} elseif ($End) {
			exit ;
		}

	}
	function CacheAction($CacheId,$TimeOut=3600,$Dir='') {

		$Mask = 'cache_tbs_*.php' ;
		$CacheId = trim($CacheId) ;
		$Res = False ;

		if ($TimeOut === TBS_CANCEL) { //Cancel cache save if any
			$this->_CacheFile = False ;
		} elseif ($CacheId === '*') {
			if ($TimeOut === TBS_DELETE) {
				$Res = tbs_Cache_DeleteAll($Dir,$Mask) ;
			}
		} else {
			$CacheFile = tbs_Cache_File($Dir,$CacheId,$Mask) ;
			if ($TimeOut === TBS_CACHENOW) {
				tbs_Cache_Save($CacheFile,$this->Source) ;
			} elseif ($TimeOut === TBS_DELETE) {
				if (file_exists($CacheFile)) {
					@unlink($CacheFile) ;
				}
			} elseif($TimeOut>=0) {
				$Res = tbs_Cache_IsValide($CacheFile,$TimeOut) ;
				if ($Res==True) { //Load the cache
					$this->_CacheFile = False ;
					tbs_Misc_GetFile($this->Source,$CacheFile) ;
					if (($this->Render & TBS_OUTPUT) == TBS_OUTPUT) echo($this->Source) ;
					if (($this->Render & TBS_EXIT) == TBS_EXIT) Exit ;
				} else {
					//The result will be saved in the cache when the Show() method is called
					$this->_CacheFile = $CacheFile ;
					@touch($CacheFile);
				}
			}
		}

		return $Res ;

	}
	//Hidden functions
	function DebugPrint($Txt) {
		if ($Txt===False) {
			$this->_DebugTxt = '' ;
		} else {
			$this->_DebugTxt .= 'Debug: '.htmlentities($Txt).'<br>' ;
		}
	}
	function DebugLocator($Name) {
		$this->_DebugTxt .= tbs_Misc_DebugLocator($this->Source,$Name) ;
	}
	//Only for compatibility
	function MergePHPVar() {
		tbs_Merge_Special($this->Source,'var',True) ;
	}
}

//*******************************************************

//Find a TBS Field-Merge
function tbs_Locator_FindTbs(&$Txt,$Name,$ChrSubName,$PosBeg=False,$Forward=True) {
	global $tbs_ChrOpen ;
	global $tbs_ChrClose ;
	return tbs_Locator_FindAny($Txt,$tbs_ChrOpen,$Name,$ChrSubName,';','= ','\'','([{',')]}',$tbs_ChrClose,$PosBeg,$Forward,False) ;
}

function tbs_Locator_FindAny(&$Txt,$ChrBeg,$LocName,$ChrSubName,$ChrsPrm,$ChrsEqu,$ChrsStr,$ChrsOpen,$ChrsClose,$ChrEnd,$PosBeg=False,$Forward=True,$PrmPos=False) {

	//Default value for the starting position
	if ($Forward) {
		if ($PosBeg===False) {
			$PosOpen = - 1 ;
		} else {
			$PosOpen = $PosBeg - 1 ;
		}
	} else {
		if ($PosBeg===False) {
			$PosOpen = strlen($Txt) + 1 ;
		} else {
			$PosOpen = $PosBeg + 1 ;
		}
	}

	$PrmLst = array() ;
	$PosEnd = False ;
	$SubName = False ;

	do {

		//Search for the opening char
		if ($Forward) {
			$PosOpen = strpos($Txt,$ChrBeg,$PosOpen + 1) ;
		} else {
			if ($PosOpen<=0) {
				$PosOpen = False ; //enables to not fall in an infinit loop if the BegChr is the first char of the string
			} else {
				$PosOpen = strrpos(substr($Txt,0,$PosOpen - 1),$ChrBeg) ;
			}
		}

		//If found => the next char are analyzed
		if ($PosOpen!==False) {
			//Look if what is next the begin char is the name of the locator
			if (strcasecmp(substr($Txt,$PosOpen+1,strlen($LocName)),$LocName)===0) {

				//Then we check if what is next the name of the merge is an expected char
				$ReadPrm = False ;
				$PosX = $PosOpen + 1 + strlen($LocName) ;
				$x = $Txt[$PosX] ;

				if ($x===$ChrEnd) {
					$PosEnd = $PosX ;
				} elseif ($ChrSubName===$x) {
					$SubName = '' ; //is is no longer the false value
					$ReadPrm = True ;
					$PosX++ ;
				} elseif (strpos($ChrsPrm,$x)!==False) {
					$ReadPrm = True ;
					$PosX++ ;
				}

				if ($ReadPrm) {
					//Read the Parameters
					tbs_Locator_ReadPrm($Txt,$PosX,$ChrsPrm,$ChrsEqu,$ChrsStr,$ChrsOpen,$ChrsClose,$ChrEnd,0,$PrmLst,$PosEnd,$SubName,$PrmPos) ;
					if (array_key_exists('comm',$PrmLst)) { //Enlarge the limits to the comentary bounds.
						tbs_Locator_EnlargeToStr($Txt, $PosOpen, $PosEnd, '<!--' ,'-->') ;
					}
				}

			}
		}

	} while ( ($PosEnd===False) and ($PosOpen!==False) ) ;

	if ($PosEnd===False) {
		return False ;
	} else {
		$Loc = new clsTbsLocator ;
		$Loc->PosBeg = $PosOpen ;
		$Loc->PosEnd = $PosEnd ;
		$Loc->PrmLst = $PrmLst ;
		$Loc->PrmPos = $PrmPos ;
		if ($SubName===False) {
			$Loc->FullName = $LocName ;
		} else {
			$Loc->FullName = $LocName.$ChrSubName.$SubName ;
			$Loc->SubName = $SubName ;
		}
		return $Loc ;
	}

}

//This function reads the parameters that follow the Begin Position and returns the parmeters in an array
function tbs_Locator_ReadPrm(&$Txt,$PosBeg,$ChrsPrm,$ChrsEqu,$ChrsStr,$ChrsOpen,$ChrsClose,$ChrEnd,$LenMax,&$PrmLst,&$PosEnd,&$SubName,&$PrmPos) {
//$PosBeg    : position in $Txt where the scan begins
//$ChrsPrm   : a string that contains all characters that can be a parameter separator (typically : space and ;)
//$ChrsEqu   : a string that contains all characters that can be a equale symbole (used to get prm value )
//$ChrsStr   : a string that contains all characters that can be a string delimiters (typically : ' and ")
//$ChrsOpen  : a string that contains all characters that can be an opening bracket (typically : ( )
//$ChrsClose : a string that contains all characters that can be an closing bracket (typically : ( )
//$ChrEnd    : the character that marks the end of the parameters list.
//$LenMax    : the maximum of characters to read (enable to not read all the dicument when the parameters list has an unvalide syntaxe).
//Return values :
//$PrmLst  : the array that contains all prm name as keys and prm value as value.
//$PosEnd  : the position of the $ChrEnd in the $Txt string
//$SubName : the subname found value if asked (to search for a subname, set $SubName to any value but False)
//$PrmPos  : the array that contains all prm positions if asked (relative to $Txt). To fill this variable, it has to be set to any value but False.

	// variables initalisation
	$PosCur = $PosBeg ;         // The cursor position
	$PosBuff = True ;           // True if the current char has to be added to the buffer
	$PosEnd = False ;          // True if the end char has been met
	$PosMax = strlen($Txt)-1 ; // The max position that the cursor can go
	if ($LenMax>0) {
		if ($PosMax>$PosDeb+$LenMax) {
			$PosMax = $PosDeb+$LenMax ;
		}
	}

	if ($PrmPos!==False) {
		$PrmPos = array() ;
	}

	$PrmNbr = 0 ;
	$PrmLst = array() ;
	$PrmName = '' ;
	$PrmBuff = '' ;
	$PrmPosBeg = False ;
	$PrmPosEnd = False ;
	$PrmEnd  = False ;
	$PrmPosEqu  = False ;     //Position of the first equal symbole
	$PrmChrEqu  = '' ;    //Position of the first equal symbole
	$PrmCntOpen = 0 ;     //Number of bracket inclusion. 0 means no bracket encapuslation.
	$PrmIdxOpen = False ; //Index of the current opening bracket in the $ChrsOpen array. False means we are not inside a bracket.
	$PrmCntStr = 0 ;      //Number of string delimiter found.
	$PrmIdxStr = False ;  //Index of the current string delimiter. False means we are not inside a string.
	$PrmIdxStr1 = False ; //Save the first string delimiter found.

	do {

		if ($PosCur>$PosMax) return ;

		if ($PrmIdxStr===False) {

			// we are not inside a string, we check if it's the begining of a new string
			$PrmIdxStr = strpos($ChrsStr,$Txt[$PosCur]) ;

			if ($PrmIdxStr===False) {
				//we are not inside a string, we check if we are not inside brackets
				if ($PrmCntOpen===0) {
					//we are not inside brackets 
					if ($Txt[$PosCur]===$ChrEnd) {//we check if it's the end of the parameters list
						$PosEnd = $PosCur ;
						$PrmEnd = True ;
						$PosBuff = False ;
					} elseif (strpos($ChrsEqu,$Txt[$PosCur])!==False) { //we check if it's an equale symbole
					  if ($PrmPosEqu===False) {
							if (trim($PrmBuff)!=='') {
								$PrmPosEqu = $PosCur ;
								$PrmChrEqu = $Txt[$PosCur] ;
							}
						} elseif ($PrmChrEqu===' ') {
							if ($PosCur==$PrmPosEqu+1) {
								$PrmPosEqu = $PosCur ;
								$PrmChrEqu = $Txt[$PosCur] ;
							}
						}
					} elseif (strpos($ChrsPrm,$Txt[$PosCur])!==False) { //we check if it's a parameter separator
						$PosBuff = False ;
						if ($Txt[$PosCur]===' ') {//The space char can be a parameter separator only in HTML locators
							if ($PrmBuff!=='') {
								$PrmEnd = True ;
							}
						} else { //-> if ($Txt[$PosCur]===' ') {...
							//We have a ';' separator
							$PrmEnd = True ;
						}
					} else {
						//check if it's an opening bracket
						$PrmIdxOpen = strpos($ChrsOpen,$Txt[$PosCur]) ; 
						if ($PrmIdxOpen!==False) {
							$PrmCntOpen++ ;
						}
					}
				} else { //--> if ($PrmCntOpen==0)
					//we are inside brackets, we have to check if there is another opening bracket or a closing bracket
					if ($Txt[$PosCur]===$ChrsOpen[$PrmIdxOpen]) {
						$PrmCntOpen++ ;
					} elseif ($Txt[$PosCur]===$ChrsClose[$PrmIdxOpen]) {
						$PrmCntOpen-- ;
					}
				}
			} else { //--> if ($IdxStr===False)
				//we meet a new string
				$PrmCntStr++ ; //count the number of string delimiter meet for the current parameter
				if ($PrmCntStr===1) $PrmIdxStr1=$PrmIdxStr ; //save the first delimiter for the current parameter
			} //--> if ($IdxStr===False)

		} else { //--> if ($IdxStr===False)

			//we are inside a string, 

			if ($Txt[$PosCur]===$ChrsStr[$PrmIdxStr]) {//we check if we are on a char delimiter
				if ($PosCur===$PosMax) {
					$PrmIdxStr = False ;
				} else {
					//we check if the next char is also a string delimiter, is it's so, the string continue
					if ($Txt[$PosCur+1]===$ChrsStr[$PrmIdxStr]) {
						$PosCur++ ; // the string continue
					} else {
						$PrmIdxStr = False ; //the string ends
					}
				}
			}

		} //--> if ($IdxStr===False)

		//Check if it's the end of the scan
		if ($PosEnd===False) {
			if ($PosCur>=$PosMax) {
				$PosEnd = $PosCur ; //end of the scan
				$PrmEnd = True ;
			}
		} 
 
		//Add the current char to the buffer
		if ($PosBuff) {
			$PrmBuff .= $Txt[$PosCur] ;
			if ($PrmPosBeg===False) $PrmPosBeg = $PosCur ;
			$PrmPosEnd = $PosCur ;
		} else {
			$PosBuff = True ;
		}

		//analyze the current parameter
		if ($PrmEnd===True) {
			if (strlen($PrmBuff)>0) {
				if ( ($PrmNbr===0) and ($SubName!==False) ) {
					//Set the SubName value
					$SubName = strtolower($PrmBuff) ;
					$PrmEquMode = 0 ;
				} else {
					if ($PrmPosEqu===False) {
						$PrmName = trim($PrmBuff) ;
						$PrmBuff = True ;
					} else {
						$PrmName = trim(substr($PrmBuff,0,$PrmPosEqu-$PrmPosBeg)) ;
						$PrmBuff = trim(substr($PrmBuff,$PrmPosEqu-$PrmPosBeg+1)) ;
						//If the buffer is between two string delimiters, then we get them off
						if ($PrmCntStr===1) {
							if ( $PrmBuff[0]===$ChrsStr[$PrmIdxStr1] ) {
								if ( $PrmBuff[strlen($PrmBuff)-1] === $ChrsStr[$PrmIdxStr1] ) {
									$PrmBuff = substr($PrmBuff,1,strlen($PrmBuff)-2) ;
								}
							}
						}
					}
					$PrmLst[$PrmName] = $PrmBuff ;
				}
				$PrmNbr++ ; // Usefulle for subname identification
				$PrmBuff = '' ;
				$PrmPosBeg = False ;
				$PrmCntStr = 0 ;
				$PrmCntOpen = 0 ;
				$PrmIdxStr = False ;
				$PrmIdxOpen = False ;
				$PrmPosEqu = False ;
			}
			$PrmEnd  = False ;
		}

		// next char
		$PosCur++ ;

	} while ($PosEnd===False) ;

}

//This function enables to enlarge the pos limits of the Locator.
//If the search result is not correct, $PosBeg must not change its value, and $PosEnd must be False.
//This is because of the calling function.
function tbs_Locator_EnlargeToStr(&$Txt,&$PosBeg,&$PosEnd,$StrBeg,$StrEnd) {

	if ($PosEnd===False) {
		return ;
	}

	//Searche for the begining string
	$PosX = $PosBeg ;
	$Ok = False ;
	do {
		$PosX = strrpos(substr($Txt,0,$PosX),$StrBeg[0]) ;
		if ($PosX!==False) {
			if (substr($Txt,$PosX,strlen($StrBeg))===$StrBeg) {
				$Ok = True ;
			}
		}
	} while ( (!$Ok) and ($PosX!==False) );

	if ($Ok===False) {
		$PosEnd = False ;
	} else {
		//Search for the endinf string
		$PosEnd = strpos($Txt,$StrEnd,$PosEnd + 1) ;
		if ($PosEnd!==False) {
			$PosBeg = $PosX ;
			$PosEnd = $PosEnd + strlen($StrEnd) - 1 ; 
		}
	}

}

function tbs_Locator_EnlargeToTag(&$Txt,&$Loc,$Tag,$MakeBlock,$Encaps,$Extend,$ReturnSrc) {
	
	if ($Tag==='') return False ; 
	if ($Tag==='row') $Tag = 'tr' ;
	if ($Tag==='opt') $Tag = 'option' ;

	$Ok = False ;

	$TagO = tbs_Html_FindTag($Txt,$Tag,True,$Loc->PosBeg-1,False,$Encaps,False) ;
	if ($TagO!==False) {
		//Search for the closing tag
		$TagC = tbs_Html_FindTag($Txt,$Tag,False,$Loc->PosEnd+1,True,$Encaps,False) ;
		if ($TagC!==False) {
			//It's ok, we get the text string between the locators (including the locators !!)
			$Ok = True ;
			$PosBeg = $TagO->PosBeg ;
			$PosEnd = $TagC->PosEnd ;
			//Extend

			if ($Extend===0) { 
				if ($ReturnSrc) {
					$Ok = '' ;
					if ($Loc->PosBeg>$TagO->PosEnd) $Ok .= substr($Txt,$TagO->PosEnd+1,min($Loc->PosBeg,$TagC->PosBeg)-$TagO->PosEnd-1) ;
					if ($Loc->PosEnd<$TagC->PosBeg) $Ok .= substr($Txt,max($Loc->PosEnd,$TagO->PosEnd)+1,$TagC->PosBeg-max($Loc->PosEnd,$TagO->PosEnd)-1) ;
				}
			} else { //Forward
				$TagC = True ;
				for ($i=$Extend;$i>0;$i--) {
					if ($TagC!==False) {
						$TagO = tbs_Html_FindTag($Txt,$Tag,True,$PosEnd+1,True,1,False) ;
						if ($TagO!==False) {
							$TagC = tbs_Html_FindTag($Txt,$Tag,False,$TagO->PosEnd+1,True,0,False) ;
							if ($TagC!==False) {
								$PosEnd = $TagC->PosEnd ;
							}
						}
					}
				}
				$TagO = True ;
				for ($i=$Extend;$i<0;$i++) { //Backward
					if ($TagO!==False) {
						$TagC = tbs_Html_FindTag($Txt,$Tag,False,$PosBeg-1,False,1,False) ;
						if ($TagC!==False) {
							$TagO = tbs_Html_FindTag($Txt,$Tag,True,$TagC->PosBeg-1,False,0,False) ;
							if ($TagO!==False) {
								$PosBeg = $TagO->PosBeg ;
							}
						}
					}
				}
			} //-> if ($Extend!==0) {
			if ($MakeBlock) {
				if ($Loc->SubName===False) {
					//If there is no subname then it's an relative syntax -> we delete the block definition
					$x = substr($Txt,$PosBeg,$Loc->PosBeg - $PosBeg) ;
					$x = $x . substr($Txt,$Loc->PosEnd+1,$PosEnd - $Loc->PosEnd) ;
				} else {
					//If there is a subname then it's a simplified syntax -> we let the field-locator.
					$x = substr($Txt,$PosBeg,$PosEnd - $PosBeg + 1) ;
				}
				$Loc->BlockNbr = 1 ; //Type=Block
				$Loc->BlockLst[1] = $x ;
			}
			$Loc->PosBeg = $PosBeg ;
			$Loc->PosEnd = $PosEnd ;
		}
	}

	return $Ok ;

}

//This function enables to merge a locator with a text and returns the position just after the replaced block
//This position can be usefull because we don't know in advance how $Value will be replaced.
function tbs_Locator_Replace(&$Txt,&$Loc,&$Value,$HtmlConv=True)
{
	if ($Loc===False) return False ;

	global $tbs_CurrVal,$tbs_ChrOpen,$tbs_ChrProtect ;

	$CurrValSave = $tbs_CurrVal ; //Save value in order to restore it at the end. This is uselfull for field inclusion.
	$tbs_CurrVal = $Value ;

	$Select = False ;

	if ($Loc->BlockNbr==0) { //Type=field

		$Script = True ; //False to ignore script execution
		$BrConv = True ; //True if we have to convert nl to br with Html conv.
		$WhiteSp = False ; //True if we have to preserve whitespaces
		$EmbedVal = False ; //Value to embed in the current val
		$Protect = True ; //Default value for common field

		//File inclusion
		if (array_key_exists('file',$Loc->PrmLst)) {
			$File = $Loc->PrmLst['file'] ;
			tbs_Misc_ReplaceVal($File,$tbs_CurrVal) ;
			tbs_Merge_PhpVar($File,False) ; //The file definition may contains PHPVar field
			$OnlyBody = True ;
			if (array_key_exists('htmlconv',$Loc->PrmLst)) {
				if (strtolower($Loc->PrmLst['htmlconv'])==='no') {
					$OnlyBody = False ; //It's a text file, we don't get the BODY part
				}
			}
			tbs_Misc_GetFile($tbs_CurrVal,$File) ;
			if ($OnlyBody) $tbs_CurrVal = tbs_Html_GetPart($tbs_CurrVal,'BODY',False,True) ;
			$HtmlConv = False ;
			$Protect = False ; //Default value for file inclusion
		}

		//OnFomat event
		if (array_key_exists('onformat',$Loc->PrmLst)) {
			$OnFormat = $Loc->PrmLst['onformat'] ;
			if (function_exists($OnFormat)) {
				$OnFormat($Loc->FullName,$tbs_CurrVal) ;
			} else {
				tbs_Misc_Alert('Error','Event OnFormat','The function \''.$OnFormat.'\' specified in the field \''.$Loc->FullName.'\' doesn\'t exist.') ;
			}
		}

		//Date/Time or Numeric Format
		if (array_key_exists('frm',$Loc->PrmLst)) {
			$tbs_CurrVal = tbs_Misc_Format($tbs_CurrVal,$Loc->PrmLst['frm']) ;
			$HtmlConv = False ;
		} else {
			if (!is_string($tbs_CurrVal)) $tbs_CurrVal = strval($tbs_CurrVal) ;
		}

		//case of an 'if' 'then' 'else' options
		if (array_key_exists('if',$Loc->PrmLst)) {
			tbs_Misc_ReplaceVal($Loc->PrmLst['if'],$tbs_CurrVal) ;
			if (tbs_Misc_CheckCondition($Loc->PrmLst['if'])===True) {
				if (array_key_exists('then',$Loc->PrmLst)) {
					$EmbedVal = $tbs_CurrVal ;
					$tbs_CurrVal = $Loc->PrmLst['then'] ;
				} //else -> it's the given value
			} else {
				$Script = False ;
				if (array_key_exists('else',$Loc->PrmLst)) {
					$EmbedVal = $tbs_CurrVal ;
					$tbs_CurrVal = $Loc->PrmLst['else'] ;
				} else {
					$tbs_CurrVal = '' ;
					$Protect = False ; //Only because it is empty
				}
			}
		}

		if ($Script) {//Include external PHP script
			if (array_key_exists('script',$Loc->PrmLst)) {
				$File = $Loc->PrmLst['script'] ;
				tbs_Misc_ReplaceVal($File,$tbs_CurrVal) ;
				tbs_Merge_PhpVar($File,False) ; //The file definition may contains PHPVar field
        if (array_key_exists('getob',$Loc->PrmLst)) ob_start() ;
				if (array_key_exists('once',$Loc->PrmLst)) {
					include_once($File) ;
				} else {
					include($File) ;
				}
        if (array_key_exists('getob',$Loc->PrmLst)) {
          $tbs_CurrVal = ob_get_contents() ;
          ob_end_clean() ;
        }
				$HtmlConv = False ;
			}
		}

		//MaxLength
		if (array_key_exists('max',$Loc->PrmLst)) {
			$max = intval($Loc->PrmLst['max']) ;
			if (strlen($tbs_CurrVal)>$max) {
				$tbs_CurrVal = substr($tbs_CurrVal,0,$max-1).'...' ;
			}
		}

		//Check HtmlConv parameter
		if (array_key_exists('htmlconv',$Loc->PrmLst)) {
			$x = strtolower($Loc->PrmLst['htmlconv']) ;
			switch ($x) {
			case 'no'  : $HtmlConv = False ; break ;
			case 'yes' : $HtmlConv = True  ; break ;
			case 'nobr': $HtmlConv = True  ; $BrConv = False ; break ;
			case 'esc' : $HtmlConv = False ; $tbs_CurrVal = str_replace('\'','\'\'',$tbs_CurrVal) ; break ;	
			case 'wsp' : $HtmlConv = True  ; $WhiteSp = True ; break ;
			case 'look':
				if (tbs_Html_IsHtml($tbs_CurrVal)) {
					$HtmlConv = False ;
					$tbs_CurrVal = tbs_Html_GetPart($tbs_CurrVal,'BODY',False,True) ;
				} else {
					$HtmlConv = False ;
				}
				break ;
			}
		}

		//HTML conversion
		if ($HtmlConv) {
			tbs_Html_Conv($tbs_CurrVal,$BrConv,$WhiteSp) ;
			if ($EmbedVal!==False) tbs_Html_Conv($EmbedVal,$BrConv,$WhiteSp) ;
		}

		//We protect the data that does not come from the source of the template
		//Explicit Protect parameter
		if (array_key_exists('protect',$Loc->PrmLst)) {
			$x = strtolower($Loc->PrmLst['protect']) ;
			switch ($x) {
			case 'no' : $Protect = False ; break ;
			case 'yes': $Protect = True  ; break ;
			}
		}
		if ($Protect) {
			if ($EmbedVal===False) {
				$tbs_CurrVal = str_replace($tbs_ChrOpen,$tbs_ChrProtect,$tbs_CurrVal) ;
			} else {
				//We must not protec the data wich comes from the source of the template, only the embeded value
				$EmbedVal = str_replace($tbs_ChrOpen,$tbs_ChrProtect,$EmbedVal) ;
				tbs_Misc_ReplaceVal($tbs_CurrVal,$EmbedVal) ;
			}
		}
					
		//Case when it is an empty string
		if ($tbs_CurrVal==='') {
			if (array_key_exists('.',$Loc->PrmLst)) {
				$tbs_CurrVal = '&nbsp;' ; //Enables to avoid blanks in HTML tables
			} elseif (array_key_exists('ifempty',$Loc->PrmLst)) {
				$tbs_CurrVal = $Loc->PrmLst['ifempty'] ;
			}
		}

		//Select a value in a HTML option list
		if (array_key_exists('selected',$Loc->PrmLst)) {
			$Select = True ;
		}

	} //-> if ($Loc->BlockNbr==0)

	//Friend option (for blocks and fields) 
	if ($tbs_CurrVal==='') {
		if (array_key_exists('friendb',$Loc->PrmLst)) {
			$Loc2 = tbs_Html_FindTag($Txt,$Loc->PrmLst['friendb'],True,$Loc->PosBeg,False,1,False,False) ;
			if ($Loc2!==False) {
				$Loc->PosBeg = $Loc2->PosBeg ;
				if ($Loc->PosEnd<$Loc2->PosEnd) $Loc->PosEnd = $Loc2->PosEnd ;
			}
		}
		if (array_key_exists('frienda',$Loc->PrmLst)) {
			$Loc2 = tbs_Html_FindTag($Txt,$Loc->PrmLst['frienda'],True,$Loc->PosBeg,True,1,False,False) ;
			if ($Loc2!==False) $Loc->PosEnd = $Loc2->PosEnd ;
		}
		if (array_key_exists('friend',$Loc->PrmLst)) {
			tbs_Locator_EnlargeToTag($Txt,$Loc,$Loc->PrmLst['friend'],False,1,0,False) ;
		}
		if (array_key_exists('friend2',$Loc->PrmLst)) {
			$tbs_CurrVal = tbs_Locator_EnlargeToTag($Txt,$Loc,$Loc->PrmLst['friend2'],False,1,0,True) ;
		}
	}

	$Txt = substr_replace($Txt,$tbs_CurrVal,$Loc->PosBeg,$Loc->PosEnd-$Loc->PosBeg+1) ;

	if ($Select) { //Select a value in a HTML option list
		tbs_Html_MergeOptionList($Txt,$Loc->PosBeg,$tbs_CurrVal) ;
	}

	$x = $Loc->PosBeg + strlen($tbs_CurrVal) ; //Value to return
	$tbs_CurrVal = $CurrValSave ; //Restore saved value. This is uselfull for field inclusion.

	return $x ;

}

//Look for the next block definition locator. Return the locator and its type.
function tbs_Locator_FindBlockDef(&$Txt,$BlockName,$PosBeg,$OnlyType=False) {
//If $OnlyType<>False then the function look for the locator that is of the specific type

	$Ok = False ;
	$Pos = $PosBeg ;

	do {

		$Loc = tbs_Locator_FindTbs($Txt,$BlockName,'.',$Pos,True) ;

		if ($Loc!==False) {
			$Ok = True ;
			$Pos = $Loc->PosEnd + 1 ;
			//The locator is a field locator but it may contain a block definition
			if (array_key_exists('block',$Loc->PrmLst)) {
				$Loc->PrmLst['block'] = trim(strtolower($Loc->PrmLst['block'])) ;
				if ($OnlyType!==False) {
					if ($Loc->PrmLst['block']<>$OnlyType) {
						$Ok = False ;
					}
				}
			} else {
				$Ok = False ;
			}
		}

	} while ( ($Ok===False) and ($Loc!==False) ) ;

	if ($Ok) {
		return $Loc ;
	} else {
		return False ;
	}

}

//Return the first block locator object just after the PosBeg position
function tbs_Locator_FindBlock1(&$Txt,$BlockName,$PosBeg) {

	$Loc = tbs_Locator_FindBlockDef($Txt,$BlockName,$PosBeg,False) ;

	if ($Loc!==False) {

		if ($Loc->PrmLst['block']==='begin') {
			//Case of a begin-end 
			$Loc2 = tbs_Locator_FindBlockDef($Txt,$BlockName,$Loc->PosEnd+1,'end') ;
			if ($Loc2===False) {
				return False ;
		  } else {
				//It's ok, we get the source between the locators (without the bound locators).
				$Loc->BlockNbr = 1 ;
				$Loc->BlockLst[1] = substr($Txt,$Loc->PosEnd+1,$Loc2->PosBeg - $Loc->PosEnd - 1) ;
				$Loc->PosEnd = $Loc2->PosEnd ;
			}
		} else {
			if (array_key_exists('encaps',$Loc->PrmLst)) {
				$Encaps = abs(intval($Loc->PrmLst['encaps'])) ;
			} else {
				$Encaps = 1 ;
		  }
			if (array_key_exists('extend',$Loc->PrmLst)) {
				$Extend = intval($Loc->PrmLst['extend']) ;
			} else {
				$Extend = 0 ;
			}
			$Ok = tbs_Locator_EnlargeToTag($Txt,$Loc,$Loc->PrmLst['block'],True,$Encaps,$Extend,False) ;
			if ($Ok===False) $Loc = False ;
		}

	} //-->if ($Loc1!==False)

	return $Loc ;

}

//Returns a locator object which points on a block wich covers all the block definitions, and contains all the text to merge
//Returns a locator even if there is no block definition found.
function tbs_Locator_FindBlockLst(&$Txt,$BlockName) {

	$Pos = 0 ;
	
	$LocR = new clsTbsLocator ;
	$LocR->DefFound = False ;
	$LocR->BlockNbr = 0 ;
	$LocR->HeaderNbr = 0 ;
	$LocR->FooterNbr = 0 ;
	$LocR->Serial = array() ;
	$LocR->EmptySrc = False ;
	$LocR->PrmLst = array() ;
	$LocR->NoDataSrc = False ;

	do {
		$Loc = tbs_Locator_FindBlock1($Txt,$BlockName,$Pos) ;
		if ($Loc!==False) {
			if (($LocR->DefFound!==False) and array_key_exists('p1',$Loc->PrmLst)) {
				$Loc = False ; //Stop the list feed
			} else {
  			$Pos = $Loc->PosEnd + 1 ;
  			//Define the block limits
  			if ($LocR->DefFound===False) {
  				$LocR->DefFound = True ;
  				$LocR->PosBeg = $Loc->PosBeg ;
  				$LocR->PosEnd = $Loc->PosEnd ;
  			} else {
  				if ( $LocR->PosBeg > $Loc->PosBeg ) $LocR->PosBeg = $Loc->PosBeg ;
  				if ( $LocR->PosEnd < $Loc->PosEnd ) $LocR->PosEnd = $Loc->PosEnd ;
  			}
  			//Merge block parameters
  			if (count($Loc->PrmLst)>0) $LocR->PrmLst = array_merge($LocR->PrmLst,$Loc->PrmLst) ;
  			//Add the text int the list of blocks
  			if (array_key_exists('nodata',$Loc->PrmLst)) {
  				$LocR->NoDataSrc = $Loc->BlockLst[1] ;
  			} elseif (array_key_exists('headergrp',$Loc->PrmLst)) {
  				$LocR->HeaderNbr++ ;
  				$LocR->HeaderLst[$LocR->HeaderNbr] = array(0=>$Loc->BlockLst[1],1=>strtolower($Loc->PrmLst['headergrp']),2=>False) ;
  			} else {
  				$LocR->BlockNbr++ ;
  				$LocR->BlockLst[$LocR->BlockNbr] = $Loc->BlockLst[1] ;
  				$LocR->Serial[$LocR->BlockNbr] = array_key_exists('serial',$Loc->PrmLst) ;
  				//Look for the empty sub-block definition
  				if ($LocR->Serial[$LocR->BlockNbr]) {
  					$LocSub = tbs_Locator_FindBlock1($Loc->BlockLst[1],$BlockName.'_0',0) ;
  					if ($LocSub!==False) {
  						$LocR->EmptySrc = $LocSub->BlockLst[1] ; //Save the empty sub-block source and delete it from its parent block source.
  						$LocR->BlockLst[$LocR->BlockNbr] = substr($LocR->BlockLst[$LocR->BlockNbr],0,$LocSub->PosBeg).substr($LocR->BlockLst[$LocR->BlockNbr],$LocSub->PosEnd+1) ;
  						$LocSub = tbs_Locator_FindBlock1($LocR->BlockLst[$LocR->BlockNbr],$BlockName.'_1',0) ;
  						if ($LocSub===False) $LocR->BlockNbr-- ; //If no other sub-block then we delete the block from the list
  					}
  				}
  			}
			}
		}
	} while ($Loc!==False) ;

	if ($LocR->DefFound===False) {
		$LocR->PosBeg = 0 ;
		$LocR->PosEnd = strlen($Txt) - 1 ;
		$LocR->BlockNbr = 1 ;
		$LocR->BlockLst[1] = $Txt ;
		$LocR->Serial[1] = False ;
	}

	return $LocR ;

}

//Merge all the occurences of a field-locator in the text string
//Returns the number of fields found.
function tbs_Merge_Field(&$Txt,$FieldName,$Value,$HtmlConv=True) {

	$PosBeg = 0 ; //The current position is managed in order to avoid unlimited loops. Unlimited loops can happen at the fields initialisation.
	$Nbr = 0 ;

	do {
		$Loc = tbs_Locator_FindTbs($Txt,$FieldName,'',$PosBeg) ;
		if ($Loc!==False) {
			$PosBeg = tbs_Locator_Replace($Txt,$Loc,$Value,$HtmlConv) ;
			$Nbr++ ;
		}
	} while ($Loc!==False) ;

	return $Nbr ;

}

function tbs_Merge_Block(&$Txt,$BlockName,$SrcId,$Query='',$HtmlConv=True,$PageSize=0,$PageNum=0,$RecKnown=0) {

	global $tbs_CurrRec ;
	
	$RowTot = 0 ;
	$SubChr = '_' ;
	$Query0 = False ; //a not False value means they are parameters
	$CurrRecSave = $tbs_CurrRec ;

	//Get source type and info
	$SrcType = False ;
	$SrcSubType = False ;
	$RecSet = True ; //Must be true for first loop
	$RecInfo = False ;
	tbs_Data_Prepare($SrcId,$SrcType,$SrcSubType,$RecInfo) ;
	if ($SrcType===False) return 0 ;

	do {

		$RowNum = 0 ;  //Number of row merged
		$RowStop = 0 ; //Stop the merge after this row
		$Groups = False ; //True if there is Hearder Group definitions
		$OnFormat = False ;

		//Search the block
		$BlockLoc = tbs_Locator_FindBlockLst($Txt,$BlockName) ;

		if ($BlockLoc->DefFound===False) {
			$RowStop = 1 ; //Merge only the first record
		} else {
			//Save the query definition
			if ($Query0===False) {
				if (array_key_exists('p1',$BlockLoc->PrmLst)) $Query0 = $Query ;
			}
		}
		
		//Replace parameters
		if ($Query0!==False) {
			if ($BlockLoc->DefFound===False) {
				$Query0 = False ; //End of the loop
				$RecSet = False ;
			} else {
				$Query = $Query0 ;
				$i = 1 ;
				do {
					$x = 'p'.$i ;
					if (array_key_exists($x,$BlockLoc->PrmLst)) {
						$Query = str_replace('%p'.$i.'%',$BlockLoc->PrmLst[$x],$Query) ;
						$i++ ;
					} else {
						$i = False ;
					}
				} while ($i!==False) ;
			}
		}

		//Open the recordset
		if ($RecSet!==False) tbs_Data_Open($SrcId,$Query,$SrcType,$SrcSubType,$RecSet,$RecInfo) ;

		if ($RecSet!==False) {

		  //Check for OnFormat event
			if (array_key_exists('onformat',$BlockLoc->PrmLst)) {
				if (function_exists($BlockLoc->PrmLst['onformat'])) {
					$OnFormat = $BlockLoc->PrmLst['onformat'] ;
				} else {
					tbs_Misc_Alert('Error','MergeBlock','The OnFormat function \''.$BlockLoc->PrmLst['onformat'].'\' specified in the block \''.$BlockName.'\' is not found.') ;
				}
			}

			if ($SrcType===4) { //Special for Text merge
				if ($BlockLoc->DefFound===False) {
					tbs_Misc_Alert('Error','MergeBlock','Can\'t merge the block \''.$BlockName.'\' with text because the block definition is not found.') ;
				} else {
					$RowNum = 1 ;
					$tbs_CurrRec = False ;
					if ($OnFormat!==False) $OnFormat($BlockName,$tbs_CurrRec,$RecSet,$RowNum) ;
					tbs_Locator_Replace($Txt,$BlockLoc,$RecSet,False) ;
				}
			} else { //Other data source type
	
				tbs_Data_Fetch($SrcType,$RecSet,$RecInfo,$tbs_CurrRec,$RowNum) ;
		
				//Manage pages
				if ($PageSize>0) {
					//Calculate the page when the merge has to stop
					if ($PageNum>0) {
						$RowStop = $PageNum * $PageSize ;
					} else {
						$RowStop = 1 ;
					}
					//Pass the first pages
					$PageCnt = 1 ;
					while ($PageCnt<$PageNum) {
						$i = 1 ;
						while ($i<=$PageSize) {
							if ($tbs_CurrRec===False) {
								$i = $PageSize ;
								$PageCnt = $PageNum ;
							} else {
								tbs_Data_Fetch($SrcType,$RecSet,$RecInfo,$tbs_CurrRec,$RowNum) ;
								$i++ ;
							}
						}
						$PageCnt++ ;
					}
				}
		
				//Initialise
				if ($BlockLoc->HeaderNbr > 0) $Groups = True ;
				$BlockRes = '' ; // The result of the chained merged blocks
				$BlockSrc = '' ; // The current block source
				$i = 1 ;
				$SubId = 0 ;      //The current sub-block id (0 if no serial option)
				$SubDef = '' ;    //The current sub-block definition
				$SubLoc = False ; //The current sub-block locator
		
				//Main loop
				while($tbs_CurrRec!==False) {
		
					$tbs_CurrRec['#'] = $RowNum ;
		
					//Manage headers
					if ($Groups===True) {
						if ($RowNum===1) {
							$change = True ;
						} else {
							$change = False ;
						}
						for ($j=1 ; $j<=$BlockLoc->HeaderNbr ; $j++) {
							$val = $tbs_CurrRec[$BlockLoc->HeaderLst[$j][1]] ;
							if (!$change) {
								$change = !( $BlockLoc->HeaderLst[$j][2] === $val ) ;
							}
							if ($change) {
								$BlockSrc .= $BlockLoc->HeaderLst[$j][0] ;
								$BlockLoc->HeaderLst[$j][2] = $val ;
							}
						}
					}
		
					//Manage the detail section 
					if ($BlockLoc->Serial[$i]===True) {
						$SubId++ ;
						$SubLoc = tbs_Locator_FindBlock1($BlockSrc,$BlockName.$SubChr.$SubId,0) ;
						if ($SubLoc===False) {
							//Next main-block definition
							$BlockRes .= $BlockSrc ;
							$BlockSrc = '' ;
							$SubId = 0 ;
							$i++ ;
							if ($i>$BlockLoc->BlockNbr) $i = 1 ;
						}
					}

					if ($BlockLoc->Serial[$i]===False) {
						//Classic merge
						$BlockSrc .= $BlockLoc->BlockLst[$i] ;
						if ($OnFormat!==False) $OnFormat($BlockName,$tbs_CurrRec,$BlockSrc,$RowNum) ;
						tbs_Merge_List($BlockSrc,$BlockName,$tbs_CurrRec) ; //we merge the fields
						$BlockRes .= $BlockSrc ; //We add the block to the serial
						$BlockSrc = '' ;
						$i++ ;
						if ($i>$BlockLoc->BlockNbr) $i = 1 ;
					} else {
						//Merge with serial
						if ($SubLoc===False) {//False => it's a new main-block definition
							$BlockSrc = $BlockLoc->BlockLst[$i] ;
							$SubId = 1 ;
							$SubLoc = tbs_Locator_FindBlock1($BlockSrc,$BlockName.$SubChr.'1',0) ;
						}
						if ($SubLoc!==False) {
							$SubDef = $SubLoc->BlockLst[1] ;
							if ($OnFormat!==False) $OnFormat($BlockName,$tbs_CurrRec,$SubDef,$RowNum) ;
							tbs_Merge_List($SubDef,$BlockName.$SubChr.$SubId,$tbs_CurrRec) ; //we merge the fields
							tbs_Locator_Replace($BlockSrc,$SubLoc,$SubDef,False) ;
						}
					}

					//Next row
					if ($RowNum===$RowStop) {
						$tbs_CurrRec = False ;
					} else {
						if ($tbs_CurrRec!==False) { //$tbs_CurrRec can be set to False by the OnFormat event function.
							tbs_Data_Fetch($SrcType,$RecSet,$RecInfo,$tbs_CurrRec,$RowNum) ;
						}
					}

				} //--> while($tbs_CurrRec!==False) {

				//Serial: merge the extra the sub-blocks
				if (($BlockLoc->Serial[$i]===True) and ($SubId!==0)) {
					$tbs_CurrRec = False ;
					$j = $RowNum ; //Enable to have the fictive number of record in a varibale to pass by reference to $OnFormat.
					do {
						$SubId++ ;
						$j++ ;
						$SubLoc = tbs_Locator_FindBlock1($BlockSrc,$BlockName.$SubChr.$SubId,0) ;
						if ($SubLoc!==False) {
							if ($BlockLoc->EmptySrc===False) {
								$SubDef = $SubLoc->BlockLst[1] ;
								if ($OnFormat!==False) $OnFormat($BlockName,$tbs_CurrRec,$SubDef,$j) ;
								tbs_Merge_Clear($SubDef,$BlockName.$SubChr.$SubId) ;
							} else {
								$SubDef = $BlockLoc->EmptySrc ;
								if ($OnFormat!==False) $OnFormat($BlockName,$tbs_CurrRec,$SubDef,$j) ;
							}
							tbs_Locator_Replace($BlockSrc,$SubLoc,$SubDef,False) ;
						}
					} while ($SubLoc!==False) ;
					$BlockRes .= $BlockSrc ;
				}
		
				//Calculate the value to return
				if ($PageSize>0) {
					if ($RecKnown<0) {
						$tbs_CurrRec = True ;
						while($tbs_CurrRec!==False) {
							//Pass pages in order to count all records
							tbs_Data_Fetch($SrcType,$RecSet,$RecInfo,$tbs_CurrRec,$RowNum) ;
						}
					} else {
						if ($RowNum<$RowStop) {
							//the number of page was surestimated
						} else {
							if ($RecKnown>$RowNum) $RowNum = $RecKnown ; //We know that there is more records
						}
					}
				}
		
				//Special operation if no data				
				if ($RowNum===0) {
					if ($BlockLoc->DefFound===False) {
						$BlockRes = $BlockLoc->BlockLst[1] ;
					} else {	
						if ($BlockLoc->NoDataSrc!==False) $BlockRes = $BlockLoc->NoDataSrc ;
			  		if ($OnFormat!==False) {
			  			$tbs_CurrRec = False ;
			  			$OnFormat($BlockName,$tbs_CurrRec,$BlockRes,$RowNum) ;
			  		}
					}
				}
								
				//Merge the result
				tbs_Locator_Replace($Txt,$BlockLoc,$BlockRes,False) ; //The block must not be converted to HTML !!
	
			} //-> if ($SrcType===4) {...} else {...
	
			//Close the resource
			tbs_Data_Close($SrcType,$RecSet,$RecInfo) ;

		} //-> if ($RecSet!==False) {..
 
 		$RowTot += $RowNum ;
 
	} while ($Query0!==False) ;

	tbs_Merge_Field($Txt,$BlockName.'.#',$RowTot) ; //Merge the number of record for the entire template
 
	//End of the merge
	$tbs_CurrRec = $CurrRecSave ;
	return $RowTot ;

}

//Type : 0=PHP Array, 1=MySQL Resultset, 2=ODBC Resultset, 3=SQL-Server Resultset,4=Text,5=ADODB, 6=number, str=custom
function tbs_Data_Prepare(&$SrcId,&$SrcType,&$SrcSubType,&$RecInfo) {

	$Src = False ;
	$SrcType = False ;
	$SrcSubType = 0 ;

	if (is_array($SrcId)) {

		$SrcType = 0 ;

	} elseif (is_resource($SrcId)) {

		$Key = get_resource_type($SrcId) ;
		switch ($Key) {
		case 'mysql link'            : $SrcType = 1 ; break ;
		case 'mysql link persistent' : $SrcType = 1 ; break ;
		case 'mysql result'          : $SrcType = 1 ; $SrcSubType = 1 ; break ;
		case 'odbc link'             : $SrcType = 2 ; break ;
		case 'odbc link persistent'  : $SrcType = 2 ; break ;
		case 'odbc result'           : $SrcType = 2 ; $SrcSubType = 1 ; break ;
		case 'mssql link'            : $SrcType = 3 ; break ;
		case 'mssql link persistent' : $SrcType = 3 ; break ;
		case 'mssql result'          : $SrcType = 3 ; $SrcSubType = 1 ; break ;
		default : 
			$Src = 'ressource type' ;
			$SrcType = 7 ;
			$x = $Key ;
			$x = str_replace('-','_',$SrcSubType) ;
			$SrcSubType = '' ;
			$i = 0 ;
			$iMax = strlen($SrcSubType) ;
			while ($i<$iMax) {
				if (($x[$i]==='_') or (($x[$i]>='a') and ($x[$i]<='z')) or (($x[$i]>='0') and ($x[$i]<='9'))) {
					$SrcSubType .= $x[$i] ;
					$i++;
				} else {
					$i = $iMax ;
				}
			}
		}

	} elseif (is_string($SrcId)) {

		switch (strtolower($SrcId)) {
		case 'array' : $SrcType = 0 ; $SrcSubType = 1 ; break ;
		case 'clear' : $SrcType = 0 ; $SrcSubType = 2 ; break ;
		case 'mysql' : $SrcType = 1 ; $SrcSubType = 2 ; break ;
		case 'mssql' : $SrcType = 3 ; $SrcSubType = 2 ; break ;
		case 'text'  : $SrcType = 4 ; break ;
		case 'num'   : $SrcType = 6 ; break ;
		default :
			$Key = $SrcId ;
			$Src = 'keyword' ;
			$SrcType = 7 ;
			$SrcSubType = $SrcId ;
		}

	} elseif (is_object($SrcId)) {
		$Key = get_class($SrcId) ;
		if ($Key==='COM') {
			if (strlen(@$SrcId->ConnectionString())>0) { //Look if it's a Connection object
				if ($SrcId->State==1) {
					$SrcType = 5 ; //ADODB
				} else {
					tbs_Misc_Alert('Error','MergeBlock','The specified ADODB Connection is not open or not ready.') ;
				}
			} elseif (strlen(@$SrcId->CursorType())>0) { //Look if it's a RecordSet object
				if ($SrcId->State==1) {
					$SrcType = 5 ; //ADODB 
					$SrcSubType = 1 ;
				} else {
					tbs_Misc_Alert('Error','MergeBlock','The specified ADODB Recordset is not open or not ready.') ;
				}
			} else {
				tbs_Misc_Alert('Error','MergeBlock','The specified COM Object is not a Connection or a Recordset.') ;
			}
		} else {
			$Src = 'object type' ;
			$SrcType = 7 ;
			$SrcSubType = $Key ;
		}

	} else {
		tbs_Misc_Alert('Error','MergeBlock','Unsupported variable type : \''.gettype($SrcId).'\'.') ;
	}
	
	if ($SrcType===7) {
	  $SrcOpen  = 'tbsdb_'.$SrcSubType.'_open' ;
	  $SrcFetch = 'tbsdb_'.$SrcSubType.'_fetch' ;
	  $SrcClose = 'tbsdb_'.$SrcSubType.'_close' ;
	  if (function_exists($SrcOpen)) {
	    if (function_exists($SrcFetch)) {
	      if (function_exists($SrcClose)) {
	        $RecInfo = array('o'=>$SrcOpen,'f'=>$SrcFetch,'c'=>$SrcClose) ;
	      } else {
					tbs_Misc_Alert('Error','MergeBlock','The expected custom function \''.$SrcClose.'\' is not found.') ;
			  	$SrcType = False ;
	      }
	    } else {
	      tbs_Misc_Alert('Error','MergeBlock','The expected custom function \''.$SrcFetch.'\' is not found.') ;
		  	$SrcType = False ;
	    }
	  } else {
	    tbs_Misc_Alert('Error','MergeBlock','The data source Id \''.$Key.'\' is an unsupported '.$Src.'. And the corresponding custom function \''.$SrcOpen.'\' is not found.') ;
	  	$SrcType = False ;
	  }
	}
	
}

function tbs_Data_Open(&$SrcId,&$Query,&$SrcType,&$SrcSubType,&$RecSet,&$RecInfo) {

	switch ($SrcType) {
	case 0: //Array
		switch ($SrcSubType) {
			case 0: $RecSet = $SrcId ; break ;
			case 1: $RecSet = $Query ; break ;
			case 2: $RecSet = array() ; break ;
		}
		if (is_array($RecSet)) {
			$RecInfo = array('count'=>count($RecSet),'reset'=>True) ;
		} else {
			tbs_Misc_Alert('Error','MergeBlock','The parameters is not an array') ;
			$RecSet = False ;
		}
		break ;
	case 1: //MySQL
		switch ($SrcSubType) {
			case 0: $RecSet = @mysql_query($Query,$SrcId) ; break ;
			case 1: $RecSet = $SrcId ; break ;
			case 2: $RecSet = @mysql_query($Query) ; break ;
		}
		if ($RecSet===False) tbs_Misc_Alert('Error','MergeBlock','MySql: '.mysql_error()) ;
		break ;
	case 2: //ODBC
		switch ($SrcSubType) {
			case 0: $RecSet = @odbc_exec($SrcId,$Query) ; break ;
			case 1: $RecSet = $SrcId ; break ;
		}
		if ($RecSet===False) {
			tbs_Misc_Alert('Error','MergeBlock','ODBC: '.odbc_errormsg()) ;
		} else {
			$RecInfo = array() ;
			$iMax = odbc_num_fields($RecSet) ;
			for ($i=1;$i<=$iMax;$i++) {
				$RecInfo[$i] = ''.odbc_field_name($RecSet,$i) ;
			}
		}
		break ;
	case 3: //MsSQL
		switch ($SrcSubType) {
			case 0: $RecSet = @mssql_query($Query,$SrcId) ; break ;
			case 1: $RecSet = $SrcId ; break ;
			case 2: $RecSet = @mssql_query($Query) ; break ;
		}
		if ($RecSet===False) {
			tbs_Misc_Alert('Error','MergeBlock','SQL-Server: '.mssql_get_last_message()) ;
		}
		break ;
	case 4: //Text
		if (is_string($Query)) {
			$RecSet = $Query ;
		} else {
			$RecSet = ''.$Query ;	
		}
		break ;
	case 5: //ADODB
		switch ($SrcSubType) {
			case 0:
				$RecSet = @$SrcId->Execute($Query) ; //We use the Connection object reather than the Recordset object in order to manage errors
				if ($SrcId->Errors->Count>0) {
					tbs_Misc_Alert('Error','MergeBlock','ADODB: '.$SrcId->Errors[0]->Description) ;
					$RecSet = False ;
				} elseif (@$RecSet->State!=1) {
					tbs_Misc_Alert('Error','MergeBlock','The ADODB query doesn\'t return a RecordSet or the ResordSet is not ready.') ;
					$RecSet = False ;
				}
				break ;
			case 1:
				$RecSet = $SrcId ;
				break ;
		}
		if ($RecSet!==False) {
			$RecInfo = array() ;
			$iMax = $RecSet->Fields->Count ;
			for ($i=0;$i<$iMax;$i++) {
				$RecInfo[$i] = ''.$RecSet->Fields[$i]->Name ;
			}
		}
		break ;
	case 6: //Num
		$RecSet = ceil($Query) ;
		break ;
	case 7: //Custom function
		$RecSet = $RecInfo['o']($SrcId,$Query) ;
		break ;
	}	

}

function tbs_Data_Fetch(&$SrcType,&$RecSet,&$RecInfo,&$RowData,&$RowNum) {

	switch ($SrcType) {
	case 0: //Array
		if ($RowNum<$RecInfo['count']) {
			if ($RecInfo['reset']) {
				$RowData = reset($RecSet) ;
				$RecInfo['reset'] = False ;
			} else {
				$RowData = next($RecSet) ;
			}
			if (!is_array($RowData)) $RowData = array('key'=>key($RecSet), 'val'=>$RowData) ;
		} else {
			$RowData = False ;
		}
		break ;
	case 1: //MySQL
	  $RowData = mysql_fetch_assoc($RecSet) ;
		break ;
	case 2: //ODBC, odbc_fetch_array -> Error with PHP 4.1.1
		$RowData = odbc_fetch_row($RecSet) ;
		if ($RowData) {
			$RowData = array() ;
			foreach ($RecInfo as $colid=>$colname) {
				$RowData[$colname] = odbc_result($RecSet,$colid) ; 
			}
		}
		break ;
	case 3: //MsSQL
		$RowData = mssql_fetch_array($RecSet) ;
		break ;
	case 4: //Text
		if ($RowNum===0) {
			if ($RecSet==='') {
				$RowData = False ;
			} else {
				$RowData = &$RecSet ;
			}
		} else {
			$RowData = False ;
		}
		break ;
	case 5: //ADODB
	if ($RecSet->EOF()) {
			$RowData = False ;
		} else {
			$RowData = array() ;
			foreach ($RecInfo as $colid=>$colname) {
				$RowData[$colname] = $RecSet->Fields[$colid]->Value ;
			}
			$RecSet->MoveNext() ; //brackets () must be there
		}
		break ;
	case 6: //Num
		if ($RowNum>=$RecSet) {
			$RowData = False ;
		} else {
			$RowData = array() ;
		}
		break ;
	case 7: //Custom function
		$RowData = $RecInfo['f']($RecSet,$RowNum+1) ;
		break ;
	}	

	//Set the row count
	if ($RowData!==False) $RowNum++ ;

}

function tbs_Data_Close(&$SrcType,&$RecSet,&$RecInfo) {
  
  switch ($SrcType) {
  case 1: mysql_free_result($RecSet) ; break ;
  case 2: odbc_free_result($RecSet) ; break ;
  case 3: mssql_free_result($RecSet) ; break ;
  case 5: $RecSet->Close ; break ;
  case 7: $RecInfo['c']($RecSet) ; break ;
	}

}

//Merge a list with named items. Used by tbs_Merge_Block().
function tbs_Merge_List(&$Txt,$BlockName,$List,$HtmlConv=True) {
	if (count($List)==0) return ;
	foreach ($List as $key => $val) {
		tbs_Merge_Field($Txt,$BlockName.'.'.$key,$val,$HtmlConv) ;
	}
}


//Clear all fields.
function tbs_Merge_Clear(&$Txt,$BlockName,$HtmlConv=True) {
	do {
		$Loc = tbs_Locator_FindTbs($Txt,$BlockName,'.',0,True) ;
		if ($Loc!==False) {
			tbs_Merge_Field($Txt,$BlockName.'.'.$Loc->SubName,'',$HtmlConv) ;
		}
	} while ($Loc!==False) ;
}

//This function enables to merge a set of 'case' blocks.
//'case' bocks are blocks with the same name and 'when','then', 'else' conditions. 
function tbs_Merge_CaseBlock1(&$Txt,$BlockName) {

	$PosBeg = 0 ;
	$Ok = False ;
	$ElseFound = False ;

	//Scan for each Blocks
	while ($PosBeg!==False) {
		$LocBlock = tbs_Locator_FindBlock1($Txt,$BlockName,$PosBeg) ;
		if ($LocBlock===False) {
			$PosBeg = False ;
		} else {

			//Check if it has a 'if' parameter
			if (array_key_exists('if',$LocBlock->PrmLst)) {
				if (tbs_Misc_CheckCondition($LocBlock->PrmLst['if'])==True) {
					$x = $LocBlock->BlockLst[1] ;
					$Ok = True ;
				} else {
					$x = '' ;
				}
			} else {
				//If it's a 'else' block, we keep it for the end of the scan
				if (array_key_exists('else',$LocBlock->PrmLst)) {
					$ElseFound = True ;
					$PosBeg = $LocBlock->PosEnd ;
					$x = False ;
				} else {
					$x = '' ;
				}
			}

			//Merge the bock
			if ($x!==False) {
				$PosBeg = tbs_Locator_Replace($Txt,$LocBlock,$x,False) ;
			}

		} //--> if ($LocBlock===False)
	} //--> while ($PosBeg!==False)

	//Now, we sacn for each 'else' blocks.
	if ($ElseFound===True) {
		$PosBeg = 0 ;
		while ($PosBeg!==False) {
			$LocBlock = tbs_Locator_FindBlock1($Txt,$BlockName,$PosBeg) ;
			if ($LocBlock===False) {
				$PosBeg = False ;
			} else {
				if ($Ok===True) {
					$x = '' ;
				} else {
					$x = $LocBlock->BlockLst[1] ;
				}
				$PosBeg = tbs_Locator_Replace($Txt,$LocBlock,$x,False) ;
			}
		}
	}

}

//Look for each 'check' block and merge them.
function tbs_Merge_CaseBlockAll(&$Txt,$BlockName) {

	$PosBeg = 0 ;
	$CurrName = '' ;
	$LastName = '' ;

	while ($PosBeg!==False) {
		$Loc = tbs_Locator_FindBlock1($Txt,$BlockName,$PosBeg) ;
		if ($Loc===False) {
			$PosBeg = False ;
		} else {
			if ($Loc->SubName===False) {
				//We skip this block because it has no subname.
				$PosBeg = $Loc->PosEnd ;
			} else {  
				$LastName = $CurrName ;
				$CurrName = $BlockName.'.'.$Loc->SubName ;
				if (strcasecmp($LastName,$CurrName)==0) {
					//This enable to no go into an nevereding loop
					$PosBeg = $Loc->PosEnd ;
				} else {
					tbs_Merge_CaseBlock1($Txt,$CurrName) ;
				}
			}
		}
	}

}

//Merge the PHP global variables of the main script.
function tbs_Merge_PhpVar(&$Txt,$HtmlConv=True) {

	global $_tbs_PhpVarLst,$tbs_ChrProtect ;

	$FieldName = 'var' ;

	//Check if the PhpVar list has to be initialized
	if ($_tbs_PhpVarLst===False) {
		//Build an array that enables to find any global variable name from its lower case name
		$_tbs_PhpVarLst = array_flip(array_keys($GLOBALS)) ;
		foreach ($_tbs_PhpVarLst as $Key => $Val) {
			$_tbs_PhpVarLst[$Key] = $Key ;
		}
		$_tbs_PhpVarLst = array_change_key_case($_tbs_PhpVarLst,CASE_LOWER) ;
	}

	//Then we scann all field in the model
	$Pos = 0 ;
	do {
		$Loc = tbs_Locator_FindTbs($Txt,$FieldName,'.',$Pos,True) ;
		if ($Loc!==False) {
			$Pos = $Loc->PosEnd + 1 ;
			if ($Loc->SubName===False) {
				tbs_Misc_Alert('Warning','Merge PhpVar','A ['.$FieldName.'] field without sub-name has been found.') ;
			} else {
				//Look if there if there is a key name.
				$p = strpos($Loc->SubName,'.') ;
				if ($p===False) {
					//No key name
					$x = $Loc->SubName ;
					$Key = False ;
				} else {
					//With key name
					$x = substr($Loc->SubName,0,$p) ;
					$Key = substr($Loc->SubName,$p+1) ;
					if (is_numeric($Key)) $Key = intval($Key) ;
				}
				if (array_key_exists($x,$_tbs_PhpVarLst)) {
					if ($Key===False) {
						$Pos = tbs_Locator_Replace($Txt,$Loc,$GLOBALS[$_tbs_PhpVarLst[$x]],$HtmlConv) ;
					} else {
						$Pos = tbs_Locator_Replace($Txt,$Loc,$GLOBALS[$_tbs_PhpVarLst[$x]][$Key],$HtmlConv) ;
					}
				} else {
					tbs_Misc_Alert('Warning','Merge PhpVar','The field ['.$FieldName.'.'.$Loc->SubName.'] can not be merged because there is no corresponding PHP variable.') ;
				}
			}
		}
	} while ($Loc!==False) ;

}

//This function enables to merge TBS special fields
function tbs_Merge_TbsVar(&$TBS,$FieldName,$HtmlConv=True) {

	$Pos = 0 ;

	do {
		$Loc = tbs_Locator_FindTbs($TBS->Source,$FieldName,'.',$Pos,True) ;
		if ($Loc!==False) {
			$Pos = $Loc->PosEnd + 1 ;
			switch ($Loc->SubName) {
			case 'now':
				$x = mktime() ;
				$Pos = tbs_Locator_Replace($TBS->Source,$Loc,$x,$HtmlConv) ;
				break ;
			case 'version':
				$Pos = tbs_Locator_Replace($TBS->Source,$Loc,$TBS->_Version,$HtmlConv) ;
				break ;
			case 'script_name':
				$x = tbs_Misc_GetFilePart($_SERVER['PHP_SELF'],1) ;
				$Pos = tbs_Locator_Replace($TBS->Source,$Loc,$x,$HtmlConv) ;
				break ;
			case 'template_name':
				$Pos = tbs_Locator_Replace($TBS->Source,$Loc,$TBS->_LastFile,$HtmlConv) ;
				break ;
			case 'template_date':
				$x = filemtime($TBS->_LastFile) ;
				$Pos = tbs_Locator_Replace($TBS->Source,$Loc,$x,$HtmlConv) ;
				break ;
			case 'template_path':
				$x = tbs_Misc_GetFilePart($TBS->_LastFile,0) ;
				$Pos = tbs_Locator_Replace($TBS->Source,$Loc,$x,$HtmlConv) ;
				break ;
			case 'name':
				$x = 'TinyButStrong' ;
				$Pos = tbs_Locator_Replace($TBS->Source,$Loc,$x,$HtmlConv) ;
				break ;
			case 'logo':
				$x = '**TinyButStrong**' ;
				$Pos = tbs_Locator_Replace($TBS->Source,$Loc,$x,$HtmlConv) ;
				break ;
			case 'merge_time' : $TBS->_Timer = True ; break ;
			case 'script_time': $TBS->_Timer = True ; break ;
			}
		}
	} while ($Loc!==False) ;

}

//Procceed to one of the special merge
function tbs_Merge_Special(&$TBS,$Type) {

	if ($Type==='*') $Type = 'include,include.onshow,var,sys,check,timer' ; 

	$TypeLst = split(',',$Type) ;
	foreach ($TypeLst as $Type) {
		switch ($Type) {
  	case 'var':	tbs_Merge_PhpVar($TBS->Source,True) ; break ;
  	case 'sys': tbs_Merge_TbsVar($TBS,'sys') ; break ;
  	case 'check': 
  		tbs_Merge_Field($TBS->Source,'tbs_check','') ;
  		tbs_Merge_CaseBlockAll($TBS->Source,'tbs_check') ;
  		break ;
  	case 'include': tbs_Merge_File($TBS->Source,'tbs_include') ; break ;
  	case 'include.onshow': tbs_Merge_File($TBS->Source,'tbs_include.onshow') ; break ;
  	case 'timer':
  		if ($TBS->_Timer) { //This property is set wihtin the tbs_Merge_PhpVar() function
  			global $_tbs_Timer ;
  			$Micro = tbs_Misc_Timer() ;
  			tbs_Merge_Field($TBS->Source,'sys.merge_time',$Micro - $TBS->_StartMerge) ;
  			tbs_Merge_Field($TBS->Source,'sys.script_time',$Micro - $_tbs_Timer) ;
  		}
  		break ;
  	}
	}
	
}

//Include file
function tbs_Merge_File(&$Txt,$FieldName) {

	$NbrTot = 0 ;

	//We merge all inclusion filed of the asked name
	if ($FieldName<>'') {
		do {
			$Nbr = tbs_Merge_Field($Txt,$FieldName,'') ;
			$NbrTot += $Nbr ;
		} while (($Nbr>0) and ($NbrTot<255)); //255 is a limitation in order to avoid infinit loop
	}

	//Then we merge all incusion field that could be in included files  
	do {
		$Nbr = tbs_Merge_Field($Txt,'tbs_include.onload','') ;
		$NbrTot += $Nbr ;
	} while (($Nbr>0) and ($NbrTot<255)); //255 is a limitation in order to avoid infinit loop

}

//This function returns a part of the HTML document (HEAD or BODY)
//The $CancelIfEmpty parameter enables to cancel the extraction when the part is not found.
function tbs_Html_GetPart(&$Txt,$Tag,$WithTags=False,$CancelIfEmpty=False) {

	$x = False ;

	$LocOpen = tbs_Html_FindTag($Txt,$Tag,True,0,True,0,False) ;
	if ($LocOpen!==False) {
		$LocClose = tbs_Html_FindTag($Txt,$Tag,False,$LocOpen->PosEnd+1,True,0,False) ;
		if ($LocClose!==False) {
			if ($WithTags) {
				$x = substr($Txt,$LocOpen->PosBeg,$LocClose->PosEnd - $LocOpen->PosBeg + 1) ;
			} else {
				$x = substr($Txt,$LocOpen->PosEnd+1,$LocClose->PosBeg - $LocOpen->PosEnd - 1) ;
			}
		}
	}

	if ($x===False) {
		if ($CancelIfEmpty) {
			$x = $Txt ;
		} else {
			$x = '' ;
		}
	}

	return $x ;

}

//This function return True if thte text seems to have some HTML tags.
function tbs_Html_IsHtml(&$Txt) {

	$IsHtml = False ;

	//Search for opening and closing tags
	$pos = strpos($Txt,'<') ;
	if ( ($pos!==False) and ($pos<strlen($Txt)-1) ) {
		$pos = strpos($Txt,'>',$pos + 1) ;
		if ( ($pos!==False) and ($pos<strlen($Txt)-1) ) {
			$pos = strpos($Txt,'</',$pos + 1) ;
			if ( ($pos!==False)and ($pos<strlen($Txt)-1) ) {
				$pos = strpos($Txt,'>',$pos + 1) ;
				if ($pos!==False) {
					$IsHtml = True ;
				}
			}
		}
	}

	//Search for special char
	if ($IsHtml===False) {
		$pos = strpos($Txt,'&') ;
		if ( ($pos!==False)  and ($pos<strlen($Txt)-1) ) {
			$pos2 = strpos($Txt,';',$pos+1) ;
			if ($pos2!==False) {
				$x = substr($Txt,$pos+1,$pos2-$pos1) ; //We extract the found text between the couple of tags
				if (strlen($x)<=10) {
					if (strpos($x,' ')===False) {
						$IsHtml = True ;
					}
				}
			}
		}
	}

	//Look for a simple tag
	if ($IsHtml===False) {
		$Loc1 = tbs_Html_FindTag($Txt,'BR',True,0,True,0,False) ; //line break
		if ($Loc1===False) {
			$Loc1 = tbs_Html_FindTag($Txt,'HR',True,0,True,0,False) ; //horizontal line
			if ($Loc1!==False) {
				$IsHtml = True ;
			}
		} else {
			$IsHtml = True ;
		}
	}

	return $IsHtml ;

}

//It is a field-locator
function tbs_Html_MergeOptionList(&$Txt,&$PosBeg,&$Value) {

	$TagO = tbs_Html_FindTag($Txt,'SELECT',True,$PosBeg-1,False,0,False) ;

	if ($TagO!==False) {

		$TagC = tbs_Html_FindTag($Txt,'SELECT',False,$PosBeg,True,0,False) ;
		if ($TagC!==False) {

			//We get the option block without the SELECT tags
			$LstTxt = substr($Txt,$TagO->PosEnd+1,$TagC->PosBeg - $TagO->PosEnd -1) ;

			//Now, we going to scann all of the <OPTION> </OPTION> couple of tags
			$OptPos = 0 ;
			$SelNbr = 0 ;
			while ($OptPos!==False) {

				$OptO = tbs_Html_FindTag($LstTxt,'OPTION',True,$OptPos,True,0,True,True) ; //with parameters and prm positions
				if ($OptO===False) {
					$OptPos = False ;
				} else {
					$OptC = tbs_Html_FindTag($LstTxt,'OPTION',False,$OptO->PosEnd+1,True,0,False,False) ;
					if ($OptC===False) {
						$OptPos = False ;
					} else {
						//Default position for the next couple of tags

						//we get th value of this item option
						if (array_key_exists('value',$OptO->PrmLst)) { // The value is defined with the VALUE attribute of the opening tag
							$Val = $OptO->PrmLst['value'] ;
						} else { // The value of the option is its caption, it is between the couple of opening-closing tags.
							$Val = trim(substr($LstTxt,$OptO->PosEnd+1,$OptC->PosBeg - $OptO->PosEnd - 1)) ;
						}

						//Now we look if we have to select this item or not
						if (strcasecmp($Val,htmlentities($Value))==0) {
							$Select = True ;
							$SelNbr++ ;
						} else {
							$Select = False ;
						}

						if ( (!$Select) or ($SelNbr<=1)) {
							tbs_Html_ChangeAttribute($LstTxt,$OptO,'selected',$Select) ;
							$OptPos = $OptO->PosEnd + 1 ; //We have to start the next search to this position because $OptC is not valide anymore cause $OptO has changed.
						} else {
							//This value has already been selected, now we delete the current option
							$LstTxt = substr_replace($LstTxt,'',$OptO->PosBeg,$OptC->PosEnd-$OptO->PosBeg+1) ;
							$OptPos = $OptO->PosBeg ;
						}

					} //--> if ($OptF===False) { ... } else {
				} //--> if ($OptO===False) { ... } else {
			} //--> while ($OptPos!==False) {

			$Txt = substr_replace($Txt,$LstTxt,$TagO->PosEnd+1,$TagC->PosBeg-$TagO->PosEnd-1) ;

		} //--> if ($TagC!==False) {
	} //--> if ($TagO!==False) {

}

//Convert a string to Html with several options
function tbs_Html_Conv(&$Txt,$BrConv,$WhiteSp) {

	$Txt = htmlentities($Txt) ;

	if ($WhiteSp) {
		$check = '  ' ;
		$nbsp = '&nbsp;' ;
		do {
			$pos = strpos($Txt,$check) ;
			if ($pos!==False) $Txt = substr_replace($Txt,$nbsp,$pos,1) ;
		} while ($pos!==False) ;
	}
	
	if ($BrConv) $Txt = nl2br($Txt) ;
	
}

//This function is a smarter issue to find an HTML tag.
//It enables to ignore full opening/closing couple of tag that could be inserted before the searched tag.
//It also enable to pass a number of encapsulation.
//To ignore encapsulation and opengin/closing just set $Encaps=0.
function tbs_Html_FindTag(&$Txt,$Tag,$Opening,$PosBeg,$Forward,$Encaps=1,$WithPrm=False,$PrmPos=False) {

	if ($Forward) {
		$Pos = $PosBeg - 1 ;
	} else {
		$Pos = $PosBeg + 1 ;
	}
	$TagIsOpening = False ;
	$TagClosing = '/'.$Tag ;
	if ($Opening) {
		$EncapsEnd = $Encaps ;
	} else {
		$EncapsEnd = - $Encaps ;
	} 
	$EncapsCnt = 0 ;
	$TagOk = False ;

	do {

		//Look for the next tag def
		if ($Forward) {
			$Pos = strpos($Txt,'<',$Pos+1) ;
		} else {
			if ($Pos<=0) {
				$Pos = False ;
			} else {
				$Pos = strrpos(substr($Txt,0,$Pos - 1),'<') ;
			}
		}

		if ($Pos!==False) {
			//Check the name of the tag
			if (strcasecmp(substr($Txt,$Pos+1,strlen($Tag)),$Tag)==0) {
				$PosX = $Pos + 1 + strlen($Tag) ; //The next char
				$TagOk = True ;
				$TagIsOpening = True ;
			} elseif (strcasecmp(substr($Txt,$Pos+1,strlen($TagClosing)),$TagClosing)==0) {
				$PosX = $Pos + 1 + strlen($TagClosing) ; //The next char
				$TagOk = True ;
				$TagIsOpening = False ;
			}

			if ($TagOk) {
				//Check the next char
				if (($Txt[$PosX]===' ') or ($Txt[$PosX]==='>')) {
					//Check the encapsulation count
					if ($EncapsEnd==0) {
						//No encaplusation check
						if ($TagIsOpening!==$Opening) $TagOk = False ;
					} else {
						//Count the number of encapsulation
						if ($TagIsOpening) {
							$EncapsCnt++ ;
						} else {
							$EncapsCnt-- ;
						}
						//Check if it's the expected count
						if ($EncapsCnt!=$EncapsEnd) $TagOk = False ;
					}
				} else {
					$TagOk = False ;
				}
			} //--> if ($TagOk)

		}
	} while (($Pos!==False) and ($TagOk===False)) ;

	//Search for the end of the tag
	if ($TagOk) {
		$PrmLst = array() ;
		if ($WithPrm) {
			$PosEnd = 0 ;
			$SubName = False ;
			tbs_Locator_ReadPrm($Txt,$PosX,' ','=','\'"','','','>',0,$PrmLst,$PosEnd,$SubName,$PrmPos) ;
		} else {
			$PosEnd = strpos($Txt,'>',$PosX) ;
			if ($PosEnd===False) {
				$TagOk = False ;
			}
		}
	}

	//Result
	if ($TagOk) {
		$Loc = new clsTbsLocator ;
		$Loc->PosBeg = $Pos ;
		$Loc->PosEnd = $PosEnd ;
		$Loc->PrmLst = $PrmLst ;
		$Loc->PrmPos = $PrmPos ;
		return $Loc ;
	} else {
		return False ;
	}

}

//Change the attribute value in the $Loc tag.
//If $AttValue=True, the attribute is set without value
//If $AttValue=False, the attribute is deleted
//In other cases, the attribute is set the the string value with string delimiters.
function tbs_Html_ChangeAttribute(&$Txt,&$Loc,$AttName,$AttValue) {

	$AttName = strtolower($AttName) ;

	//Build the attribute string
	if ($AttValue===False) {
		$x = '' ;
	} elseif ($AttValue===True) {
		$x = $AttName ;
	} else {
		$x = ''.$AttValue ;
	$x = str_replace('"','\\"',$x) ;
		$x = $AttName.'="'.$x.'"' ;
	}

	//insert the attribute in the string
	if (array_key_exists($AttName,$Loc->PrmPos)) {
		$Add = False ;
		$PosBeg  = $Loc->PrmPos[$AttName][0] ;
		$PosNext = $Loc->PrmPos[$AttName][1] + 1;
	} else {
		//The atrribute doesn't exists, we add it at the end of the entity
		$Add = True ;
		$x = ' '.$x ;
		$PosBeg  = $Loc->PosEnd ;
		$PosNext = $PosBeg ;
	}
	$OldLen = $PosNext - $PosBeg ;
	$Delta = strlen($x) - $OldLen ; 

	//Replace the attribute in the text
	$Txt = substr_replace($Txt,$x,$PosBeg,$OldLen) ;
	$Loc->PosEnd = $Loc->PosEnd + $Delta ;
	if (!is_array($Loc->PrmPos)) {
		$Loc->PrmPos = array() ;
	}

	if ($Add===False) {
		//Now we have to update all position that were after the attribute
		//This is usefull in case this function will be called again for another attribute
		foreach ($Loc->PrmPos as $Key=>$Val) {
			if ($Loc->PrmPos[$Key][0]>$PosBeg) {
				$Loc->PrmPos[$Key][0] = $Loc->PrmPos[$Key][0] + $Delta ;
				$Loc->PrmPos[$Key][1] = $Loc->PrmPos[$Key][1] + $Delta ;
			}
		}
		//We update the position of the current parameter
		$Loc->PrmPos[$AttName][1] = $PosNext + $Delta - 1 ;
	} else {
		//We update the position of the current parameter
		$Loc->PrmPos[$AttName][0] = $PosBeg + 1 ; //Because there is a space added
		$Loc->PrmPos[$AttName][1] = $PosNext + $Delta - 1 ;
	}

}

//Returne un string that describe all locators with the given name.
function tbs_Misc_DebugLocator(&$Txt,$Name) {
	$x = '' ;
	$PosBeg = 0 ;
	$Type = 0 ;
	$Nbr = 0 ;
	$Break = '-------------------<br>' ;
	$ColOn = '<font color="#993300">' ;
	$ColOff = '</font>' ;
	do {
		if ($Type===0) {
			$Loc = tbs_Locator_FindTbs($Txt,$Name,'',$PosBeg,True) ;
			if ($Loc===False) $Type = 1 ;
		}
		if ($Type===1) {
			$Loc = tbs_Locator_FindTbs($Txt,$Name,'.',$PosBeg,True) ;
		}
		if ($Loc!==False) {
			$PosBeg = $Loc->PosEnd + 1 ;
			$Nbr++ ;
			$x .= $Break ;
			$x .= 'Locator = '.$ColOn.htmlentities(substr($Txt,$Loc->PosBeg,$Loc->PosEnd-$Loc->PosBeg+1)).$ColOff.'<br>' ;
			$x .= 'Name = '.$ColOn.htmlentities($Name).$ColOff.', subname = '.$ColOn.htmlentities($Loc->SubName).$ColOff.'<br>' ;
			$x .= 'Begin = '.$ColOn.$Loc->PosBeg.$ColOff.', end = '.$ColOn.$Loc->PosEnd.$ColOff.'<br>' ;
			foreach ($Loc->PrmLst as $key=>$val) {
				if ($val===True) $val = 'True' ;
				if ($val===False) $val = 'False' ;
				$x .= 'Parameters['.$ColOn.htmlentities($key).$ColOff.'] = '.$ColOn.htmlentities($val).$ColOff.'<br>' ;
			}
		}
	} while ($Loc!==False) ;
	$x .= $Break ;
	$x = 'Locator search = '.$ColOn.htmlentities($Name).$ColOff.', found = '.$ColOn.$Nbr.$ColOff.'<br> Template size = '.$ColOn.strlen($Txt).$ColOff.'<br>'. $x ;
	$x = $Break . $x ;
	return $x ;
}

//Standard alerte message provideed by TinyButStrong
function tbs_Misc_Alert($Type,$Source,$Message) {
	global $tbs_ChrProtect ;
	$Txt = '<br><b>TinyButStrong '.$Type.'</b> ('.$Source.'): '.htmlentities($Message).'<br><br>' ;
	$Txt = str_replace('[',$tbs_ChrProtect,$Txt) ;
	echo $Txt ;
}

function tbs_Misc_Timer() {
	$x = microtime() ;
	$Pos = strpos($x,' ') ;
	if ($Pos===False) {
		$x = '0.0' ;
	} else {
		$x = substr($x,$Pos+1).substr($x,1,$Pos) ;
	}
	return (float)$x ;
}

//Marks the variable to be initilized
function tbs_Misc_ClearPhpVarLst() {
	global $_tbs_PhpVarLst ;
	$_tbs_PhpVarLst = False ;
}

function tbs_Misc_GetFilePart($File,$Part) {
	$Pos = strrpos($File,'/') ;
	if ($Part===0) { //Path
		if ($Pos===False) {
			return '' ;
		} else {
			return substr($File,0,$Pos+1) ;
		}
	} else { //File
		if ($Pos===False) {
			return $File ;
		} else {
			return substr($File,$Pos+1) ;
		}
	}
}

//Load the content of a file into the text variable.
function tbs_Misc_GetFile(&$Txt,$File) {

	$Txt = '' ;

	$fd = @fopen($File, 'r') ; //'rb' if binary for some OS

	if ($fd===False) {
		tbs_Misc_Alert('Error','LoadFile','error when opening the file \''.$File.'\'.') ;
		return False ;
	}

	$Txt = fread($fd, filesize($File)) ;
	fclose($fd);

}

//This function return the formated representation of a Date/Time or numeric variable using a 'VB like' format syntaxe instead of the PHP syntaxe.
function tbs_Misc_Format(&$Value,$FrmStr) {

  $FrmStr = explode('|',$FrmStr) ; //syntax : PostiveFrm[;NegativeFrm[;ZeroFrm[;NullFrm]]]
  $FrmNbr = count($FrmStr) ;

	//Prepare the value conversion into numeric, timestamp and string
	$nVal = False ; //Float
	$dVal = False ; //Timestamp
  if (is_string($Value)) {
  	$tVal = trim($Value) ;
  	if ($tVal!=='') {
	  	if (is_numeric($tVal)) {
	  		$nVal = floatval($tVal) ;
		  	$dVal = strtotime($tVal) ;
		  	if ($dVal===-1) $dVal = $nVal ;
		  } else {
		  	$dVal = strtotime($tVal) ;
		  	if ($dVal===-1) {
		  		$dVal = False ;
		  	} else {
		  		$nVal = $dVal ;
		  	}
	  	}
	  }
  } elseif (is_numeric($Value)) {
  	$nVal = $Value ;
  	$dVal = $Value ;
  } else {
  	$tVal = ''.$Value ;
	}
  
  if ($nVal===False) { //No date or numeric value found
  	if ($tVal==='') {//Nul value
	  	if ($FrmNbr>3) {
	  		$FrmStr = $FrmStr[3] ;
	  	} else {
	  		$FrmStr = '' ;
	  	}
	  } else {
	  	$FrmStr = $tVal ;
	  }
  } else {
  	
  	//Choose the conviant format corresponding to the sign of the numerical value
  	$AddMinus = False ;
  	if ($nVal>0) {
  		$FrmStr = $FrmStr[0] ;
  	} elseif ($nVal<0) {
 			$nVal = -$nVal ;
  		if ($FrmNbr>1) {
  			$FrmStr = $FrmStr[1] ;
  			if ($FrmStr==='') {
  				$FrmStr = $FrmStr[0] ;
  				$AddMinus = True ;
  			}
  		} else {
  			$FrmStr = $FrmStr[0] ;
  			$AddMinus = True ;
  		}
  	} else { //zero
  		if ($FrmNbr>2) {
  			$FrmStr = $FrmStr[2] ;
  			if ($FrmStr==='') $FrmStr = $FrmStr[0] ; 
  		} else {
  			$FrmStr = $FrmStr[0] ;
  		}
  	}
  	
  	if ($FrmStr==='') return ''.$Value ;
 
		$nPosEnd = strrpos($FrmStr,'0') ;
		if ($nPosEnd!==False) {

		  // Numeric format
			$nDecSep = '.' ;
			$nDecNbr = 0 ;
			$nDecOk = True ;
			if (substr($FrmStr,$nPosEnd+1,1)==='.') {
				$nPosEnd++;
				$nPosCurr = $nPosEnd ;
			} else {
				$nPosCurr = $nPosEnd - 1 ;
				while (($nPosCurr>=0) and ($FrmStr[$nPosCurr]==='0')) {
					$nPosCurr-- ;
				}
				if (($nPosCurr>=1) and ($FrmStr[$nPosCurr-1]==='0')) {
					$nDecSep = $FrmStr[$nPosCurr] ;
					$nDecNbr = $nPosEnd - $nPosCurr ;
				} else {
					$nDecOk = False ;
				}
			}
			
			//Thaousand separator
  		$nThsSep = '' ;
			if (($nDecOk) and ($nPosCurr>=5)) {
	  		if ((substr($FrmStr,$nPosCurr-3,3)==='000') and ($FrmStr[$nPosCurr-4]!=='') and ($FrmStr[$nPosCurr-5]==='0')) {
 					$nPosCurr = $nPosCurr-4 ;
 					$nThsSep = $FrmStr[$nPosCurr] ;
  			}
 			}
 			//Pass next zero
			if ($nDecOk) $nPosCurr-- ;
  		while (($nPosCurr>=0) and ($FrmStr[$nPosCurr]==='0')) {
  			$nPosCurr-- ;
  		}

			//Replace value
			if ($nVal===False) {
				$x = $tVal ;
			} else {
				if (strpos($FrmStr,'%')) $nVal = $nVal * 100 ;
				$x = number_format($nVal,$nDecNbr,$nDecSep,$nThsSep) ;
				if ($AddMinus) $x = '-'.$x ;
			}
			$FrmStr = substr_replace($FrmStr,$x,$nPosCurr+1,$nPosEnd-$nPosCurr) ;

		} else {
		    //return 'date' ;

  		// Date format
  		$FrmPHP = '' ;
  		$StrIn = False ;
  		$iMax = strlen($FrmStr) ;
  		$Cnt = 0 ;
  		for ($i=0;$i<$iMax;$i++) {
				if ($StrIn) {
					//We are in a string part
					if ($FrmStr[$i]===$StrChr) {
						if (substr($FrmStr,$i+1,1)===$StrChr) {
							$FrmPHP .= '\\'.$FrmStr[$i] ; //char protected
							$i++ ;
						} else {
							$StrIn = False ;
						}
					} else {
						$FrmPHP .= '\\'.$FrmStr[$i] ; //char protected
					}
				} else {
					if (($FrmStr[$i]==='"') or ($FrmStr[$i]==='\'')) {
						//Check if we have the opening string char
						$StrIn = True ;
						$StrChr = $FrmStr[$i] ;
					} else {
						$Cnt++ ;
						if     (strcasecmp(substr($FrmStr,$i,4),'yyyy')===0) { $FrmPHP .= 'Y' ; $i += 3 ; }
						elseif (strcasecmp(substr($FrmStr,$i,2),'yy'  )===0) { $FrmPHP .= 'y' ; $i += 1 ; }
						elseif (strcasecmp(substr($FrmStr,$i,4),'mmmm')===0) { $FrmPHP .= 'F' ; $i += 3 ; }
						elseif (strcasecmp(substr($FrmStr,$i,3),'mmm' )===0) { $FrmPHP .= 'M' ; $i += 2 ; }
						elseif (strcasecmp(substr($FrmStr,$i,2),'mm'  )===0) { $FrmPHP .= 'm' ; $i += 1 ; }
						elseif (strcasecmp(substr($FrmStr,$i,1),'m'   )===0) { $FrmPHP .= 'n' ; }
						elseif (strcasecmp(substr($FrmStr,$i,4),'wwww')===0) { $FrmPHP .= 'l' ; $i += 3 ; }
						elseif (strcasecmp(substr($FrmStr,$i,3),'www' )===0) { $FrmPHP .= 'D' ; $i += 2 ; }
						elseif (strcasecmp(substr($FrmStr,$i,1),'w'   )===0) { $FrmPHP .= 'w' ; }
						elseif (strcasecmp(substr($FrmStr,$i,4),'dddd')===0) { $FrmPHP .= 'l' ; $i += 3 ; }
						elseif (strcasecmp(substr($FrmStr,$i,3),'ddd' )===0) { $FrmPHP .= 'D' ; $i += 2 ; }
						elseif (strcasecmp(substr($FrmStr,$i,2),'dd'  )===0) { $FrmPHP .= 'd' ; $i += 1 ; }
						elseif (strcasecmp(substr($FrmStr,$i,1),'d'   )===0) { $FrmPHP .= 'j' ; }
						elseif (strcasecmp(substr($FrmStr,$i,2),'hh'  )===0) { $FrmPHP .= 'H' ; $i += 1 ; }
						elseif (strcasecmp(substr($FrmStr,$i,2),'nn'  )===0) { $FrmPHP .= 'i' ; $i += 1 ; }
						elseif (strcasecmp(substr($FrmStr,$i,2),'ss'  )===0) { $FrmPHP .= 's' ; $i += 1 ; }
						else {
							$FrmPHP .= '\\'.$FrmStr[$i] ; //char protected
							$Cnt-- ;
						}
					}
				} //-> if ($StrIn) {...} else {
  		} //-> for ($i=0;$i<$iMax;$i++) {
  		
  		if ($Cnt!==0) {
  			if ($dVal<0) $dVal = 0 ;
  			$FrmStr = date($FrmPHP,$dVal) ;
  		}

		}
		
	} //-> if (($nVal===False) and ($dVal===False)) {...} else {

	return $FrmStr ;

}

//Check an expression typed like 'exrp1=expr2' and returns True if 'expr1' and 'expr2' are the same .
function tbs_Misc_CheckCondition($Str) {

	$Symb = '!=' ;
	$Pos = strpos($Str,$Symb) ;
	if ($Pos===False) {
		$Symb = '=' ;
		$Pos = strpos($Str,$Symb) ;
	}

	if ($Pos===False) {
		return False ;
	} else {
		$V1 = trim(substr($Str,0,$Pos)) ;
		$V2 = trim(substr($Str,$Pos+strlen($Symb))) ;
		if (strcasecmp($V1,$V2)==0) {
			if ($Symb==='=') {
				return True ;
			} else {
				return False ;
			}
		} else {
			if ($Symb==='=') {
				return False ;
			} else {
				return True ;
			}
		}
	}

}

//Actualize the special TBS char
function tbs_Misc_ActualizeChr() {
	global $tbs_ChrOpen,$tbs_ChrClose,$tbs_ChrVal,$tbs_ChrProtect ;
	$tbs_ChrVal = $tbs_ChrOpen.'val'.$tbs_ChrClose ;
	$tbs_ChrProtect = '&#'.ord($tbs_ChrOpen).';' ;
}

function tbs_Misc_GetStrId($Txt) {
	$Txt = strtolower($Txt) ;
	$Txt = str_replace('-','_',$Txt) ;
	$x = '' ;
	$i = 0 ;
	$iMax = strlen($Txt2) ;
	while ($i<$iMax) {
		if (($Txt[$i]==='_') or (($Txt[$i]>='a') and ($Txt[$i]<='z')) or (($Txt[$i]>='0') and ($Txt[$i]<='9'))) {
			$x .= $Txt[$i] ;
			$i++;
		} else {
			$i = $iMax ;
		}
	}
	return $x ;
}

function tbs_Misc_ReplaceVal(&$Txt,&$Val) {
	global $tbs_ChrVal ;
	$Txt =  str_replace($tbs_ChrVal,$Val,$Txt) ;
}


//Return the cache file path for a given Id. 
function tbs_Cache_File($Dir,$CacheId,$Mask) {
	if (strlen($Dir)>0) {
		if ($Dir[strlen($Dir)-1]<>'/') {
			$Dir .= '/' ;
		}
	}
	return $Dir.str_replace('*',$CacheId,$Mask) ;
}

//Return True if there is a existing valid cache for the given file id.
function tbs_Cache_IsValide($CacheFile,$TimeOut) {
	if (file_exists($CacheFile)) {
		if (time()-filemtime($CacheFile)>$TimeOut) {
			return False ;
		} else {
			return True ;
		}
	} else {
		return False ;
	}
}

function tbs_Cache_Save($CacheFile,&$Txt) {
	$fid = @fopen($CacheFile, 'w') ;
	if ($fid===False) {
		tbs_Misc_Alert('Error','Cache','The cache file \''.$CacheFile.'\' can not be saved.') ;
		Return False ;
	} else {
		flock($fid,2) ; //acquire an exlusive lock 
		fwrite($fid,$Txt) ;
		flock($fid,3) ; //release the lock
		fclose($fid) ;
		Return True ;
	}
}

function tbs_Cache_DeleteAll($Dir,$Mask) {

	if (strlen($Dir)==0) {
		$Dir = '.' ;
	}
	if ($Dir[strlen($Dir)-1]<>'/') {
		$Dir .= '/' ;
	}
	$DirObj = dir($Dir) ;
	$Nbr = 0 ;
	$PosL = strpos($Mask,'*') ;
	$PosR = strlen($Mask) - $PosL - 1 ;

	//Get the list of cache files
	$FileLst = array() ;
	while ($FileName = $DirObj->read()) {
		$FullPath = $Dir.$FileName ;
		if (strtolower(filetype($FullPath))==='file') {
			if (strlen($FileName)>=strlen($Mask)) {
				if ((substr($FileName,0,$PosL)===substr($Mask,0,$PosL)) and (substr($FileName,-$PosR)===substr($Mask,-$PosR))) {
					$FileLst[] = $FullPath ;
				}
			}
		}
	} 
	//Delete all listed files
	foreach ($FileLst as $FullPath) {
		@unlink($FullPath) ;
		$Nbr++ ;
	}

	return $Nbr ;

}

?>