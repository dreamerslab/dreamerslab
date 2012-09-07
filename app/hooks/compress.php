<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function compress()
{
  $CI =& get_instance();
  $class = $CI->router->fetch_class();
  $compress = $CI->config->item('compress');

  foreach($compress as $val){
    if($val == $class){
      $buffer = $CI->output->get_output();

      $search = array(
        '/\n/', // replace end of line by a space
        '/\>[^\S ]+/s', // strip whitespaces after tags, except space
        '/[^\S ]+\</s', // strip whitespaces before tags, except space
        '/(\s)+/s' // shorten multiple whitespace sequences
      );

      $replace = array(
        ' ',
        '>',
        '<',
        '\\1'
      );

      $buffer = preg_replace($search, $replace, $buffer);

      $CI->output->set_output($buffer);
      break;
    }
  }
  $CI->output->_display();
}

/* End of file compress.php */
/* Location: ./app/hooks/compress.php */