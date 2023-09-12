<?php


/**
 * Convert Font for save data to OMS
 */
class ConvertFont
{
    public static function UnicodeToCP1258($vInput)
    {
        if (!isset($vInput)) {
            return "";
        }
        $sOutput = ConvertFont::uni_1258($vInput);
        return $sOutput;
    }


    protected static function ConvertSpecialChar($vInput)
    {
        //purpose: return a string with special Unicode characters
        //replaced by CP1258 equivalents
        if (!isset($vInput) || $vInput == "") {
            return "";
        }
        $sOutput = "";
        $sInput = $vInput;
        for ($i=0;$i<mb_strlen($sInput);$i++){
            $sChar = mb_substr($sInput, 0, 1); // WARNING: assuming sInput is an external function
            $sOutput .= ConvertFont::GetSpecialChar1258($sChar); // WARNING: assuming GetSpecialChar1258 is an external array
            $sInput = mb_substr($sInput,1);
        }
        return $sOutput;
    }

    protected static function GetSpecialChar1258($vInput)
    {
        $nAsc = ConvertFont::ordutf8($vInput);
        //\Debugbar::info("char: ".$vInput);
        switch ($nAsc) {
            case 192:
                //A grave
                $sOutput = ConvertFont::chwUni(65) . ConvertFont::chwUni(204);
                break;
            case 193:
                //A acute
                $sOutput = ConvertFont::chwUni(65) . ConvertFont::chwUni(236);
                break;
            case 195:
                // A tilde
                $sOutput = ConvertFont::chwUni(65) . ConvertFont::chwUni(222);
                break;
            case 200:
                //E grave
                $sOutput = ConvertFont::chwUni(69) . ConvertFont::chwUni(204);
                break;
            case 201:
                //E acute
                $sOutput = ConvertFont::chwUni(69) . ConvertFont::chwUni(236);
                break;
            case 204:
                //I grave
                $sOutput = ConvertFont::chwUni(73) . ConvertFont::chwUni(204);
                break;
            case 205:
                //I acute
                $sOutput = ConvertFont::chwUni(73) . ConvertFont::chwUni(236);
                break;
            case 210:
                //O grave
                $sOutput = ConvertFont::chwUni(79) . ConvertFont::chwUni(204);
                break;
            case 211:
                //O acute
                $sOutput = ConvertFont::chwUni(79) . ConvertFont::chwUni(236);
                break;
            case 213:
                //O tilde
                $sOutput = ConvertFont::chwUni(79) . ConvertFont::chwUni(222);
                break;
            case 217:
                //U grave
                $sOutput = ConvertFont::chwUni(85) . ConvertFont::chwUni(204);
                break;
            case 218:
                //U acute
                $sOutput = ConvertFont::chwUni(85) . ConvertFont::chwUni(236);
                break;
            case 221:
                //Y acute
                $sOutput = ConvertFont::chwUni(89) . ConvertFont::chwUni(236);
                break;
            case 224:
                //a grave
                $sOutput = ConvertFont::chwUni(97) . ConvertFont::chwUni(204);
                break;
            case 225:
                //a acute
                $sOutput = ConvertFont::chwUni(97) . ConvertFont::chwUni(236);
                break;
            case 227:
                //a tilde
                $sOutput = ConvertFont::chwUni(97) . ConvertFont::chwUni(222);
                break;
            case 232:
                //e grave
                $sOutput = ConvertFont::chwUni(101) . ConvertFont::chwUni(204);
                break;
            case 233:
                //e acute
                $sOutput = ConvertFont::chwUni(101) . ConvertFont::chwUni(236);
                break;
            case 236:
                //i grave
                $sOutput = ConvertFont::chwUni(105) . ConvertFont::chwUni(204);
                break;
            case 237:
                //i acute
                $sOutput = ConvertFont::chwUni(105) . ConvertFont::chwUni(236);
                break;
            case 242:
                //o grave
                $sOutput = ConvertFont::chwUni(111) . ConvertFont::chwUni(204);
                break;
            case 243:
                //o acute
                $sOutput = ConvertFont::chwUni(111) . ConvertFont::chwUni(236);
                break;
            case 245:
                //o tilde
                $sOutput = ConvertFont::chwUni(111) . ConvertFont::chwUni(222);
                break;
            case 249:
                //u grave
                $sOutput = ConvertFont::chwUni(117) . ConvertFont::chwUni(204);
                break;
            case 250:
                //u acute
                $sOutput = ConvertFont::chwUni(117) . ConvertFont::chwUni(236);
                break;
            case 253:
                //y acute
                $sOutput = ConvertFont::chwUni(121) . ConvertFont::chwUni(236);
                break;
            default:
                $sOutput = $vInput;
                break;
        }
        return $sOutput;
    }

    protected static function uni_1258($str) {
        $charset="UTF-8";
        $result='';
        for ($i=0; $i<mb_strlen($str, $charset);$i++){
            $c = mb_substr($str, $i, 1, $charset);
            switch ($c){
                //  Case 'á' : $c = 'aì'; break;
                //Case 'à' : $c = 'aÌ'; break;
                Case "ả" : $c = "aÒ"; break;
                Case "ã" : $c = "aÞ"; break;
                Case "ạ" : $c = "aò"; break;
                Case "ă" : $c = "ã"; break;
                Case "ắ" : $c = "ãì"; break;
                Case "ằ" : $c = "ãÌ"; break;
                Case "ẳ" : $c = "ãÒ"; break;
                Case "ẵ" : $c = "ãÞ"; break;
                Case "ặ" : $c = "ãò"; break;
                Case "â" : $c = "â"; break;
                Case "ấ" : $c = "âì"; break;
                Case "ầ" : $c = "âÌ"; break;
                Case "ẩ" : $c = "âÒ"; break;
                Case "ẫ" : $c = "âÞ"; break;
                Case "ậ" : $c = "âò"; break;
                // Case chr(101) : $c = "e"; break;
                //Case "é" : $c = "e"; break;
                //Case "è" : $c = "eø"; break;
                Case "ẻ" : $c = "eÒ"; break;
                Case "ẽ" : $c = "eÞ"; break;
                Case "ẹ" : $c = "eò"; break;
                //Case "ê" : $c = "eâ"; break;
                Case "ế" : $c = "êì"; break;
                Case "ề" : $c = "êÌ"; break;
                Case "ể" : $c = "êÒ"; break;
                Case "ễ" : $c = "êÞ"; break;
                Case "ệ" : $c = "êò"; break;
                // Case chr(111) : $c = "o"; break;
                //Case "ó" : $c = "o"; break;
                Case "ò" : $c = "oÌ"; break;
                Case "ỏ" : $c = "oÒ"; break;
                Case "õ" : $c = "oÞ"; break;
                Case "ọ" : $c = "oò"; break;
                //Case "ô" : $c = "ô"; break;
                Case "ố" : $c = "ôì"; break;
                Case "ồ" : $c = "ôÌ"; break;
                Case "ổ" : $c = "ôÒ"; break;
                Case "ỗ" : $c = "ôÞ"; break;
                Case "ộ" : $c = "ôò"; break;
                Case "ơ" : $c = "õ"; break;
                Case "ớ" : $c = "õì"; break;
                Case "ờ" : $c = "õÌ"; break;
                Case "ở" : $c = "õÒ"; break;
                Case "ỡ" : $c = "õÞ"; break;
                Case "ợ" : $c = "õò"; break;
                // Case chr(105) : $c = "i"; break;
                //Case "í" : $c = "í"; break;
                Case "ì" : $c = "iÌ"; break;
                Case "ỉ" : $c = "iÒ"; break;
                Case "ĩ" : $c = "iÞ"; break;
                Case "ị" : $c = "iò"; break;
                // Case chr(117) : $c = "u"; break;
                // Case "ú" : $c = "uì"; break;
                // Case "ù" : $c = "uÌ"; break;
                Case "ủ" : $c = "uÒ"; break;
                Case "ũ" : $c = "uÞ"; break;
                Case "ụ" : $c = "uò"; break;

                Case "ư" : $c = "ý"; break;
                Case "ứ" : $c = "ýì"; break;
                Case "ừ" : $c = "ýÌ" ; break;
                Case "ử" : $c = "ýÒ"; break;
                Case "ữ" : $c = "ýÞ"; break;
                Case "ự" : $c = "ýò"; break;
                // Case chr(121) : $c = "y"; break;
                Case "ý" : $c = "yì"; break;
                Case "ỳ" : $c = "yÌ"; break;
                Case "ỷ" : $c = "yÒ"; break;
                Case "ỹ" : $c = "yÞ"; break;
                Case "ỵ" : $c = "yò"; break;
                Case "đ" : $c = "ð"; break;
                //Case "Á" : $c = "Aì"; break;
                // Case "À" : $c = "AÌ"; break;
                Case "Ả" : $c = "AÒ"; break;
                Case "Ã" : $c = "AÞ"; break;
                Case "Ạ" : $c = "Aò"; break;
                Case "Ă" : $c = "Ã"; break;
                Case "Ắ" : $c = "Ãì"; break;
                Case "Ằ" : $c = "ÃÌ"; break;
                Case "Ẳ" : $c = "ÃÒ"; break;
                Case "Ẵ" : $c = "ÃÞ"; break;
                Case "Ặ" : $c = "Ãò"; break;
                Case "Â" : $c = "AÂ"; break;
                Case "Ấ" : $c = "Âì"; break;
                Case "Ầ" : $c = "ÂÌ"; break;
                Case "Ẩ" : $c = "ÂÒ"; break;
                Case "Ẫ" : $c = "ÂÞ"; break;
                Case "Ậ" : $c = "Âò"; break;
                //Case "É" : $c = "EÙ"; break;
                // Case "È" : $c = "EØ"; break;
                Case "Ẻ" : $c = "EÒ"; break;
                Case "Ẽ" : $c = "EÞ"; break;
                Case "Ẹ" : $c = "Eò"; break;
                //Case "Ê" : $c = "EÂ"; break;
                Case "Ế" : $c = "Êì"; break;
                Case "Ề" : $c = "ÊÌ"; break;
                Case "Ể" : $c = "ÊÒ"; break;
                Case "Ễ" : $c = "ÊÞ"; break;
                Case "Ệ" : $c = "Êò"; break;
                //Case "Ó" : $c = "O"; break;
                Case "Ò" : $c = "OÌ"; break;
                Case "Ỏ" : $c = "OÒ"; break;
                Case "Õ" : $c = "OÞ"; break;
                Case "Ọ" : $c = "Oò"; break;
                //Case "Ô" : $c = "Ô"; break;
                Case "Ố" : $c = "Ôì"; break;
                Case "Ồ" : $c = "ÔÌ"; break;
                Case "Ổ" : $c = "ÔÒ"; break;
                Case "Ỗ" : $c = "ÔÞ"; break;
                Case "Ộ" : $c = "Ôò"; break;
                Case "Ơ" : $c = "Õ"; break;
                Case "Ớ" : $c = "Õì"; break;
                Case "Ờ" : $c = "ÕÌ"; break;
                Case "Ở" : $c = "ÕÒ"; break;
                Case "Ỡ" : $c = "ÕÞ"; break;
                Case "Ợ" : $c = "Õò"; break;
                // Case chr(73) : $c = "I"; break;
                // Case "Í" : $c = "Í"; break;
                Case "Ì" : $c = "IÌ"; break;
                Case "Ỉ" : $c = "IÒ"; break;
                Case "Ĩ" : $c = "IÞ"; break;
                Case "Ị" : $c = "Iò"; break;
                // Case chr(85) : $c = "U"; break;
                //Case "Ú" : $c = "Uì"; break;
                // Case "Ù" : $c = "UÌ"; break;
                Case "Ủ" : $c = "UÒ"; break;
                Case "Ũ" : $c = "UÞ"; break;
                Case "Ụ" : $c = "Uò"; break;
                Case "Ư" : $c = "Ý"; break;
                Case "Ứ" : $c = "Ýì"; break;
                Case "Ừ" : $c = "ÝÌ"; break;
                Case "Ử" : $c = "ÝÒ"; break;
                Case "Ữ" : $c = "ÝÞ"; break;
                Case "Ự" : $c = "Ýò"; break;
                // Case chr(89) : $c = "Y"; break;
                Case "Ý" : $c = "Yì"; break;
                Case "Ỳ" : $c = "YÌ"; break;
                Case "Ỷ" : $c = "YÒ"; break;
                Case "Ỹ" : $c = "YÞ"; break;
                Case "Ỵ" : $c = "Yò"; break;
                Case "Đ" : $c = "Ð"; break;
            }
            $result .= $c;
        }
        Return $result;
    }

    protected static function GetChar1258($vInput)
    {
        switch (trim($vInput)) {
            //A
            case "&#7842;":
                $_retval = ConvertFont::chwUni(65) . ConvertFont::chwUni(210);
                break;
            case "&#7843;":
                $_retval = ConvertFont::chwUni(97) . ConvertFont::chwUni(210);
                break;
            case "&Atilde;":
                $_retval = ConvertFont::chwUni(65) . ConvertFont::chwUni(222);
                break;
            case "&atilde;":
                $_retval = ConvertFont::chwUni(97) . ConvertFont::chwUni(222);
                break;
            case "&#7840;":
                $_retval = ConvertFont::chwUni(65) . ConvertFont::chwUni(242);
                break;
            case "&#7841;":
                $_retval = ConvertFont::chwUni(97) . ConvertFont::chwUni(242);
                //A^
                break;
            case "&#7844;":
                $_retval = ConvertFont::chwUni(194) . ConvertFont::chwUni(236);
                break;
            case "&#7845;":
                $_retval = ConvertFont::chwUni(226) . ConvertFont::chwUni(236);
                break;
            case "&#7846;":
                $_retval = ConvertFont::chwUni(194) . ConvertFont::chwUni(204);
                break;
            case "&#7847;":
                $_retval = ConvertFont::chwUni(226) . ConvertFont::chwUni(204);
                break;
            case "&#7848;":
                $_retval = ConvertFont::chwUni(194) . ConvertFont::chwUni(210);
                break;
            case "&#7849;":
                $_retval = ConvertFont::chwUni(226) . ConvertFont::chwUni(210);
                break;
            case "&#7850;":
                $_retval = ConvertFont::chwUni(194) . ConvertFont::chwUni(222);
                break;
            case "&#7851;":
                $_retval = ConvertFont::chwUni(226) . ConvertFont::chwUni(222);
                break;
            case "&#7852;":
                $_retval = ConvertFont::chwUni(194) . ConvertFont::chwUni(242);
                break;
            case "&#7853;":
                $_retval = ConvertFont::chwUni(226) . ConvertFont::chwUni(242);
                //A(
                break;
            case "&#258;":
                $_retval = ConvertFont::chwUni(195);
                //a(
                break;
            case "&#259;":
                $_retval = ConvertFont::chwUni(227);
                break;
            case "&#7854;":
                $_retval = ConvertFont::chwUni(195) . ConvertFont::chwUni(236);
                break;
            case "&#7855;":
                $_retval = ConvertFont::chwUni(227) . ConvertFont::chwUni(236);
                break;
            case "&#7856;":
                $_retval = ConvertFont::chwUni(195) . ConvertFont::chwUni(204);
                break;
            case "&#7857;":
                $_retval = ConvertFont::chwUni(227) . ConvertFont::chwUni(204);
                break;
            case "&#7858;":
                $_retval = ConvertFont::chwUni(195) . ConvertFont::chwUni(210);
                break;
            case "&#7859;":
                $_retval = ConvertFont::chwUni(227) . ConvertFont::chwUni(210);
                break;
            case "&#7860;":
                $_retval = ConvertFont::chwUni(195) . ConvertFont::chwUni(222);
                break;
            case "&#7861;":
                $_retval = ConvertFont::chwUni(227) . ConvertFont::chwUni(222);
                break;
            case "&#7862;":
                $_retval = ConvertFont::chwUni(195) . ConvertFont::chwUni(242);
                //A( with dot
                break;
            case "&#7863;":
                $_retval = ConvertFont::chwUni(227) . ConvertFont::chwUni(242);
                //a( with dot
                //D
                break;
            case "&#272;":
                $_retval = ConvertFont::chwUni(208);
                //D with dash
                break;
            case "&#273;":
                $_retval = ConvertFont::chwUni(240);
                //d with dash
                //E
                break;
            case "&#7864;":
                $_retval = ConvertFont::chwUni(69) . ConvertFont::chwUni(242);
                break;
            case "&#7865;":
                $_retval = ConvertFont::chwUni(101) . ConvertFont::chwUni(242);
                break;
            case "&#7866;":
                $_retval = ConvertFont::chwUni(69) . ConvertFont::chwUni(210);
                break;
            case "&#7867;":
                $_retval = ConvertFont::chwUni(101) . ConvertFont::chwUni(210);
                break;
            case "&#7868;":
                $_retval = ConvertFont::chwUni(69) . ConvertFont::chwUni(222);
                break;
            case "&#7869;":
                $_retval = ConvertFont::chwUni(101) . ConvertFont::chwUni(222);
                //E^
                break;
            case "&#7870;":
                $_retval = ConvertFont::chwUni(202) . ConvertFont::chwUni(236);
                break;
            case "&#7871;":
                $_retval = ConvertFont::chwUni(234) . ConvertFont::chwUni(236);
                break;
            case "&#7872;":
                $_retval = ConvertFont::chwUni(202) . ConvertFont::chwUni(204);
                break;
            case "&#7873;":
                $_retval = ConvertFont::chwUni(234) . ConvertFont::chwUni(204);
                break;
            case "&#7874;":
                $_retval = ConvertFont::chwUni(202) . ConvertFont::chwUni(210);
                break;
            case "&#7875;":
                $_retval = ConvertFont::chwUni(234) . ConvertFont::chwUni(210);
                break;
            case "&#7876;":
                $_retval = ConvertFont::chwUni(202) . ConvertFont::chwUni(222);
                break;
            case "&#7877;":
                $_retval = ConvertFont::chwUni(234) . ConvertFont::chwUni(222);
                break;
            case "&#7878;":
                $_retval = ConvertFont::chwUni(202) . ConvertFont::chwUni(242);
                break;
            case "&#7879;":
                $_retval = ConvertFont::chwUni(234) . ConvertFont::chwUni(242);
                //i
                break;
            case "&Igrave;":
                $_retval = ConvertFont::chwUni(73) . ConvertFont::chwUni(204);
                break;
            case "&igrave;":
                $_retval = ConvertFont::chwUni(105) . ConvertFont::chwUni(204);
                break;
            case "&#7880;":
                $_retval = ConvertFont::chwUni(73) . ConvertFont::chwUni(210);
                break;
            case "&#7881;":
                $_retval = ConvertFont::chwUni(105) . ConvertFont::chwUni(210);
                break;
            case "&#7882;":
                $_retval = ConvertFont::chwUni(73) . ConvertFont::chwUni(242);
                break;
            case "&#7883;":
                $_retval = ConvertFont::chwUni(105) . ConvertFont::chwUni(242);
                break;
            case "&#296;":
                $_retval = ConvertFont::chwUni(73) . ConvertFont::chwUni(222);
                break;
            case "&#297;":
                $_retval = ConvertFont::chwUni(105) . ConvertFont::chwUni(222);
                //O
                break;
            case "&Ograve;":
                $_retval = ConvertFont::chwUni(79) . ConvertFont::chwUni(204);
                break;
            case "&ograve;":
                $_retval = ConvertFont::chwUni(111) . ConvertFont::chwUni(204);
                break;
            case "&#7884;":
                $_retval = ConvertFont::chwUni(79) . ConvertFont::chwUni(242);
                break;
            case "&#7885;":
                $_retval = ConvertFont::chwUni(111) . ConvertFont::chwUni(242);
                break;
            case "&#7886;":
                $_retval = ConvertFont::chwUni(79) . ConvertFont::chwUni(210);
                break;
            case "&#7887;":
                $_retval = ConvertFont::chwUni(111) . ConvertFont::chwUni(210);
                break;
            case "&Otilde;":
                $_retval = ConvertFont::chwUni(79) . ConvertFont::chwUni(222);
                break;
            case "&otilde;":
                $_retval = ConvertFont::chwUni(111) . ConvertFont::chwUni(222);
                //O^
                break;
            case "&#7888;":
                $_retval = ConvertFont::chwUni(212) . ConvertFont::chwUni(236);
                break;
            case "&#7889;":
                $_retval = ConvertFont::chwUni(244) . ConvertFont::chwUni(236);
                break;
            case "&#7890;":
                $_retval = ConvertFont::chwUni(212) . ConvertFont::chwUni(204);
                break;
            case "&#7891;":
                $_retval = ConvertFont::chwUni(244) . ConvertFont::chwUni(204);
                break;
            case "&#7892;":
                $_retval = ConvertFont::chwUni(212) . ConvertFont::chwUni(210);
                break;
            case "&#7893;":
                $_retval = ConvertFont::chwUni(244) . ConvertFont::chwUni(210);
                break;
            case "&#7894;":
                $_retval = ConvertFont::chwUni(212) . ConvertFont::chwUni(222);
                break;
            case "&#7895;":
                $_retval = ConvertFont::chwUni(244) . ConvertFont::chwUni(222);
                break;
            case "&#7896;":
                $_retval = ConvertFont::chwUni(212) . ConvertFont::chwUni(242);
                break;
            case "&#7897;":
                $_retval = ConvertFont::chwUni(244) . ConvertFont::chwUni(242);
                //O?
                break;
            case "&#416;":
                $_retval = ConvertFont::chwUni(213);
                break;
            case "&#417;":
                $_retval = ConvertFont::chwUni(245);
                break;
            case "&#7898;":
                $_retval = ConvertFont::chwUni(213) . ConvertFont::chwUni(236);
                break;
            case "&#7899;":
                $_retval = ConvertFont::chwUni(245) . ConvertFont::chwUni(236);
                break;
            case "&#7900;":
                $_retval = ConvertFont::chwUni(213) . ConvertFont::chwUni(204);
                break;
            case "&#7901;":
                $_retval = ConvertFont::chwUni(245) . ConvertFont::chwUni(204);
                break;
            case "&#7902;":
                $_retval = ConvertFont::chwUni(213) . ConvertFont::chwUni(210);
                break;
            case "&#7903;":
                $_retval = ConvertFont::chwUni(245) . ConvertFont::chwUni(210);
                break;
            case "&#7904;":
                $_retval = ConvertFont::chwUni(213) . ConvertFont::chwUni(222);
                break;
            case "&#7905;":
                $_retval = ConvertFont::chwUni(245) . ConvertFont::chwUni(222);
                break;
            case "&#7906;":
                $_retval = ConvertFont::chwUni(213) . ConvertFont::chwUni(242);
                break;
            case "&#7907;":
                $_retval = ConvertFont::chwUni(245) . ConvertFont::chwUni(242);
                //U
                break;
            case "&#360;":
                $_retval = ConvertFont::chwUni(85) . ConvertFont::chwUni(222);
                break;
            case "&#361;":
                $_retval = ConvertFont::chwUni(117) . ConvertFont::chwUni(222);
                break;
            case "&#7908;":
                $_retval = ConvertFont::chwUni(85) . ConvertFont::chwUni(242);
                break;
            case "&#7909;":
                $_retval = ConvertFont::chwUni(117) . ConvertFont::chwUni(242);
                break;
            case "&#7910;":
                $_retval = ConvertFont::chwUni(85) . ConvertFont::chwUni(210);
                break;
            case "&#7911;":
                $_retval = ConvertFont::chwUni(117) . ConvertFont::chwUni(210);
                //U?
                break;
            case "&#431;":
                $_retval = ConvertFont::chwUni(221);
                //U question
                break;
            case "&#432;":
                $_retval = ConvertFont::chwUni(253);
                //u question
                break;
            case "&#7912;":
                $_retval = ConvertFont::chwUni(221) . ConvertFont::chwUni(236);
                break;
            case "&#7913;":
                $_retval = ConvertFont::chwUni(253) . ConvertFont::chwUni(236);
                break;
            case "&#7914;":
                $_retval = ConvertFont::chwUni(221) . ConvertFont::chwUni(204);
                break;
            case "&#7915;":
                $_retval = ConvertFont::chwUni(253) . ConvertFont::chwUni(204);
                break;
            case "&#7916;":
                $_retval = ConvertFont::chwUni(221) . ConvertFont::chwUni(210);
                break;
            case "&#7917;":
                $_retval = ConvertFont::chwUni(253) . ConvertFont::chwUni(210);
                break;
            case "&#7918;":
                $_retval = ConvertFont::chwUni(221) . ConvertFont::chwUni(222);
                break;
            case "&#7919;":
                $_retval = ConvertFont::chwUni(253) . ConvertFont::chwUni(222);
                break;
            case "&#7920;":
                $_retval = ConvertFont::chwUni(221) . ConvertFont::chwUni(242);
                break;
            case "&#7921;":
                $_retval = ConvertFont::chwUni(253) . ConvertFont::chwUni(242);
                //Y
                break;
            case "&#7922;":
                $_retval = ConvertFont::chwUni(89) . ConvertFont::chwUni(204);
                break;
            case "&#7923;":
                $_retval = ConvertFont::chwUni(121) . ConvertFont::chwUni(204);
                break;
            case "&#7924;":
                $_retval = ConvertFont::chwUni(89) . ConvertFont::chwUni(242);
                break;
            case "&#7925;":
                $_retval = ConvertFont::chwUni(121) . ConvertFont::chwUni(242);
                break;
            case "&#7926;":
                $_retval = ConvertFont::chwUni(89) . ConvertFont::chwUni(210);
                break;
            case "&#7927;":
                $_retval = ConvertFont::chwUni(121) . ConvertFont::chwUni(210);
                break;
            case "&#7928;":
                $_retval = ConvertFont::chwUni(89) . ConvertFont::chwUni(222);
                break;
            case "&#7929;":
                $_retval = ConvertFont::chwUni(121) . ConvertFont::chwUni(222);
                break;
            case "&Yacute;":
                $_retval = ConvertFont::chwUni(89) . ConvertFont::chwUni(236);
                break;
            case "&yacute;":
                $_retval = ConvertFont::chwUni(121) . ConvertFont::chwUni(236);
                break;
            default:
                $_retval = $vInput;
                break;
        }
        return $_retval;
    }

    protected static function chwUni($int){
        if ($int > 127) // n?u d??ng m?? m? r?ng th?? d??ng h??m unichr (t? vi?t)
        {
            return Helpers::unichrConvertFont($int, '');
        } else {
            return chr($int);
        }
    }


    public static function ConvertCP1258ToUnicode($szInput)
    {
        if (!isset($szInput)) {
            return "";
        }
        $sInput = trim($szInput);
        if (strlen($sInput) == 0) {
            return "";
        }
        $sOutput = "";
        $sInput = $szInput;
        for ($i=0;$i<=mb_strlen($szInput);$i++){
            $sChar = mb_substr($sInput, 0, 1); // WARNING: assuming sInput is an external function
            if (ConvertFont::CheckCP1258Vowel($sChar)) {
                if (mb_strlen($sInput) > 1) {
                    $sNextChar = mb_substr($sInput, 1, 1); // WARNING: assuming CheckCP1258Vowel is an external array assuming sInput is an external function assuming sInput is an external function
                    // $check = false;
                    // if($sChar=="i")$check=true;
                    if (ConvertFont::CheckCP1258Accent($sNextChar)) {
                        //  if($check)\Debugbar::info("char:".$sChar."---".$sNextChar);
                        $sOutput .= ConvertFont::CDouble1258($sChar, $sNextChar); // WARNING: assuming CheckCP1258Accent is an external array assuming CDouble1258 is an external function
                        if (mb_strlen($sInput) > 2) {
                            $sInput = mb_substr($sInput, 2);
                        } else {
                            break;
                        }
                    } else {
                        $sOutput .= ConvertFont::CSingle1258($sChar); // WARNING: assuming CSingle1258 is an external array
                        $sInput = mb_substr($sInput, 1);
                    }
                } else {
                    $sOutput .= ConvertFont::CSingle1258($sChar); // WARNING: assuming CSingle1258 is an external array
                    break;
                }
            } else {
                $sOutput .= ConvertFont::CSingle1258($sChar); // WARNING: assuming CSingle1258 is an external array
                if (mb_strlen($sInput) > 1) {
                    $sInput = mb_substr($sInput, 1);
                } else {
                    break;
                }
            }
        }
        return $sOutput;
    }

    protected static function CheckCP1258Accent($szInput)
    {
        //check if an accent character is there
        switch (ConvertFont::ordutf8($szInput)) {
            case 204:
            case 236:
            case 210:
            case 222:
            case 242:
                $_retval = true;
                break;

            default:
                $_retval = false;
                break;
        }
        return $_retval;
    }

    protected static function ordutf8($string, &$offset=0) {
        $code = ord(substr($string, $offset,1));
        $bytesnumber=0;
        if ($code >= 128) {        //otherwise 0xxxxxxx
            if ($code < 224) $bytesnumber = 2;                //110xxxxx
            else if ($code < 240) $bytesnumber = 3;        //1110xxxx
            else if ($code < 248) $bytesnumber = 4;    //11110xxx
            $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) - ($bytesnumber > 3 ? 16 : 0);
            for ($i = 2; $i <= $bytesnumber; $i++) {
                $offset ++;
                $code2 = ord(substr($string, $offset, 1)) - 128;
                $codetemp = $codetemp*64 + $code2;
            }
            $code = $codetemp;
        }
        $offset += 1;
        if ($offset >= strlen($string)) $offset = -1;
        return $code;
    }

    protected static function CheckCP1258Vowel($szInput)
    {
        $sInput = $szInput;
        switch (ConvertFont::ordutf8($sInput)) {
            //A, A^, A(
            case 65:
            case 194:
            case 195:
                $_retval = true;
                //E,E^, I, Y
                break;
            case 69:
            case 202:
            case 73:
            case 89:
                $_retval = true;
                //O, O^, O?
                break;
            case 79:
            case 212:
            case 213:
                $_retval = true;
                //U, U?
                break;
            case 85:
            case 221:
                $_retval = true;
                //a, a^, a(
                break;
            case 97:
            case 226:
            case 227:
                $_retval = true;
                //e,e^, i, y
                break;
            case 101:
            case 234:
            case 105:
            case 121:
                $_retval = true;
                //o, o^, o?
                break;
            case 111:
            case 244:
            case 245:
                $_retval = true;
                //u, u?
                break;
            case 117:
            case 253:
                $_retval = true;
                break;

            default:
                $_retval = false;
                break;
        }
        return $_retval;
    }

    protected static function CSingle1258($szInput)
    {
        //input: single character (vowel and consonant)
        //output Unicode character
        $sInput = $szInput;
        $offset = 0;
        switch (ConvertFont::ordutf8($sInput,$offset)) {
            case 227:
                //a(
                $sResult = "&#259;";
                break;
            case 195:
                //A(
                $sResult = "&#258;";
                break;
            case 208:
                //D with dash
                $sResult = "&#272;";
                break;
            case 240:
                //d with dash
                $sResult = "&#273;";
                break;
            case 245:
                //o)
                $sResult = "&#417;";
                break;
            case 213:
                //O)
                $sResult = "&#416;";
                break;
            case 221:
                //U)
                $sResult = "&#431;";
                break;
            case 253:
                //u)
                $sResult = "&#432;";
                break;
//            case 58:
//                $sResult = "&agrave;";
//                break;
            default:
                $sResult = $sInput;
                break;
        }
        return $sResult;
    }

    protected static function CDouble1258($szVowel, $szAccent)
    {
        //input : a vowel and its accent
        //output: Unicode equivalent
        $sChar = $szVowel;
        $sNextChar = $szAccent;
        $sOutput="";
        //a:97, o:111, e:101, u:117, A:65, I:73, O: 79, E:69, U:85
        switch (ConvertFont::ordutf8($sChar)) {
            //A
            case 65:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //grave
                    case 204:
                        $sOutput = "&Agrave;";//� -- chr(192);
                        //acute
                        break;

                    case 236:
                        $sOutput = "&Aacute;";//�-- chr(193);
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7842;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&Atilde;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7840;";
                        break;
                }
                //a
                break;

            case 97:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //grave

                    case 204:
                        //�
                        $sOutput = "&agrave;";//chr(224);
                        //acute
                        break;

                    case 236:
                        $sOutput = "&aacute;";//chr(225);
                        //�
                        break;

                    case 210:
                        $sOutput = "&#7843;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&atilde;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7841;";
                        break;
                }
                //A^
                break;

            case 194:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //grave

                    case 204:
                        $sOutput = "&#7846;";
                        //acute
                        break;

                    case 236:
                        $sOutput = "&#7844;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7848;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7850;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7852;";
                        break;
                }
                //a^
                break;

            case 226:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //grave

                    case 204:
                        $sOutput = "&#7847;";
                        //acute
                        break;

                    case 236:
                        $sOutput = "&#7845;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7849;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7851;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7853;";
                        break;
                }
                //A(
                break;

            case 195:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //grave

                    case 204:
                        $sOutput = "&#7856;";
                        //acute
                        break;

                    case 236:
                        $sOutput = "&#7854;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7858;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7860;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7862;";
                        break;
                }
                //a(
                break;

            case 227:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //grave

                    case 204:
                        $sOutput = "&#7857;";
                        //acute
                        break;

                    case 236:
                        $sOutput = "&#7855;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7859;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7861;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7863;";
                        break;
                }
                //E
                break;

            case 69:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //grave

                    case 204:
                        $sOutput = "&Egrave;";//� - chr(200);
                        //acute
                        break;

                    case 236:
                        $sOutput = "&Eacute;";//� - chr(201);
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7866;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7868;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7864;";
                        break;
                }
                //e
                break;

            case 101:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //grave
                    case 204:
                        $sOutput = "&egrave;";//chr(232);
                        //acute
                        break;

                    case 236:
                        //�
                        $sOutput = "&eacute;";//chr(233);
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7867;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7869;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7865;";
                        break;
                }
                //E^
                break;

            case 202:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&#7870;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7872;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7874;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7876;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7878;";
                        break;
                }
                //e^
                break;

            case 234:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&#7871;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7873;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7875;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7877;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7879;";
                        break;
                }
                //I
                break;

            case 73:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&Iacute;"; //� chr(205);
                        //grave
                        break;

                    case 204:
                        $sOutput = "&Igrave;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7880;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#296;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7882;";
                        break;

                    default:
                        $sOutput = $sChar;
                        break;
                }
                //i
                break;

            case 105:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&iacute;";//chr(237);
                        //grave
                        break;

                    case 204:
                        $sOutput = "&igrave;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7881;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#297;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7883;";
                        break;
                }
                //O
                break;

            case 79:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&Oacute;";//� -- chr(211);
                        //grave
                        break;

                    case 204:
                        $sOutput = "&Ograve;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7886;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&Otilde;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7884;";
                        break;
                }
                //o
                break;

            case 111:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute
                    case 236:
                        $sOutput = "&oacute;";//chr(243);
                        //grave
                        break;

                    case 204:
                        $sOutput = "&ograve;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7887;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&otilde;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7885;";
                        break;
                }
                //O^
                break;

            case 212:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&#7888;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7890;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7892;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7894;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7896;";
                        break;
                }
                //o^
                break;

            case 244:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&#7889;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7891;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7893;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7895;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7897;";
                        break;
                }
                //O)
                break;

            case 213:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&#7898;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7900;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7902;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7904;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7906;";
                        break;
                }
                //o)
                break;

            case 245:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&#7899;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7901;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7903;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7905;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7907;";
                        break;
                }
                //U
                break;

            case 85:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&Uacute;";//� - chr(218);
                        //grave
                        break;

                    case 204:
                        $sOutput = chr(217);
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7910;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#360;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7908;";
                        break;
                }
                //u
                break;

            case 117:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute
                    case 236:
                        $sOutput = "&uacute;";//� -- chr(250);
                        //grave
                        break;

                    case 204:
                        $sOutput = "&ugrave;";//� -- chr(249);
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7911;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#361;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7909;";
                        break;
                }
                //U)
                break;

            case 221:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&#7912;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7914;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7916;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7918;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7920;";
                        break;
                }
                //u)
                break;

            case 253:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&#7913;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7915;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7917;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7919;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7921;";
                        break;

                    default:
                        $sOutput = "&#432;" . $sNextChar;
                        break;
                }
                //Y
                break;

            case 89:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&Yacute;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7922;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7926;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7928;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7924;";
                        break;
                }
                //y
                break;

            case 121:
                switch (ConvertFont::ordutf8($sNextChar)) {
                    //acute

                    case 236:
                        $sOutput = "&yacute;";
                        //grave
                        break;

                    case 204:
                        $sOutput = "&#7923;";
                        //question
                        break;

                    case 210:
                        $sOutput = "&#7927;";
                        //tilde
                        break;

                    case 222:
                        $sOutput = "&#7929;";
                        //dot
                        break;

                    case 242:
                        $sOutput = "&#7925;";
                        break;
                }
                break;
        }
        return $sOutput;
    }

    protected static function _instr($start, $str1, $str2, $mode)
    {
        if ($mode) {
            $str1 = strtolower($str1);
            $str2 = strtolower($str2);
        }
        $retval = strpos($str1, $str2, $start);
        return ($retval === false) ? 0 : $retval + 1;
    }

}