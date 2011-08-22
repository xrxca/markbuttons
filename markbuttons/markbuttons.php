<?php
/**
 * markbuttons - Add Mark As: buttons to bottom of message list
 *
 * @version 1.00 (20110801)
 * @author Karl McMurdo (user xrxca on roundcubeforum.net)
 * @url http://github.com/xrxca/markbuttons
 * @copyright (c) 2011 Karl McMurdo
 *
 */
 
class markbuttons extends rcube_plugin
{
  public $task = 'mail';

  function init(){
    $this->add_hook('template_container', array($this, 'html_output'));
    $this->add_texts('localization/', true);
  }

  function mark_button($i) {
	return("\n      <a class='button' href='#' title='"
	. Q($this->gettext('mark' . $i))
	. "' onclick=\"return rcmail.command('mark','"
	. $i . "',this)\"><img align='top' src='"
	. $this->url($this->local_skin_path()) . '/images/' . $i
	. ".png' /> </a>");
  }

  function html_output($p) {
    if ($p['name'] == "listcontrols") {
      $rcmail = rcmail::get_instance();
      $skin_path = $this->url($this->local_skin_path()) . '/images/';
      $r = '<span style="margin-left: 20px">' 
	   . Q($this->gettext('markbuttons_label')) . ':&nbsp;</span>';
      $r .= $this->mark_button('read');
      $r .= $this->mark_button('unread');
      $r .= $this->mark_button('flagged');
      $r .= $this->mark_button('unflagged');
      $p['content'] = $r . $p['content'];
    }
	
    return $p;
  }
}
?>
