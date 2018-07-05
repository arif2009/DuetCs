<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DuetCS {
        function email_send($to,$from,$name,$subject,$message){
            $CI = &get_instance();
            // setup config setting
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'mail.duetcs.org', //your mail host url
                'smtp_port' => 26,  //Your smtp port
                'smtp_user' => 'cs@duetcs.org',    //your Email
                'smtp_pass' => 'fQssXLK4uKQm'   //your password
            );
            $CI->load->library('email', $config);
            //prepare to send email
            $CI->email->from($from, $name);
            $CI->email->to($to);
            $CI->email->subject($subject);
            $CI->email->message($message);
            //send mail
            if($CI->email->send()){
                return TRUE;
            }else {
                return FALSE;
            }
        }
        /***
         * It return false if uri segment not found
         */
        function get_privious_uri_segment($segment){
            $previousURL = (!empty($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER'] : FALSE;
            $baseUrlLength = strlen(base_url());
            if($previousURL){
                $uriSegmentsArray = explode('/', substr($previousURL, $baseUrlLength));
                if(!empty($uriSegmentsArray[$segment-1]))
                    return $uriSegmentsArray[$segment-1];
                else
                    return FALSE;
                
            }else
                return FALSE; 
        }
        //Ashis
    function FindLink($text){
            //this function for identify link and new line
            $post_body='';
            $rexProtocol = '(https?://)?';
            $rexDomain   = '((?:[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63}|(?:[0-9]{1,3}\.){3}[0-9]{1,3})';
            $rexPort     = '(:[0-9]{1,5})?';
            $rexPath     = '(/[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]*?)?';
            $rexQuery    = '(\?[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
            $rexFragment = '(#[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
            $validTlds = array_fill_keys(explode(" ", ".aero .asia .biz .cat .com .coop .edu .gov .info .int .jobs .mil .mobi .museum .name .net .org .pro .tel .travel .ac .ad .ae .af .ag .ai .al .am .an .ao .aq .ar .as .at .au .aw .ax .az .ba .bb .bd .be .bf .bg .bh .bi .bj .bm .bn .bo .br .bs .bt .bv .bw .by .bz .ca .cc .cd .cf .cg .ch .ci .ck .cl .cm .cn .co .cr .cu .cv .cx .cy .cz .de .dj .dk .dm .do .dz .ec .ee .eg .er .es .et .eu .fi .fj .fk .fm .fo .fr .ga .gb .gd .ge .gf .gg .gh .gi .gl .gm .gn .gp .gq .gr .gs .gt .gu .gw .gy .hk .hm .hn .hr .ht .hu .id .ie .il .im .in .io .iq .ir .is .it .je .jm .jo .jp .ke .kg .kh .ki .km .kn .kp .kr .kw .ky .kz .la .lb .lc .li .lk .lr .ls .lt .lu .lv .ly .ma .mc .md .me .mg .mh .mk .ml .mm .mn .mo .mp .mq .mr .ms .mt .mu .mv .mw .mx .my .mz .na .nc .ne .nf .ng .ni .nl .no .np .nr .nu .nz .om .pa .pe .pf .pg .ph .pk .pl .pm .pn .pr .ps .pt .pw .py .qa .re .ro .rs .ru .rw .sa .sb .sc .sd .se .sg .sh .si .sj .sk .sl .sm .sn .so .sr .st .su .sv .sy .sz .tc .td .tf .tg .th .tj .tk .tl .tm .tn .to .tp .tr .tt .tv .tw .tz .ua .ug .uk .us .uy .uz .va .vc .ve .vg .vi .vn .vu .wf .ws .ye .yt .yu .za .zm .zw .xn--0zwm56d .xn--11b5bs3a9aj6g .xn--80akhbyknj4f .xn--9t4b11yi5a .xn--deba0ad .xn--g6w251d .xn--hgbk6aj7f53bba .xn--hlcj6aya9esc7a .xn--jxalpdlp .xn--kgbechtv .xn--zckzah .arpa"), true);
            $position = 0;
            while (preg_match("{\\b$rexProtocol$rexDomain$rexPort$rexPath$rexQuery$rexFragment(?=[?.!,;:\"]?(\s|$))}", $text, $match, PREG_OFFSET_CAPTURE, $position)){
                list($url, $urlPosition) = $match[0];
                // Print the text leading up to the URL.
                $beforeLink=substr($text, $position, $urlPosition - $position);
                $beforeLink=nl2br($beforeLink);
                //$post_body = $beforeLink;
                echo $beforeLink;
                $domain = $match[2][0];
                $port   = $match[3][0];
                $path   = $match[4][0];
                    // Check if the TLD is valid - or that $domain is an IP address.
                $tld = strtolower(strrchr($domain, '.'));
                if (preg_match('{\.[0-9]{1,3}}', $tld) || isset($validTlds[$tld])){
                // Prepend http:// if no protocol specified
                $completeUrl = $match[1][0] ? $url : "http://$url";
                // Print the hyperlink.
                //$post_body .= '<a href="'.htmlspecialchars($completeUrl).'">'.htmlspecialchars("$domain$port$path").'</a>';
                printf('<a href="%s">%s</a>', htmlspecialchars($completeUrl), htmlspecialchars("$domain$port$path"));
                }
                else{
                    // Not a valid URL.
                        //$post_body .= htmlspecialchars($url);
                        print(htmlspecialchars($url));
                }
                // Continue text parsing from after the URL.
                $position = $urlPosition + strlen($url);
            }
        // Print the remainder of the text.
            $afterLink=substr($text, $position);
            $afterLink=nl2br($afterLink);
            $post_body .= $afterLink;
            echo $post_body;
            //return $post_body;
    }
        //Ashis End
}
