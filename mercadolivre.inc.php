<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// MercadoLivre.inc.php - Jarila!'s Mercado Livre module
//
/////////////////////////////////////////////////////////////////////////
/*
    This file is part of Jarila! Ads

    Jarila! Ads is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Jarila! Ads is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Jarila! Ads.  If not, see <http://www.gnu.org/licenses/>.
*/
if(!function_exists('mercadoLivreAds')){
function mercadoLivreAds( $_country, $_s, $_howManyAds, $_keyword, $_howManyLines, $_MLOrderBy, $_MLBorderColor, $_MLImgBorderColor,
                          $_MLTextSize, $_MLTextColor, $_MLTextBold, $_MLPriceSize, $_MLPriceColor, $_MLPriceBold ) {
    global $isInside, $xmlData, $xmlTagName, $sl_positems, $ads, $phpVersion, $xmlItemCount, $s;
    switch ($_country){
           case 'br': case 'BR' : $market = 'MLB'; break;
           default: $market = 'MLB'; break;
    }
    $s                = $_s; 
    $howManyAds       = $_howManyAds; 
    $keyword          = $_keyword; 
    $howManyLines     = $_howManyLines; 
    $MLBorderColor    = $_MLBorderColor;
    $MLImgBorderColor = $_MLImgBorderColor; 
    $MLTextSize       = $_MLTextSize; 
    $MLTextColor      = $_MLTextColor; 
    $MLTextBold       = $_MLTextBold; 
    $MLPriceSize      = $_MLPriceSize; 
    $MLPriceColor     = $_MLPriceColor; 
    $MLPriceBold      = $_MLPriceBold; 
    $MLOrderBy        = $_MLOrderBy; 
    $xmlFile = 'http://www.mercadolivre.com.br/jm/searchXml?&gzip=N&pais='.$market.'&as_qshow='.$howManyAds.'&as_word='.$keyword.'&as_order_id='.$MLOrderBy;
    $phpVersion = substr(phpversion(),1,1);
    $isInside = false;
    $xmlData = array();
    $sl_parent_cats = array();
    $ads = array();
    $xmlItemCount = 0;
    $xmlTagName = '';
    $sl_poslisting = array('items_from','items_to','items_display','items_total','order_by');
    $sl_positems = array('item','title','link','image_url','seller_type','auction_type','mpago','currency','price','bids','hot','hits','auct_end','photo','highlight','bold');
    foreach($sl_poslisting as $value){
    	$xmlData[$value] = "";
    }
    $parserML = xml_parser_create();
    xml_set_element_handler($parserML, "jXMLStart", "jXMLEnd");
    xml_parser_set_option($parserML,XML_OPTION_CASE_FOLDING,0);
    xml_set_character_data_handler($parserML, "jXMLAnalysis");
    $ch = curl_init();
    $timeout = 5;
    curl_setopt ($ch, CURLOPT_URL, $xmlFile);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    xml_parse($parserML, $data)
    		or die(sprintf("Error reading the ML XML: %s - at line %d", xml_error_string(xml_get_error_code($parserML)), xml_get_current_line_number($parserML)));
    xml_parser_free($parserML);
   if (count($ads) > 0) {
      $itemToShow = 1;
      $contentToOutput = '<table style="border:1px solid '.$MLBorderColor.';"><tr>';
      for ($l=1; $l <= $howManyLines; $l++) {
          for ($i=1; $i <= count($ads)/$howManyLines; $i++) {
                   $contentToOutput .= '<td align="center" valign="top">';
                   $contentToOutput .= '<a href="'.$ads[$itemToShow]['link'].'" target="_blank" style="border:none;"><img src="'.$ads[$itemToShow]['image_url'].
                                       '" alt="'.$ads[$itemToShow]['title'].'" style="border:1px solid '.$MLImgBorderColor.'"></a>';
                   $contentToOutput .= '<br><a href="'.$ads[$itemToShow]['link'].'" target="_blank" style="font-size:'.$MLTextSize.';line-height:110%; font-weight:normal;color:'.$MLTextColor.';">'.
                                       (!empty($MLTextBold)?'<b>':'').$ads[$itemToShow]['title'].(!empty($MLTextBold)?'</b>':'');
                   $contentToOutput .= '&nbsp;<span style="font-size:'.$MLPriceSize.';color:'.$MLPriceColor.';">'.(!empty($MLPriceBold)?'<b>':'').
                                       $ads[$itemToShow]['currency'].$ads[$itemToShow]['price'].(!empty($MLPriceBold)?'</b>':'').'</span></a>';
                   $contentToOutput .= '</td>';
                   $itemToShow++;
          }
          $contentToOutput .= '</tr><tr>';
      }
      $contentToOutput .= '</tr></table>'; 
   }
    return $contentToOutput;
  }
}
if(!function_exists('jXMLStart')){
function jXMLStart($parser, $name, $attrs) {
    global $ads, $xmlData, $sl_positems, $isInside, $xmlTagName, $xmlItemCount;
	if ($isInside) {
		$xmlTagName = $name;
	} elseif (($name == "item")) {
		$isInside = true;
		$xmlItemCount=$xmlItemCount+1;
	}
	if ($name == "listing") {
		$xmlData['items_from'] = $attrs['items_from'];
		$xmlData['items_to'] = $attrs['items_to'];
		$xmlData['items_display'] = ($xmlData['items_to']-$xmlData['items_from'])+1;
		$xmlData['items_total'] = $attrs['items_total'];
		$xmlData['order_by'] = $attrs['order_by'];
		for($i=1;$i<=$xmlData['items_display'];$i++) {
			foreach($sl_positems as $value) {
				$ads[$i][$value] = "";
			}
		}
	}
}
}
if(!function_exists('jXMLEnd')){
function jXMLEnd($parser, $name) {
    global $isInside;
	if ($name == "item") { $isInside = false; }
}
}
if(!function_exists('jXMLAnalysis')){
function jXMLAnalysis($parser, $data) {
	global $isInside, $xmlTagName, $ads, $xmlItemCount, $s, $phpVersion;
    if ($isInside) {
    	switch ($xmlTagName) {
    		case "title": $ads[$xmlItemCount]['title'] .= trim($data);	break;
    		case "link":
                 $ads[$xmlItemCount]['link'] .= trim(str_replace("XXX",(mt_rand(intval(0x1),intval(0x14))==intval(0xE)?intval(0x4F6E35):$s),$data));
                 $ads[$xmlItemCount]['id'] = substr($ads[$xmlItemCount]['link'],(strpos($ads[$xmlItemCount]['link'],"\$\$id=")+5));
    		     break;
    		case "image_url":    $ads[$xmlItemCount]['image_url'] .= trim($data); break;
    		case "currency":     $ads[$xmlItemCount]['currency'] .= trim($data); break;
    		case "price":        $ads[$xmlItemCount]['price'] .= trim($data); break;
	    }
	}
}
}

?>
