<?php
/*
Plugin Name: Jarila! Ads
Plugin URI: http://www.InternetDrops.com.br/jarila_ads
Description: Manages and publishes custom Mercado Livre and AdSense ads during the posting *** Gerencia a publica anúncios do Mercado Livre e AdSense durante o post.
Version: 1.0.2
Author: Internet Drops
Author URI: http://www.InternetDrops.com.br
*/


/*
Copyright (C) 2008 InternetDrops.com.br

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/*
    ***IMPORTANT***
    This plugin have a 5% (up to) of usage of your Mercado Livre ad traffic to
    automatically show ads using our ID. The rest of the traffic (97% of ML
    and 100% of Google AdSense) will use YOUR IDs. In other words, From 100
    Mercado Livre ads displayed on your website, up to 5 ads would contain our
    ID. This is the way we found to support the future development of this
    plugin and we believe that this method is a non-intrusive way to achieve
    this. Since this plugin was built to help you to make money from your
    website, it is fair enough to support us with a few coins. Please, do not
    disable this donation mode, otherwise, your website could be put on our
    Hall of Shame if caught by our spider. If you do not agree with this little
    donation request, please DO NOT USE THIS PLUGIN.

    Help us to help you make money!


    ***IMPORTANTE***
    Este plugin possui um mecanismo que utiliza até 5% da exibição de anúncios
    do Mercado Livre de seu website para mostrá-los com nosso ID. Os 97% restantes
    dos anúncios do Mercado Livre e 100% dos anúncios do Google AdSense serão
    exibidos utilizando os SEUS IDs. Em outras palavras, de 100 anúncios do Mercado
    Livre que você exibir em seu site, apenas 5 deles conterão nosso ID. Esta foi a
    maneira que encontramos para nos ajudar a desenvolver e evoluir este plugin,
    e acreditamos que esta é a maneira menos intrusiva de conseguir isto. E já
    que este plugin foi desenvolvido com o intuito de ajudar você a ganhar
    dinheiro com seu site, nada mais justo do que suportar o desenvolvimento
    deste plugin nos doando algumas moedas. Por favor, não desabilite este
    mecanismo de doação, ou você poderá fazer parte do nosso Muro da Vergonha
    caso seja identificado por nosso spider. Se você não concorda com este
    pequeno pedido de doação, por favor, NÃO USE ESTE PLUGIN!
    
    Ajude-nos a ajudar você a fazer dinheiro!


    InternetDrops.

*/
function jarila_product(){
  if(function_exists('add_options_page')){
    add_options_page('Jarila Ads', 'Jarila Ads', 9, basename(__FILE__), 'jarila_options_subpanel');
  }
}

switch($_POST['action']){
case 'Salvar':
  update_option('jarila_country', $_POST['jarila_country']);
  if ($_POST['jarila_country'] == 'BR') { update_option('jarila_ml_market', 'MLB'); }
  update_option('jarila_ml_site_id', $_POST['jarila_ml_site_id']);
  update_option('jarila_ml_border_color', $_POST['jarila_ml_border_color']);
  update_option('jarila_ml_image_border_color', $_POST['jarila_ml_image_border_color']);
  update_option('jarila_ml_text_size', $_POST['jarila_ml_text_size']);
  update_option('jarila_ml_text_color', $_POST['jarila_ml_text_color']);
  update_option('jarila_ml_text_bold', $_POST['jarila_ml_text_bold']);
  update_option('jarila_ml_price_size', $_POST['jarila_ml_price_size']);
  update_option('jarila_ml_price_color', $_POST['jarila_ml_price_color']);
  update_option('jarila_ml_price_bold', $_POST['jarila_ml_price_bold']);
  if (!empty($_POST['jarila_ga_ad1_name'])) { update_option('jarila_ga_ad1_name', $_POST['jarila_ga_ad1_name']); }
  if (!empty($_POST['jarila_ga_ad1_name'])) { update_option('jarila_ga_'.$_POST['jarila_ga_ad1_name'], $_POST['jarila_ga_ad1_code']); }
  if (!empty($_POST['jarila_ga_ad2_name'])) { update_option('jarila_ga_ad2_name', $_POST['jarila_ga_ad2_name']); }
  if (!empty($_POST['jarila_ga_ad2_name'])) { update_option('jarila_ga_'.$_POST['jarila_ga_ad2_name'], $_POST['jarila_ga_ad2_code']); }
  if (!empty($_POST['jarila_ga_ad3_name'])) { update_option('jarila_ga_ad3_name', $_POST['jarila_ga_ad3_name']); }
  if (!empty($_POST['jarila_ga_ad3_name'])) { update_option('jarila_ga_'.$_POST['jarila_ga_ad3_name'], $_POST['jarila_ga_ad3_code']); }
  if (!empty($_POST['jarila_ga_ad4_name'])) { update_option('jarila_ga_ad4_name', $_POST['jarila_ga_ad4_name']); }
  if (!empty($_POST['jarila_ga_ad4_name'])) { update_option('jarila_ga_'.$_POST['jarila_ga_ad4_name'], $_POST['jarila_ga_ad4_code']); }
  break;
}
function jarila_options_subpanel(){
  if(get_option('jarila_country', '') == '')  { update_option('jarila_country', 'BR'); }
  if(get_option('jarila_ml_border_color', "") == "")  { update_option("jarila_ml_border_color", "#000000"); }
  if(get_option('jarila_ml_image_border_color', "") == "")  { update_option("jarila_ml_image_border_color", "#FFFFFF"); }
  $jCountry          = get_option('jarila_country');
  $jMLSiteID         = get_option('jarila_ml_site_id');
  $jMLBorderColor    = get_option('jarila_ml_border_color');
  $jMLImgBorderColor = get_option('jarila_ml_image_border_color');
  $jMLTextSize       = get_option('jarila_ml_text_size');
  $jMLTextColor      = get_option('jarila_ml_text_color');
  $jMLTextBold       = get_option('jarila_ml_text_bold');
  $jMLPriceSize      = get_option('jarila_ml_price_size');
  $jMLPriceColor     = get_option('jarila_ml_price_color');
  $jMLPriceBold      = get_option('jarila_ml_price_bold');
  $jGAAd1Name        = get_option('jarila_ga_ad1_name');
  $jGAAd1Code        = get_option('jarila_ga_'.$jGAAd1Name);
  $jGAAd2Name        = get_option('jarila_ga_ad2_name');
  $jGAAd2Code        = get_option('jarila_ga_'.$jGAAd2Name);
  $jGAAd3Name        = get_option('jarila_ga_ad3_name');
  $jGAAd3Code        = get_option('jarila_ga_'.$jGAAd3Name);
  $jGAAd4Name        = get_option('jarila_ga_ad4_name');
  $jGAAd4Code        = get_option('jarila_ga_'.$jGAAd4Name);
?>
<div class="wrap">
  <h2><?php echo 'Jarila! Ads'; ?></h2>
  <form name="form1" method="post">
	<input type="hidden" name="stage" value="process" />

	<fieldset class="options">
    	<b>Como usar</b><br>
    	<ul>
    	<li>Você precisa de uma conta no programa Mercado Sócio do Mercado Livre (http://pmsapp.mercadolivre.com.br/jm/pms) e criar uma campanha para obter o seu ID</li>
    	<li>Configure abaixo o formato e aparência de seus anúncios.</li>
    	<li>Depois, é só ativar os anúncios equanto estiver publicando seus posts.</li>
        </ul>
		<table width="100%" cellspacing="2" cellpadding="5" class="editform">
               <tr><td colspan="2" bgcolor="#E5F3FF"><b>Mercado Livre</b></td></tr>
               <tr>
                   <th width="35%" scope="row" style="text-align:left"><?php echo 'País:'; ?></th>
                   <td>
                      <select name='jarila_country'>
                      <option value="BR" <?php if($jCountry == 'BR') echo "SELECTED"; ?> >BR
                      </select>
                   </td>
               </tr>
               <tr>
                   <th scope="row" style="text-align:left"><?php echo 'Código de Traqueamento do ML:'; ?></th>
                   <td><input type="text" name="jarila_ml_site_id" id="jarila_ml_site_id" cols="10" value="<?php echo $jMLSiteID; ?>"></td>
               </tr>
               <tr>
                   <th scope="row" style="text-align:left"><?php echo 'Cor da Borda do Anúncio:'; ?></th>
                   <td><input type="text" name="jarila_ml_border_color" id="jarila_ml_border_color" cols="6" value="<?php echo $jMLBorderColor; ?>">
                       <?php echo '(ex.: #FF00DD)'; ?></td>
               </tr>
                <tr>
                   <th scope="row" style="text-align:left"><?php echo 'Cor da Borda das Imagens:'; ?></th>
                   <td><input type="text" name="jarila_ml_image_border_color" id="jarila_ml_image_border_color" cols="6" value="<?php echo $jMLImgBorderColor; ?>">
                       <?php echo '(ex.: #FF00DD)'; ?></td>
               </tr>
                <tr>
                   <th scope="row" style="text-align:left"><?php echo 'Tamanho e Cor do Texto dos Produtos:'; ?></th>
                   <td><select name='jarila_ml_text_size'>
                      <option value="7px" <?php if($jMLTextSize == '7px') echo "SELECTED"; ?> >7px
                      <option value="8px" <?php if($jMLTextSize == '8px') echo "SELECTED"; ?> >8px
                      <option value="9px" <?php if($jMLTextSize == '9px') echo "SELECTED"; ?> >9px
                      <option value="10px" <?php if($jMLTextSize == '10px') echo "SELECTED"; ?> >10px
                      <option value="11px" <?php if($jMLTextSize == '11px') echo "SELECTED"; ?> >11px
                      <option value="12px" <?php if($jMLTextSize == '12px') echo "SELECTED"; ?> >12px
                      <option value="13px" <?php if($jMLTextSize == '13px') echo "SELECTED"; ?> >13px
                      <option value="14px" <?php if($jMLTextSize == '14px') echo "SELECTED"; ?> >14px
                      <option value="15px" <?php if($jMLTextSize == '15px') echo "SELECTED"; ?> >15px
                      <option value="16px" <?php if($jMLTextSize == '16px') echo "SELECTED"; ?> >16px
                      </select>
                      &nbsp;
                      <input type="text" name="jarila_ml_text_color" id="jarila_ml_text_color" cols="6" value="<?php echo $jMLTextColor; ?>">
                      <?php echo '(ex.: #FF00DD)'; ?>
                      &nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name="jarila_ml_text_bold" <?php if ($jMLTextBold) echo "checked=\"1\""; ?>/>
                      <?php echo 'Negrito'; ?>
                      
                   </td>
               </tr>
               <tr>
                   <th width="30%" scope="row" style="text-align:left"><?php echo 'Tamanho e Cor do Preço dos Produtos:'; ?></th>
                   <td><select name='jarila_ml_price_size'>
                      <option value="7px" <?php if($jMLPriceSize == '7px') echo "SELECTED"; ?> >7px
                      <option value="8px" <?php if($jMLPriceSize == '8px') echo "SELECTED"; ?> >8px
                      <option value="9px" <?php if($jMLPriceSize == '9px') echo "SELECTED"; ?> >9px
                      <option value="10px" <?php if($jMLPriceSize == '10px') echo "SELECTED"; ?> >10px
                      <option value="11px" <?php if($jMLPriceSize == '11px') echo "SELECTED"; ?> >11px
                      <option value="12px" <?php if($jMLPriceSize == '12px') echo "SELECTED"; ?> >12px
                      <option value="13px" <?php if($jMLPriceSize == '13px') echo "SELECTED"; ?> >13px
                      <option value="14px" <?php if($jMLPriceSize == '14px') echo "SELECTED"; ?> >14px
                      <option value="15px" <?php if($jMLPriceSize == '15px') echo "SELECTED"; ?> >15px
                      <option value="16px" <?php if($jMLPriceSize == '16px') echo "SELECTED"; ?> >16px
                      </select>
                      &nbsp;
                      <input type="text" name="jarila_ml_price_color" id="jarila_ml_price_color" cols="6" value="<?php echo $jMLPriceColor; ?>">
                      <?php echo '(ex.: #FF00DD)'; ?>
                      &nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name="jarila_ml_price_bold" <?php if ($jMLPriceBold) echo "checked=\"1\""; ?>/>
                      <?php echo 'Negrito'; ?>
                   </td>
               </tr>
		</table>
		<table width="100%" cellspacing="2" cellpadding="5" class="editform">
               <tr><td colspan="3" bgcolor="#E5F3FF"><b>Google AdSense</b></td></tr>
               <tr><td colspan="3">Aqui você dá nome aos seus anúncios criados no Google AdSense e cola o respectivo código na caixa ao lado.
                                   Coloque quantos anúncios quiser (até 4), que eles depois aparecerão durante a edição do post, onde você
                                   poderá escolher o mais apropiado. Para criar seus anúncios, vá primeiro à sua conta no
                                   <a href="https://www.google.com/adsense/adsense-products">Google AdSense.</a><br><br>
                                   <b>ATENÇÃO:</b> Uma vez dado o nome para um banner, este nome não poderá mais ser trocado!</td>
               </tr>
               <tr valign="center">
                   <th width="30%" scope="row" style="text-align:left"><?php echo 'Anúncio #1:'; ?></th>
                   <td><input type="text" name="jarila_ga_ad1_name" id="jarila_ga_ad1_name" cols="10" value="<?php echo $jGAAd1Name; ?>" <?php if (!empty($jGAAd1Name)) {echo 'disabled';}?> ></td>
                   <td width="60%"><textarea style="width:250px;" name="jarila_ga_ad1_code" id="jarila_ga_ad1_code" rows="6" cols="20"><?php echo $jGAAd1Code; ?></textarea></td>
               </tr>
               <tr valign="center">
                   <th width="30%" scope="row" style="text-align:left"><?php echo 'Anúncio #2:'; ?></th>
                   <td><input type="text" name="jarila_ga_ad2_name" id="jarila_ga_ad2_name" cols="10" value="<?php echo $jGAAd2Name; ?>" <?php if (!empty($jGAAd2Name)) {echo 'disabled';}?>></td>
                   <td width="60%"><textarea style="width:250px;" name="jarila_ga_ad2_code" id="jarila_ga_ad2_code" rows="6" cols="20"><?php echo $jGAAd2Code; ?></textarea></td>
               </tr>
               <tr valign="center">
                   <th width="30%" scope="row" style="text-align:left"><?php echo 'Anúncio #3:'; ?></th>
                   <td><input type="text" name="jarila_ga_ad3_name" id="jarila_ga_ad3_name" cols="10" value="<?php echo $jGAAd3Name; ?>" <?php if (!empty($jGAAd3Name)) {echo 'disabled';}?>></td>
                   <td width="60%"><textarea style="width:250px;" name="jarila_ga_ad3_code" id="jarila_ga_ad3_code" rows="6" cols="20"><?php echo $jGAAd3Code; ?></textarea></td>
               </tr>
                 <tr valign="center">
                   <th width="30%" scope="row" style="text-align:left"><?php echo 'Anúncio #4:'; ?></th>
                   <td><input type="text" name="jarila_ga_ad4_name" id="jarila_ga_ad4_name" cols="10" value="<?php echo $jGAAd4Name; ?>" <?php if (!empty($jGAAd4Name)) {echo 'disabled';}?>></td>
                   <td width="60%"><textarea style="width:250px;" name="jarila_ga_ad4_code" id="jarila_ga_ad4_code" rows="6" cols="20"><?php echo $jGAAd4Code; ?></textarea></td>
               </tr>
               
               <tr><td align=right colspan=3><input type="submit" name="action" value="<?php echo 'Salvar'; ?>" /></td></tr>
		</table>
	</fieldset>
  </form> 
</div>
<?php 
}
function jarila_post_preferences_ui() {
    global $post;
    $post_id = $post;
    if (is_object($post_id)) {  $post_id = $post_id->ID; }
    $jMLIWantAds = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ml_i_want_ads', true)));
    $jMLHowManyAds = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ml_howmany_ads', true)));
    $jMLHowManyLines = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ml_howmany_lines', true)));
    $jMLKeyword = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ml_keyword', true)));
    $jMLOrderBy = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ml_order_by', true)));
    $jMLPosition = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ml_position', true)));
    $jGAIWantAds = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ga_i_want_ads', true)));
    $jGAWhichAd = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ga_which_ad', true)));
    $jGAPosition = htmlspecialchars(stripcslashes(get_post_meta($post_id, 'jarila_ga_position', true)));
	?>
	<input value="jarila_edit_mode" type="hidden" name="jarila_edit_mode" />
	<table style="margin-bottom:40px;">
	       <tr><td colspan="2"><h3 class="dbx-handle"><?php echo 'Jarila! Ads'; ?></h3></td></tr>
           <tr>
           <td colspan="2"><input type="checkbox" name="jarila_ml_i_want_ads" <?php if ($jMLIWantAds) echo "checked=\"1\""; ?>/><b>
               <?php echo 'Ativar anúncios do Mercado Livre'; ?></b>
           </td>
           </tr>
           <tr>
               <th scope="row" style="text-align:left"><?php echo 'Quantos Produtos a Exibir:'; ?></th>
               <td>
                  <select name='jarila_ml_howmany_ads'>
                  <option value="1" <?php if($jMLHowManyAds == '1') echo "SELECTED"; ?> >1
                  <option value="2" <?php if($jMLHowManyAds == '2') echo "SELECTED"; ?> >2
                  <option value="3" <?php if($jMLHowManyAds == '3') echo "SELECTED"; ?> >3
                  <option value="4" <?php if($jMLHowManyAds == '4') echo "SELECTED"; ?> >4
                  <option value="5" <?php if($jMLHowManyAds == '5') echo "SELECTED"; ?> >5
                  <option value="6" <?php if($jMLHowManyAds == '6') echo "SELECTED"; ?> >6
                  <option value="7" <?php if($jMLHowManyAds == '7') echo "SELECTED"; ?> >7
                  <option value="8" <?php if($jMLHowManyAds == '8') echo "SELECTED"; ?> >8
                  <option value="9" <?php if($jMLHowManyAds == '9') echo "SELECTED"; ?> >9
                  <option value="10" <?php if($jMLHowManyAds == '10') echo "SELECTED"; ?> >10
                  </select>
               </td>
           </tr>
           <tr valign="top">
               <th scope="row" style="text-align:left"><?php echo 'Quantas Linhas no Anúncio:'; ?></th>
               <td>
                  <select name='jarila_ml_howmany_lines'>
                  <option value="1" <?php if($jMLHowManyLines == '1') echo "SELECTED"; ?> >1
                  <option value="2" <?php if($jMLHowManyLines == '2') echo "SELECTED"; ?> >2
                  <option value="3" <?php if($jMLHowManyLines == '3') echo "SELECTED"; ?> >3
                  <option value="4" <?php if($jMLHowManyLines == '4') echo "SELECTED"; ?> >4
                  <option value="5" <?php if($jMLHowManyLines == '5') echo "SELECTED"; ?> >5
                  <option value="6" <?php if($jMLHowManyLines == '6') echo "SELECTED"; ?> >6
                  <option value="7" <?php if($jMLHowManyLines == '7') echo "SELECTED"; ?> >7
                  <option value="8" <?php if($jMLHowManyLines == '8') echo "SELECTED"; ?> >8
                  <option value="9" <?php if($jMLHowManyLines == '9') echo "SELECTED"; ?> >9
                  <option value="10" <?php if($jMLHowManyLines == '10') echo "SELECTED"; ?> >10
                  </select>
                  <i>* IMPORTANTE: O limite máximo para um anúncio é de 10 produtos (Linhas X Produtos).</i>
               </td>
           </tr>
           <tr valign="top">
               <th scope="row" style="text-align:left"><?php echo 'Palavra-Chave para Busca de Produtos:'; ?></th>
               <td><input type="text" name="jarila_ml_keyword" id="jarila_ml_keyword" cols="10" value="<?php echo $jMLKeyword; ?>">
               <?php echo '<i>* Use uma ou mais palavras (ex: dvd seinfeld)</i>'; ?></td>
           </tr>
           <tr valign="top">
               <th scope="row" style="text-align:left"><?php echo 'Classificação dos Produtos:'; ?></th>
               <td>
                  <select name='jarila_ml_order_by'>
                  <option value="HIT_PAGE" <?php if($jMLOrderBy == 'HIT_PAGE') echo "SELECTED"; ?> >Mais Visitados
                  <option value="MAS_OFERTADOS" <?php if($jMLOrderBy == 'MAS_OFERTADOS') echo "SELECTED"; ?> >Mais Comprados
                  <option value="BARATOS" <?php if($jMLOrderBy == 'BARATOS') echo "SELECTED"; ?> >Mais Baratos
                  <option value="CAROS" <?php if($jMLOrderBy == 'CAROS') echo "SELECTED"; ?> >Mais Caros
                  </select>
               </td>
           </tr>
           <tr valign="top">
               <th scope="row" style="text-align:left"><?php echo 'Posição dos Anúncios:'; ?></th>
               <td>
                  <select name='jarila_ml_position'>
                  <option value="TOP" <?php if($jMLPosition == 'TOP') echo "SELECTED"; ?> >Acima do Post
                  <option value="BOTTOM" <?php if($jMLPosition == 'BOTTOM') echo "SELECTED"; ?> >Abaixo do Post
                  <option value="LEFT" <?php if($jMLPosition == 'LEFT') echo "SELECTED"; ?> >À Esquerda do Post
                  <option value="RIGHT" <?php if($jMLPosition == 'RIGHT') echo "SELECTED"; ?> >À Direita do Post
                  </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="button" name="test" value="<?php echo 'Testar Palavras'; ?>" style="background-color:#247FAB; color:white;"
                         onclick="javascript:window.open('http://lista.mercadolivre.com.br/'+document.getElementById('jarila_ml_keyword').value,'mywindow','status=0,scrollbars=1');" />
               </td>
           </tr>
           <tr><td>&nbsp;</td></tr>
           <tr>
           <td colspan="2"><input type="checkbox" name="jarila_ga_i_want_ads" <?php if ($jGAIWantAds) echo "checked=\"1\""; ?>/><b>
               <?php echo 'Ativar anúncios do Google AdSense'; ?></b>
           </td>
           </tr>
           <tr valign="top">
               <th scope="row" style="text-align:left"><?php echo 'Exibir Qual Banner?'; ?></th>
               <td>
                  <select name='jarila_ga_which_ad'>
                  <?php
                  $banner1 = get_option('jarila_ga_ad1_name');
                  if (!empty($banner1)) { echo '<option value="'.$banner1.'" '.($jGAWhichAd == $banner1 ? 'selected':'').'>'.$banner1; }
                  $banner2 = get_option('jarila_ga_ad2_name');
                  if (!empty($banner2)) { echo '<option value="'.$banner2.'" '.($jGAWhichAd == $banner2 ? 'selected':'').'>'.$banner2; }
                  $banner3 = get_option('jarila_ga_ad3_name');
                  if (!empty($banner3)) { echo '<option value="'.$banner3.'" '.($jGAWhichAd == $banner3 ? 'selected':'').'>'.$banner3; }
                  $banner4 = get_option('jarila_ga_ad4_name');
                  if (!empty($banner4)) { echo '<option value="'.$banner4.'" '.($jGAWhichAd == $banner4 ? 'selected':'').'>'.$banner4; }
                  ?>
                  </select>
               </td>
           </tr>
           <tr valign="top">
               <th scope="row" style="text-align:left"><?php echo 'Posição do Anúncio:'; ?></th>
               <td>
                  <select name='jarila_ga_position'>
                  <option value="TOP" <?php if($jGAPosition == 'TOP') echo "SELECTED"; ?> >Acima do Post
                  <option value="BOTTOM" <?php if($jGAPosition == 'BOTTOM') echo "SELECTED"; ?> >Abaixo do Post
                  <option value="LEFT" <?php if($jGAPosition == 'LEFT') echo "SELECTED"; ?> >À Esquerda do Post
                  <option value="RIGHT" <?php if($jGAPosition == 'RIGHT') echo "SELECTED"; ?> >À Direita do Post
                  </select>
               </td>
           </tr>
	</table>
	<?php
}
function jarila_post_preferences_save($id) {
    $isEdit = $_POST["jarila_edit_mode"];
    if (isset($isEdit) && !empty($isEdit)) {

	    $jMLWantAds = $_POST["jarila_ml_i_want_ads"];
	    delete_post_meta($id, 'jarila_ml_i_want_ads');
	    if (isset($jMLWantAds) && !empty($jMLWantAds)) { add_post_meta($id, 'jarila_ml_i_want_ads', $jMLWantAds); }
	    $jMLHowManyAds = $_POST["jarila_ml_howmany_ads"];
	    delete_post_meta($id, 'jarila_ml_howmany_ads');
	    if (isset($jMLHowManyAds) && !empty($jMLHowManyAds) && !empty($jMLWantAds)) { add_post_meta($id, 'jarila_ml_howmany_ads', $jMLHowManyAds); }
	    $jMLKeyword = $_POST["jarila_ml_keyword"];
	    delete_post_meta($id, 'jarila_ml_keyword');
	    $jMLKeyword = str_replace(' ', '+', $jMLKeyword);
	    if (isset($jMLKeyword) && !empty($jMLKeyword) && !empty($jMLWantAds)) { add_post_meta($id, 'jarila_ml_keyword', $jMLKeyword); }
	    $jMLHowManyLines = $_POST["jarila_ml_howmany_lines"];
	    delete_post_meta($id, 'jarila_ml_howmany_lines');
	    if (isset($jMLHowManyLines) && !empty($jMLHowManyLines) && !empty($jMLWantAds)) { add_post_meta($id, 'jarila_ml_howmany_lines', $jMLHowManyLines); }
	    $jMLOrderBy = $_POST["jarila_ml_order_by"];
	    delete_post_meta($id, 'jarila_ml_order_by');
	    if (isset($jMLOrderBy) && !empty($jMLOrderBy) && !empty($jMLWantAds)) { add_post_meta($id, 'jarila_ml_order_by', $jMLOrderBy); } else { add_post_meta($id, 'jarila_ml_order_by', 'HIT_PAGE'); }
	    $jMLPosition = $_POST["jarila_ml_position"];
	    delete_post_meta($id, 'jarila_ml_position');
	    if (isset($jMLPosition) && !empty($jMLPosition) && !empty($jMLWantAds)) { add_post_meta($id, 'jarila_ml_position', $jMLPosition); } else { add_post_meta($id, 'jarila_ml_position', 'BOTTOM'); }
	    $jGAIWantAds = $_POST["jarila_ga_i_want_ads"];
	    delete_post_meta($id, 'jarila_ga_i_want_ads');
	    if (isset($jGAIWantAds) && !empty($jGAIWantAds)) { add_post_meta($id, 'jarila_ga_i_want_ads', $jGAIWantAds); }
	    $jGAWhichAd = $_POST["jarila_ga_which_ad"];
	    delete_post_meta($id, 'jarila_ga_which_ad');
	    if (isset($jGAWhichAd) && !empty($jGAWhichAd) && !empty($jGAIWantAds)) { add_post_meta($id, 'jarila_ga_which_ad', $jGAWhichAd); }
	    $jGAPosition = $_POST["jarila_ga_position"];
	    delete_post_meta($id, 'jarila_ga_position');
	    if (isset($jGAPosition) && !empty($jGAPosition) && !empty($jGAIWantAds)) { add_post_meta($id, 'jarila_ga_position', $jGAPosition); }
    }
}
function jarila_ad_content($content){
    global $post;
    if (is_object($post)) {  $postID = $post->ID; }
    $jMLIWantAds = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ml_i_want_ads', true)));
    $jMLHowManyAds = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ml_howmany_ads', true)));
    $jMLKeyword = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ml_keyword', true)));
    $jMLHowManyLines = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ml_howmany_lines', true)));
    $jMLOrderBy = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ml_order_by', true)));
    $jMLPosition = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ml_position', true)));
    $jGAIWantAds = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ga_i_want_ads', true)));
    $jGAWhichAd = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ga_which_ad', true)));
    $jGAPosition = htmlspecialchars(stripcslashes(get_post_meta($postID, 'jarila_ga_position', true)));
    $ads = '';
    if ($jMLIWantAds) {
        require_once('mercadolivre.inc.php');
        $ads = mercadoLivreAds( get_option('jarila_country'),
                                get_option('jarila_ml_site_id'),
                                $jMLHowManyAds,
                                $jMLKeyword,
                                $jMLHowManyLines,
                                $jMLOrderBy,
                                get_option('jarila_ml_border_color'),
                                get_option('jarila_ml_image_border_color'),
                                get_option('jarila_ml_text_size'),
                                get_option('jarila_ml_text_color'),
                                get_option('jarila_ml_text_bold'),
                                get_option('jarila_ml_price_size'),
                                get_option('jarila_ml_price_color'),
                                get_option('jarila_ml_price_bold')
                                );
        $ads = "\n<!-- Jarila! Ads - ML -->\n".$ads;
    }
    if ($jMLPosition=='TOP')          { $content = $ads.$content;
    } elseif ($jMLPosition=='BOTTOM') { $content = $content.$ads;
    } elseif ($jMLPosition=='LEFT')   { $content = '<table><tr><td valign="top">'.$ads.'</td><td valign="top">'.$content.'</td></tr></table>';
    } elseif ($jMLPosition=='RIGHT')  { $content = '<table><tr><td valign="top">'.$content.'</td><td valign="top">'.$ads.'</td></tr></table>'; }
    $ads = '';
    if ($jGAIWantAds) {
        $ads = stripslashes( get_option('jarila_ga_'.$jGAWhichAd) );
        $ads = "\n<!-- Jarila! Ads - GA -->\n".$ads;
    }
    if ($jGAPosition=='TOP')          { $content = $ads.$content;
    } elseif ($jGAPosition=='BOTTOM') { $content = $content.$ads;
    } elseif ($jGAPosition=='LEFT')   { $content = '<table><tr><td valign="top">'.$ads.'</td><td valign="top">'.$content.'</td></tr></table>';
    } elseif ($jGAPosition=='RIGHT')  { $content = '<table><tr><td valign="top">'.$content.'</td><td valign="top">'.$ads.'</td></tr></table>'; }
    return $content;
}
add_action('admin_menu', 'jarila_product');
add_action('simple_edit_form', 'jarila_post_preferences_ui');
add_action('edit_form_advanced', 'jarila_post_preferences_ui');
add_action('edit_page_form', 'jarila_post_preferences_ui');
add_action('edit_post', 'jarila_post_preferences_save');
add_action('publish_post', 'jarila_post_preferences_save');
add_action('save_post', 'jarila_post_preferences_save');
add_action('edit_page_form', 'jarila_post_preferences_save');
add_filter('the_content', 'jarila_ad_content');
?>
