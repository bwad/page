<?php
















/**
 * This is the base library of HTML elements for use in XHP. This includes all
 * non-deprecated tags and attributes. Elements in this file should stay as
 * close to spec as possible. Facebook-specific extensions should go into their
 * own elements.
 */
abstract class xhp_xhp__html_element extends \xhp_x__primitive{
























































































protected $tagName;

public function getID(){
return $this->requireUniqueID();
}

public function requireUniqueID(){
if(!($id=$this->getAttribute('id'))){
$this->setAttribute('id',$id=substr(md5(mt_rand(0,100000)),0,10));
}
return $id;
}

protected final function renderBaseAttrs(){
$buf='<'.$this->tagName;
foreach($this->getAttributes() as $key=>$val){
if($val!==null&&$val!==false){
if($val===true){
$buf.=' '.htmlspecialchars($key);
}else {
$buf.=' '.htmlspecialchars($key).'="'.htmlspecialchars($val,ENT_COMPAT).'"';
}
}
}
return $buf;
}

public function addClass($class){
$this->setAttribute('class',trim($this->getAttribute('class').' '.$class));
return $this;
}

public function conditionClass($cond,$class){
if($cond){
$this->addClass($class);
}
return $this;
}

protected function stringify(){
$buf=$this->renderBaseAttrs().'>';
foreach($this->getChildren() as $child){
$buf.=\xhp_xhp::renderChild($child);
}
$buf.='</'.$this->tagName.'>';
return $buf;
}protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('accesskey'=>array(1, null,null, 0),'class'=>array(1, null,null, 0),'contenteditable'=>array(2, null,null, 0),'contextmenu'=>array(1, null,null, 0),'dir'=>array(1, null,null, 0),'draggable'=>array(2, null,null, 0),'dropzone'=>array(1, null,null, 0),'hidden'=>array(2, null,null, 0),'id'=>array(1, null,null, 0),'inert'=>array(2, null,null, 0),'itemid'=>array(1, null,null, 0),'itemprop'=>array(1, null,null, 0),'itemref'=>array(1, null,null, 0),'itemscope'=>array(1, null,null, 0),'itemtype'=>array(1, null,null, 0),'lang'=>array(1, null,null, 0),'role'=>array(1, null,null, 0),'spellcheck'=>array(7, array('true', 'false'),null, 0),'style'=>array(1, null,null, 0),'tabindex'=>array(1, null,null, 0),'title'=>array(1, null,null, 0),'translate'=>array(7, array('yes', 'no'),null, 0),'onabort'=>array(1, null,null, 0),'onblur'=>array(1, null,null, 0),'oncancel'=>array(1, null,null, 0),'oncanplay'=>array(1, null,null, 0),'oncanplaythrough'=>array(1, null,null, 0),'onchange'=>array(1, null,null, 0),'onclick'=>array(1, null,null, 0),'onclose'=>array(1, null,null, 0),'oncontextmenu'=>array(1, null,null, 0),'oncuechange'=>array(1, null,null, 0),'ondblclick'=>array(1, null,null, 0),'ondrag'=>array(1, null,null, 0),'ondragend'=>array(1, null,null, 0),'ondragenter'=>array(1, null,null, 0),'ondragexit'=>array(1, null,null, 0),'ondragleave'=>array(1, null,null, 0),'ondragover'=>array(1, null,null, 0),'ondragstart'=>array(1, null,null, 0),'ondrop'=>array(1, null,null, 0),'ondurationchange'=>array(1, null,null, 0),'onemptied'=>array(1, null,null, 0),'onended'=>array(1, null,null, 0),'onerror'=>array(1, null,null, 0),'onfocus'=>array(1, null,null, 0),'oninput'=>array(1, null,null, 0),'oninvalid'=>array(1, null,null, 0),'onkeydown'=>array(1, null,null, 0),'onkeypress'=>array(1, null,null, 0),'onkeyup'=>array(1, null,null, 0),'onload'=>array(1, null,null, 0),'onloadeddata'=>array(1, null,null, 0),'onloadedmetadata'=>array(1, null,null, 0),'onloadstart'=>array(1, null,null, 0),'onmousedown'=>array(1, null,null, 0),'onmouseenter'=>array(1, null,null, 0),'onmouseleave'=>array(1, null,null, 0),'onmousemove'=>array(1, null,null, 0),'onmouseout'=>array(1, null,null, 0),'onmouseover'=>array(1, null,null, 0),'onmouseup'=>array(1, null,null, 0),'onmousewheel'=>array(1, null,null, 0),'onpause'=>array(1, null,null, 0),'onplay'=>array(1, null,null, 0),'onplaying'=>array(1, null,null, 0),'onprogress'=>array(1, null,null, 0),'onratechange'=>array(1, null,null, 0),'onreset'=>array(1, null,null, 0),'onresize'=>array(1, null,null, 0),'onscroll'=>array(1, null,null, 0),'onseeked'=>array(1, null,null, 0),'onseeking'=>array(1, null,null, 0),'onselect'=>array(1, null,null, 0),'onshow'=>array(1, null,null, 0),'onstalled'=>array(1, null,null, 0),'onsubmit'=>array(1, null,null, 0),'onsuspend'=>array(1, null,null, 0),'ontimeupdate'=>array(1, null,null, 0),'ontoggle'=>array(1, null,null, 0),'onvolumechange'=>array(1, null,null, 0),'onwaiting'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

/**
 * Subclasses of :xhp:html-singleton may not contain children. When
 * rendered they will be in singleton (<img />, <br />) form.
 */
abstract class xhp_xhp__html_singleton extends \xhp_xhp__html_element{


protected function &__xhpChildrenDeclaration() {static $_ = 0; return $_;}protected function stringify(){
return $this->renderBaseAttrs().'>';
}
}

/**
 * Subclasses of :xhp:pcdata-elements may contain only string children.
 */
abstract class xhp_xhp__pcdata_element extends \xhp_xhp__html_element{protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 2, null)); return $_;}

}

/**
 * Subclasses of :xhp:raw-pcdata-element must contain only string children.
 * However, the strings will not be escaped. This is intended for tags like
 * <script> or <style> whose content is interpreted literally by the browser.
 *
 * From section 6.2 of the HTML 4.01 spec: "Although the STYLE and SCRIPT
 * elements use CDATA for their data model, for these elements, CDATA must be
 * handled differently by user agents. Markup and entities must be treated as
 * raw text and passed to the application as is. The first occurrence of the
 * character sequence "</" (end-tag open delimiter) is treated as terminating
 * the end of the s content. In valid documents, this would be the end tag for
 * the element."
 */
abstract class xhp_xhp__raw_pcdata_element extends \xhp_xhp__pcdata_element{
protected function stringify(){
$buf=$this->renderBaseAttrs().'>';
foreach($this->getChildren() as $child){
if(!is_string($child)){
throw new XHPClassException($this,'Child must be a string');
}
$buf.=$child;
}
$buf.='</'.$this->tagName.'>';
return $buf;
}
}

/**
 * Below is a big wall of element definitions. These are the basic building
 * blocks of XHP pages.
 */
class xhp_a extends \xhp_xhp__html_element{





protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'interactive' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='a';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('download'=>array(1, null,null, 0),'href'=>array(1, null,null, 0),'hreflang'=>array(1, null,null, 0),'media'=>array(1, null,null, 0),'rel'=>array(1, null,null, 0),'target'=>array(1, null,null, 0),'type'=>array(1, null,null, 0),'name'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_abbr extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='abbr';
}

class xhp_address extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='address';
}

class xhp_area extends \xhp_xhp__html_singleton{






protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected $tagName='area';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('alt'=>array(1, null,null, 0),'coords'=>array(1, null,null, 0),'download'=>array(1, null,null, 0),'href'=>array(1, null,null, 0),'hreflang'=>array(2, null,null, 0),'media'=>array(1, null,null, 0),'rel'=>array(1, null,null, 0),'shape'=>array(7, array('circ', 'circle', 'default', 'poly', 'polygon', 'rect', 'rectangle'),null, 0),'target'=>array(1, null,null, 0),'type'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_article extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'sectioning' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='article';
}

class xhp_aside extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'sectioning' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='aside';
}

class xhp_audio extends \xhp_xhp__html_element{





protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'embedded' => 1,'interactive' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(4, array(4, array(1, 3, '\\xhp_source'),array(1, 3, '\\xhp_track')),array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))))); return $_;}
protected $tagName='audio';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('autoplay'=>array(2, null,null, 0),'controls'=>array(2, null,null, 0),'crossorigin'=>array(7, array('anonymous', 'use-credentials'),null, 0),'loop'=>array(2, null,null, 0),'mediagroup'=>array(1, null,null, 0),'muted'=>array(2, null,null, 0),'preload'=>array(7, array('none', 'metadata', 'auto'),null, 0),'src'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_b extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='b';
}

class xhp_base extends \xhp_xhp__html_singleton{

protected function &__xhpCategoryDeclaration() {static $_ = array('metadata' => 1);return $_;}
protected $tagName='base';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('href'=>array(1, null,null, 0),'target'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_bdi extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='bdi';
}

class xhp_bdo extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='bdo';
}

class xhp_blockquote extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'sectioning' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='blockquote';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('cite'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_body extends \xhp_xhp__html_element{





protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='body';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('onafterprint'=>array(1, null,null, 0),'onbeforeprint'=>array(1, null,null, 0),'onbeforeunload'=>array(1, null,null, 0),'onhashchange'=>array(1, null,null, 0),'onmessage'=>array(1, null,null, 0),'onoffline'=>array(1, null,null, 0),'ononline'=>array(1, null,null, 0),'onpagehide'=>array(1, null,null, 0),'onpageshow'=>array(1, null,null, 0),'onpopstate'=>array(1, null,null, 0),'onstorage'=>array(1, null,null, 0),'onunload'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_br extends \xhp_xhp__html_singleton{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected $tagName='br';
}

class xhp_button extends \xhp_xhp__html_element{





protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'interactive' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='button';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('autofocus'=>array(2, null,null, 0),'disabled'=>array(2, null,null, 0),'form'=>array(1, null,null, 0),'formaction'=>array(1, null,null, 0),'formenctype'=>array(1, null,null, 0),'formmethod'=>array(7, array('get', 'post'),null, 0),'formnovalidate'=>array(2, null,null, 0),'formtarget'=>array(1, null,null, 0),'menu'=>array(1, null,null, 0),'name'=>array(1, null,null, 0),'type'=>array(7, array('submit', 'button', 'reset'),null, 0),'value'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_caption extends \xhp_xhp__html_element{

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='caption';
}

class xhp_canvas extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'embedded' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='canvas';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('height'=>array(3, null,null, 0),'width'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_cite extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='cite';
}

class xhp_code extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='code';
}

class xhp_col extends \xhp_xhp__html_singleton{

protected $tagName='col';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('span'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_colgroup extends \xhp_xhp__html_element{

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 3, '\\xhp_col')); return $_;}
protected $tagName='colgroup';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('span'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_data extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(1, 4, 'phrase')); return $_;}
protected $tagName='data';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('value'=>array(1, null,null, 1),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_datalist extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(5, array(3, 4, 'phrase'),array(1, 3, '\\xhp_option'))); return $_;}
protected $tagName='datalist';
}

class xhp_dd extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='dd';
}

class xhp_del extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='del';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('cite'=>array(1, null,null, 0),'datetime'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_details extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'interactive' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(4, array(0, 3, '\\xhp_summary'),array(3, 4, 'flow'))); return $_;}
protected $tagName='details';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('open'=>array(2, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_dialog extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'sectioning' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(0, 4, 'flow')); return $_;}
protected $tagName='dialog';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('open'=>array(2, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_div extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='div';
}

class xhp_dfn extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='dfn';
}

class xhp_dl extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(4, array(3, 3, '\\xhp_dt'),array(3, 3, '\\xhp_dd'))); return $_;}
protected $tagName='dl';
}

class xhp_dt extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='dt';
}

class xhp_em extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='em';
}

class xhp_embed extends \xhp_xhp__html_element{









protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'embedded' => 1,'interactive' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='embed';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('height'=>array(3, null,null, 0),'src'=>array(1, null,null, 0),'type'=>array(1, null,null, 0),'width'=>array(3, null,null, 0),'allowfullscreen'=>array(2, null,null, 0),'allowscriptaccess'=>array(7, array('always', 'never'),null, 0),'wmode'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_fieldset extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(4, array(2, 3, '\\xhp_legend'),array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))))); return $_;}
protected $tagName='fieldset';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('disabled'=>array(2, null,null, 0),'form'=>array(1, null,null, 0),'name'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_figcaption extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='figcaption';
}

class xhp_figure extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'sectioning' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(5, array(0, 5, array(4, array(0, 3, '\\xhp_figcaption'),array(3, 4, 'flow'))),array(0, 5, array(4, array(3, 4, 'flow'),array(2, 3, '\\xhp_figcaption'))))); return $_;}
protected $tagName='figure';
}

class xhp_footer extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='footer';
}

class xhp_form extends \xhp_xhp__html_element{




protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='form';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('action'=>array(1, null,null, 0),'accept-charset'=>array(1, null,null, 0),'autocomplete'=>array(7, array('on', 'off'),null, 0),'enctype'=>array(1, null,null, 0),'method'=>array(7, array('get', 'post'),null, 0),'name'=>array(1, null,null, 0),'novalidate'=>array(2, null,null, 0),'target'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_h1 extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='h1';
}

class xhp_h2 extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='h2';
}

class xhp_h3 extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='h3';
}

class xhp_h4 extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='h4';
}

class xhp_h5 extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='h5';
}

class xhp_h6 extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='h6';
}

class xhp_head extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(1, 4, 'metadata')); return $_;}
protected $tagName='head';
}

class xhp_header extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'heading' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='header';
}

class xhp_hgroup extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'heading' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(3, 5, array(5, array(5, array(5, array(5, array(5, array(0, 3, '\\xhp_h1'),array(0, 3, '\\xhp_h2')),array(0, 3, '\\xhp_h3')),array(0, 3, '\\xhp_h4')),array(0, 3, '\\xhp_h5')),array(0, 3, '\\xhp_h6'))); return $_;}
protected $tagName='hgroup';
}

class xhp_hr extends \xhp_xhp__html_singleton{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected $tagName='hr';
}

class xhp_html extends \xhp_xhp__html_element{

protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(4, array(0, 3, '\\xhp_head'),array(0, 3, '\\xhp_body'))); return $_;}
protected $tagName='html';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('manifest'=>array(1, null,null, 0),'xmlns'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_i extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='i';
}

class xhp_iframe extends \xhp_xhp__pcdata_element{



protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'embedded' => 1,'interactive' => 1);return $_;}
protected $tagName='iframe';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('allowfullscreen'=>array(2, null,null, 0),'name'=>array(1, null,null, 0),'height'=>array(3, null,null, 0),'sandbox'=>array(1, null,null, 0),'seamless'=>array(2, null,null, 0),'src'=>array(1, null,null, 0),'srcdoc'=>array(1, null,null, 0),'width'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_img extends \xhp_xhp__html_singleton{



protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected $tagName='img';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('alt'=>array(1, null,null, 0),'crossorigin'=>array(7, array('anonymous', 'use-credentials'),null, 0),'height'=>array(3, null,null, 0),'ismap'=>array(2, null,null, 0),'src'=>array(1, null,null, 0),'usemap'=>array(1, null,null, 0),'width'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_input extends \xhp_xhp__html_singleton{
















protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'interactive' => 1);return $_;}
protected $tagName='input';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('accept'=>array(1, null,null, 0),'alt'=>array(1, null,null, 0),'autocomplete'=>array(7, array('on', 'off'),null, 0),'autofocus'=>array(2, null,null, 0),'checked'=>array(2, null,null, 0),'dirname'=>array(1, null,null, 0),'disabled'=>array(2, null,null, 0),'form'=>array(1, null,null, 0),'formaction'=>array(1, null,null, 0),'formenctype'=>array(1, null,null, 0),'formmethod'=>array(7, array('get', 'post'),null, 0),'formnovalidate'=>array(2, null,null, 0),'formtarget'=>array(1, null,null, 0),'height'=>array(3, null,null, 0),'inputmode'=>array(7, array('email', 'full-width-latin', 'kana', 'katakana', 'latin', 'latin-name', 'latin-prose', 'numeric', 'tel', 'url', 'verbatim'),null, 0),'list'=>array(1, null,null, 0),'max'=>array(8, null,null, 0),'maxlength'=>array(3, null,null, 0),'min'=>array(8, null,null, 0),'minlength'=>array(3, null,null, 0),'multiple'=>array(2, null,null, 0),'name'=>array(1, null,null, 0),'pattern'=>array(1, null,null, 0),'placeholder'=>array(1, null,null, 0),'readonly'=>array(2, null,null, 0),'required'=>array(2, null,null, 0),'size'=>array(3, null,null, 0),'src'=>array(1, null,null, 0),'step'=>array(8, null,null, 0),'type'=>array(7, array('hidden', 'text', 'search', 'tel', 'url', 'email', 'password', 'datetime', 'date', 'month', 'week', 'time', 'datetime-local', 'number', 'range', 'color', 'checkbox', 'radio', 'file', 'submit', 'image', 'reset', 'button'),null, 0),'value'=>array(1, null,null, 0),'width'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_ins extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='ins';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('cite'=>array(1, null,null, 0),'datetime'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_keygen extends \xhp_xhp__html_singleton{



protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'interactive' => 1);return $_;}
protected $tagName='keygen';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('autofocus'=>array(2, null,null, 0),'challenge'=>array(1, null,null, 0),'disabled'=>array(2, null,null, 0),'form'=>array(1, null,null, 0),'keytype'=>array(1, null,null, 0),'name'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_kbd extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='kbd';
}

class xhp_label extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'interactive' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='label';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('for'=>array(1, null,null, 0),'form'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_legend extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='legend';
}

class xhp_li extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='li';
}

class xhp_link extends \xhp_xhp__html_singleton{




protected function &__xhpCategoryDeclaration() {static $_ = array('metadata' => 1);return $_;}
protected $tagName='link';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('crossorigin'=>array(7, array('anonymous', 'use-credentials'),null, 0),'href'=>array(1, null,null, 0),'hreflang'=>array(1, null,null, 0),'media'=>array(1, null,null, 0),'rel'=>array(1, null,null, 1),'sizes'=>array(1, null,null, 0),'type'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_main extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='main';
}

class xhp_map extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='map';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('name'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_mark extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='mark';
}

class xhp_menu extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(5, array(5, array(1, 5, array(5, array(5, array(0, 3, '\\xhp_menuitem'),array(0, 3, '\\xhp_hr')),array(0, 3, '\\xhp_menu'))),array(1, 3, '\\xhp_li')),array(1, 4, 'flow'))); return $_;}
protected $tagName='menu';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('label'=>array(1, null,null, 0),'type'=>array(7, array('popup', 'toolbar'),null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_menuitem extends \xhp_xhp__html_singleton{




protected $tagName='menuitem';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('checked'=>array(2, null,null, 0),'command'=>array(1, null,null, 0),'default'=>array(2, null,null, 0),'disabled'=>array(2, null,null, 0),'label'=>array(1, null,null, 0),'icon'=>array(1, null,null, 0),'radiogroup'=>array(1, null,null, 0),'type'=>array(7, array('checkbox', 'command', 'radio'),null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_meta extends \xhp_xhp__html_singleton{







protected function &__xhpCategoryDeclaration() {static $_ = array('metadata' => 1,'flow' => 1,'phrase' => 1);return $_;}
protected $tagName='meta';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('charset'=>array(1, null,null, 0),'content'=>array(1, null,null, 1),'http-equiv'=>array(1, null,null, 0),'name'=>array(1, null,null, 0),'property'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_meter extends \xhp_xhp__html_element{


protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='meter';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('high'=>array(8, null,null, 0),'low'=>array(8, null,null, 0),'max'=>array(8, null,null, 0),'min'=>array(8, null,null, 0),'optimum'=>array(8, null,null, 0),'value'=>array(8, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_nav extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='nav';
}

class xhp_noscript extends \xhp_xhp__html_element{

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 2, null)); return $_;}protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'metadata' => 1);return $_;}
protected $tagName='noscript';
}

class xhp_object extends \xhp_xhp__html_element{



protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'embedded' => 1,'interactive' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(4, array(1, 3, '\\xhp_param'),array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))))); return $_;}
protected $tagName='object';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('data'=>array(1, null,null, 0),'height'=>array(3, null,null, 0),'form'=>array(1, null,null, 0),'name'=>array(1, null,null, 0),'type'=>array(1, null,null, 0),'typemustmatch'=>array(2, null,null, 0),'usemap'=>array(1, null,null, 0),'width'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_ol extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 3, '\\xhp_li')); return $_;}
protected $tagName='ol';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('reversed'=>array(2, null,null, 0),'start'=>array(3, null,null, 0),'type'=>array(7, array('1', 'a', 'A', 'i', 'I'),null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_optgroup extends \xhp_xhp__html_element{

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 3, '\\xhp_option')); return $_;}
protected $tagName='optgroup';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('disabled'=>array(2, null,null, 0),'label'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_option extends \xhp_xhp__pcdata_element{

protected $tagName='option';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('disabled'=>array(2, null,null, 0),'label'=>array(1, null,null, 0),'selected'=>array(2, null,null, 0),'value'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_output extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='output';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('for'=>array(1, null,null, 0),'form'=>array(1, null,null, 0),'name'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_p extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='p';
}

class xhp_param extends \xhp_xhp__pcdata_element{

protected $tagName='param';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('name'=>array(1, null,null, 0),'value'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_pre extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='pre';
}

class xhp_progress extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='progress';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('max'=>array(8, null,null, 0),'value'=>array(8, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_q extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='q';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('cite'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_rb extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(3, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='rb';
}

class xhp_rp extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(3, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='rp';
}

class xhp_rt extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(3, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='rt';
}

class xhp_rtc extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(3, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='rtc';
}

class xhp_ruby extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(5, array(3, 5, array(5, array(0, 2, null),array(0, 3, '\\xhp_rb'))),
array(3, 5, array(5, array(5, array(5, array(0, 5, array(4, array(0, 3, '\\xhp_rp'),array(0, 3, '\\xhp_rt'))),array(0, 5, array(4, array(0, 3, '\\xhp_rp'),array(0, 3, '\\xhp_rtc')))),array(0, 5, array(4, array(0, 3, '\\xhp_rt'),array(0, 3, '\\xhp_rp')))),array(0, 5, array(4, array(0, 3, '\\xhp_rtc'),array(0, 3, '\\xhp_rp'))))))); return $_;}

protected $tagName='ruby';
}

class xhp_s extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='s';
}

class xhp_samp extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='samp';
}

class xhp_script extends \xhp_xhp__raw_pcdata_element{





protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'metadata' => 1);return $_;}
protected $tagName='script';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('async'=>array(2, null,null, 0),'charset'=>array(1, null,null, 0),'crossorigin'=>array(7, array('anonymous', 'use-credentials'),null, 0),'defer'=>array(2, null,null, 0),'src'=>array(1, null,null, 0),'type'=>array(1, null,null, 0),'language'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_section extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'sectioning' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='section';
}

class xhp_select extends \xhp_xhp__html_element{



protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'interactive' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 3, '\\xhp_option'),array(0, 3, '\\xhp_optgroup'))); return $_;}
protected $tagName='select';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('autofocus'=>array(2, null,null, 0),'disabled'=>array(2, null,null, 0),'form'=>array(1, null,null, 0),'multiple'=>array(2, null,null, 0),'name'=>array(1, null,null, 0),'required'=>array(2, null,null, 0),'size'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_small extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='small';
}

class xhp_source extends \xhp_xhp__html_singleton{

protected $tagName='source';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('media'=>array(1, null,null, 0),'src'=>array(1, null,null, 0),'type'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_span extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='span';
}

class xhp_strong extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='strong';
}

class xhp_style extends \xhp_xhp__raw_pcdata_element{


protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'metadata' => 1);return $_;}
protected $tagName='style';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('media'=>array(1, null,null, 0),'scoped'=>array(2, null,null, 0),'type'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_sub extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='sub';
}

class xhp_summary extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='summary';
}

class xhp_sup extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='sup';
}

class xhp_table extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}

protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(4, array(4, array(4, array(2, 3, '\\xhp_caption'),
array(1, 3, '\\xhp_colgroup')),
array(2, 3, '\\xhp_thead')),

array(0, 5, array(5, array(0, 5, array(4, array(0, 3, '\\xhp_tfoot'),array(0, 5, array(5, array(3, 3, '\\xhp_tbody'),array(1, 3, '\\xhp_tr'))))),
array(0, 5, array(4, array(0, 5, array(5, array(3, 3, '\\xhp_tbody'),array(1, 3, '\\xhp_tr'))),array(2, 3, '\\xhp_tfoot'))))))); return $_;}


protected $tagName='table';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('border'=>array(3, null,null, 0),'sortable'=>array(2, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_tbody extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 3, '\\xhp_tr')); return $_;}
protected $tagName='tbody';
}

class xhp_template extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'metadata' => 1);return $_;}


protected $tagName='tbody';
}

class xhp_td extends \xhp_xhp__html_element{

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='td';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('colspan'=>array(3, null,null, 0),'headers'=>array(1, null,null, 0),'rowspan'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_textarea extends \xhp_xhp__pcdata_element{





protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'interactive' => 1);return $_;}
protected $tagName='textarea';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('autocomplete'=>array(7, array('on', 'off'),null, 0),'autofocus'=>array(2, null,null, 0),'cols'=>array(3, null,null, 0),'dirname'=>array(1, null,null, 0),'disabled'=>array(2, null,null, 0),'form'=>array(1, null,null, 0),'maxlength'=>array(3, null,null, 0),'minlength'=>array(3, null,null, 0),'name'=>array(1, null,null, 0),'placeholder'=>array(1, null,null, 0),'readonly'=>array(2, null,null, 0),'required'=>array(2, null,null, 0),'rows'=>array(3, null,null, 0),'wrap'=>array(7, array('soft', 'hard'),null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_tfoot extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 3, '\\xhp_tr')); return $_;}
protected $tagName='tfoot';
}

class xhp_th extends \xhp_xhp__html_element{



protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))); return $_;}
protected $tagName='th';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('abbr'=>array(1, null,null, 0),'colspan'=>array(3, null,null, 0),'headers'=>array(1, null,null, 0),'rowspan'=>array(3, null,null, 0),'scope'=>array(7, array('col', 'colgroup', 'row', 'rowgroup'),null, 0),'sorted'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_thead extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 3, '\\xhp_tr')); return $_;}
protected $tagName='thead';
}

class xhp_time extends \xhp_xhp__html_element{

protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='time';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('datetime'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_title extends \xhp_xhp__pcdata_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('metadata' => 1);return $_;}
protected $tagName='title';
}

class xhp_tr extends \xhp_xhp__html_element{
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 3, '\\xhp_th'),array(0, 3, '\\xhp_td'))); return $_;}
protected $tagName='tr';
}

class xhp_track extends \xhp_xhp__html_singleton{





protected $tagName='track';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('default'=>array(2, null,null, 0),'kind'=>array(7, array('subtitles', 'captions', 'descriptions', 'chapters', 'metadata'),null, 0),'label'=>array(1, null,null, 0),'src'=>array(1, null,null, 0),'srclang'=>array(1, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_tt extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='tt';
}

class xhp_u extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='u';
}

class xhp_ul extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(0, 3, '\\xhp_li')); return $_;}
protected $tagName='ul';
}

class xhp_var extends \xhp_xhp__html_element{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 4, 'phrase'))); return $_;}
protected $tagName='var';
}

class xhp_video extends \xhp_xhp__html_element{





protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1,'embedded' => 1,'interactive' => 1);return $_;}
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(4, array(4, array(1, 3, '\\xhp_source'),array(1, 3, '\\xhp_track')),array(1, 5, array(5, array(0, 2, null),array(0, 4, 'flow'))))); return $_;}
protected $tagName='video';protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('autoplay'=>array(2, null,null, 0),'controls'=>array(2, null,null, 0),'crossorigin'=>array(7, array('anonymous', 'use-credentials'),null, 0),'height'=>array(3, null,null, 0),'loop'=>array(2, null,null, 0),'mediagroup'=>array(1, null,null, 0),'muted'=>array(2, null,null, 0),'poster'=>array(1, null,null, 0),'preload'=>array(7, array('none', 'metadata', 'auto'),null, 0),'src'=>array(1, null,null, 0),'width'=>array(3, null,null, 0),) + parent::__xhpAttributeDeclaration();}return $_;}
}

class xhp_wbr extends \xhp_xhp__html_singleton{
protected function &__xhpCategoryDeclaration() {static $_ = array('flow' => 1,'phrase' => 1);return $_;}
protected $tagName='wbr';
}

/**
 * Render an <html /> element with a DOCTYPE, XHP has chosen to only support
 * the HTML5 doctype.
 */
class xhp_x__doctype extends \xhp_x__primitive{
protected function &__xhpChildrenDeclaration() {static $_ = array(0, 5, array(0, 3, '\\xhp_html')); return $_;}

protected function stringify(){
$children=$this->getChildren();
return '<!DOCTYPE html>'.(\xhp_xhp::renderChild($children[0]));
}
}

/**
 * Render an HTML conditional comment. You can choose whatever you like as
 * the conditional statement.
 */
class xhp_x__conditional_comment extends \xhp_x__primitive{

protected function &__xhpChildrenDeclaration() {static $_ = array(1, 5, array(5, array(0, 2, null),array(0, 3, '\\xhp_xhp'))); return $_;}

protected function stringify(){
$children=$this->getChildren();
$html='<!--[if '.$this->getAttribute('if').']>';
foreach($children as $child){
if($child instanceof \xhp_xhp){
$html.=\xhp_xhp::renderChild($child);
}else {
$html.=$child;
}
}
$html.='<![endif]-->';
return $html;
}protected static function &__xhpAttributeDeclaration() {static $_ = -1;if ($_ === -1) {$_ = array('if'=>array(1, null,null, 1),) + parent::__xhpAttributeDeclaration();}return $_;}
}