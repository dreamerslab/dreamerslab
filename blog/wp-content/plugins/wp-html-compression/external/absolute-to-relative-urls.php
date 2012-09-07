<?php
/*
Plugin Name: Absolute-to-Relative URLs
Plugin URI: http://www.svachon.com/
Description: A <strong>function</strong> for use in shortening URL links. Just use <code><strong>absolute_to_relative_url</strong>( string <em>$url</em> [, bool <em>$ignore_www</em> = <em>true</em> [, bool <em>$choose_shortest_path</em> = <em>true</em>]] )</code>.
Version: 0.2
Author: Steven Vachon
Author URI: http://www.svachon.com/
Author Email: prometh@gmail.com
*/


class Absolute_to_Relative_URLs
{
	//protected static $_instance;
	
	protected $site_port_default;
	protected $site_url;
	protected $valid_site_url;
	
	
	
	public function __construct($custom_site_url='')
	{
		$this->valid_site_url = $this->get_site_url($custom_site_url);
		
		if (!$this->valid_site_url)
		{
			trigger_error('Invalid site URL');
		}
	}
	
	
	
	/*
		Initialize class for absolute_to_relative_url()
		Nice idea, BUT slower than using a global variable
	*/
	/*public static function instance()
	{
		if (self::$_instance == null)
		{
			self::$_instance = new Absolute_to_Relative_URLs();
		}
		
		return self::$_instance;
	}*/
	
	
	
	protected function get_site_url($custom_site_url)
	{
		if ($custom_site_url == '')
		{
			$https = isset($_SERVER['HTTPS']);
			
			$url = (!$https) ? 'http://' : 'https://';
			
			if ( isset($_SERVER['PHP_AUTH_USER']) )
			{
				$url .= $_SERVER['PHP_AUTH_USER'] .':'. $_SERVER['PHP_AUTH_PW'] .'@';
			}
			
			$url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		}
		else
		{
			$url = $custom_site_url;
		}
		
		$url = $this->parse_url($url);
		
		if ($url !== false)
		{
			$https = ($url['scheme'] == 'https');
			
			if ( !isset($url['port']) )
			{
				// POSSIBLE v0.3 :: catch default ports for other protocols
				$url['port'] = (!$https) ? 80 : 443;
			}
			
			$url['host_stripped'] = $this->remove_www($url['host']);
			
			$url['path_array'] = $this->parse_path($url['path'], true, false);
			
			// POSSIBLE v0.3 :: more default ports
			$this->site_port_default = (!$https && $url['port']==80   ||   $https && $url['port']==443);
			
			$this->site_url = $url;
			
			return true;
		}
		
		return false;
	}
	
	
	
	/*
		Return an path string.
	*/
	protected function implode_path($path, $absolute)
	{
		if (!empty($path))
		{
			$path = implode('/', $path) .'/';
			
			if ($absolute)
			{
				$path = '/'.$path;
			}
		}
		else
		{
			$path = (!$absolute) ? './' : '/';
		}
		
		return $path;
	}
	
	
	
	/*
		Return an absolute path.
	*/
	protected function parse_path($path, $absolute_source, $compare_to_site_url)
	{
		$path = explode('/', $path);
		$absolute_path = array();
		
		if ($compare_to_site_url)
		{
			// Avoid problems with "host/./"
			if (!$absolute_source)
			{
				$first_dir = $path[0];
				
				if ($first_dir=='.' || $first_dir=='..')
				{
					$path = array_merge($this->site_url['path_array'], $path);
				}
			}
		}
		
		foreach ($path as $dir)
		{
			if ($dir != '')
			{
				if ($dir != '..')
				{
					if ($dir != '.')
					{
						array_push($absolute_path, $dir);
					}
				}
				else
				{
					$parent_index = count($absolute_path) - 1;
					
					if ($parent_index >= 0)
					{
						array_splice($absolute_path, $parent_index, 1);
					}
				}
			}
		}
		
		return $absolute_path;
	}
	
	
	
	/*
		Return the components of a URL.
	*/
	protected function parse_url($url)
	{
		// With PHP versions earlier than 5.3.3, an E_WARNING is emitted when URL parsing fails
		// REMOVE when WordPress enforces a higher version as it will increase performance
		$url = @parse_url($url);
		
		if ($url !== false)
		{
			if ( isset($url['path']) )
			{
				$path = str_replace(' ', '%20', $url['path']);
				
				$last_slash = strrpos($path, '/');
				
				if ($last_slash !== false)
				{
					if ($last_slash+1 < strlen($path))
					{
						// Isolate resource from path
						$url['resource'] = substr($path, $last_slash+1);
					}
					
					// Remove last slash and any possible resource
					$path = substr($path, 0, $last_slash);
					
					// Empty means root (later)
					if (!empty($path))
					{
						if (strpos($path, '/') === 0)
						{
							// Remove first slash
							$path = substr($path, 1);
						}
						else if (strpos($path, '.')   !== 0 &&
						         strpos($path, './')  !== 0 &&
						         strpos($path, '..')  !== 0 &&
						         strpos($path, '../') !== 0)
						{
							// Not root
							$path = './' . $path;
						}
					}
				}
				else
				{
					// No slashes found
					$url['resource'] = $path;
					
					// Not root
					$path = '.';
				}
				
				$url['path'] = $path;
			}
			else if ( !isset($url['host']) )
			{
				$url['path'] = '.';
			}
			else
			{
				$url['path'] = '';
			}
		}
		
		return $url;
	}
	
	
	
	/*
		Return a path relative to the site path.
		Optionally, return whichever path is shortest (absolute or relative).
	*/
	protected function relate_path($path, $absolute_source, $choose_shortest_path)
	{
		$absolute_path = $this->parse_path($path, $absolute_source, true);
		$relative_path = array();
		$site_path = $this->site_url['path_array'];
		
		// At this point, it's related to the host
		$related = true;
		$parent_index = -1;
		
		// Find parents
		foreach ($site_path as $i => $dir)
		{
			if ($related)
			{
				$absolute_dir = (isset($absolute_path[$i])) ? $absolute_path[$i] : null;
				
				if ($dir != $absolute_dir)
				{
					$related = false;
				}
				else
				{
					$parent_index = $i;
				}
			}
			
			if (!$related)
			{
				// Up one level
				array_push($relative_path, '..');
			}
		}
		
		// Form path
		foreach ($absolute_path as $i => $dir)
		{
			if ($i > $parent_index)
			{
				array_push($relative_path, $dir);
			}
		}
		
		$absolute_path = $this->implode_path($absolute_path, true);
		$relative_path = $this->implode_path($relative_path, false);
		
		if ($choose_shortest_path)
		{
			$path = (strlen($relative_path) <= strlen($absolute_path)) ? $relative_path : $absolute_path;
		}
		else
		{
			$path = $relative_path;
		}
		
		return $path;
	}
	
	
	
	/*
		Return a URL relative to the site URL.
	*/
	public function relate_url($url, $ignore_www, $choose_shortest_path)
	{
		if ($this->valid_site_url)
		{
			if ($url=='' || $url=='.')
			{
				$url = './';
			}
			
			$original_url = $url;
			
			$url = $this->parse_url($url);
			
			if ($url === false)
			{
				// Unknown format
				return $original_url;
			}
		}
		else
		{
			// Invalid site url
			return $url;
		}
		
		$absolute_source = isset($url['scheme']);
		
		if ($absolute_source)
		{
			if ($url['scheme'] != $this->site_url['scheme'])
			{
				// Different protocol
				return $original_url;
				
				// POSSIBLE v0.3 :: remote url path cleanup
				//$remote_url = true;
			}
			
			if ( isset($url['user']) )
			{
				if (!isset($this->site_url['user']) || $url['user'] != $this->site_url['user'])
				{
					// Different user
					return $original_url;
				}
			}
			
			if ( isset($url['pass']) )
			{
				if (!isset($this->site_url['pass']) || $url['pass'] != $this->site_url['pass'])
				{
					// Different password
					return $original_url;
				}
			}
			
			if ( isset($url['host']) )
			{
				if ($ignore_www)
				{
					$url['host'] = $this->remove_www($url['host']);
					
					$site_host = $this->site_url['host_stripped'];
				}
				else
				{
					$site_host = $this->site_url['host'];
				}
				
				if ($url['host'] == $site_host)
				{
					if ( isset($url['port']) )
					{
						if ($url['port'] != $this->site_url['port'])
						{
							// Different port
							return $original_url;
						}
					}
					else if (!$this->site_port_default)
					{
						// Different port
						return $original_url;
					}
				}
				else
				{
					// Different domain
					return $original_url;
				}
			}
		}
		else
		{
			// POSSIBLE v0.3 :: do something to path?
		}
		
		$new_url = '';
		
		if ( isset($url['path']) )
		{
			$new_url = $this->relate_path($url['path'], $absolute_source, $choose_shortest_path);
		}
		
		if ( isset($url['resource']) )
		{
			$new_url = $this->remove_unnecessary_path($new_url) . $url['resource'];
		}
		
		if ( isset($url['query']) )
		{
			$new_url = $this->remove_unnecessary_path($new_url) .'?'. $url['query'];
		}
		
		if ( isset($url['fragment']) )
		{
			$new_url = $this->remove_unnecessary_path($new_url) .'#'. $url['fragment'];
		}
		
		return $new_url;
	}
	
	
	
	/*
		Shorten relative path for additional URL components.
	*/
	protected function remove_unnecessary_path($url)
	{
		if ($url=='./' || ($url=='/' && $this->site_url['path']=='/'))
		{
			$url = '';
		}
		
		return $url;
	}
	
	
	
	protected function remove_www($url)
	{
		return str_replace('www.', '', $url);
	}
}



/*function absolute_to_relative_url($url, $ignore_www=true, $choose_shortest_path=true)
{
	return Absolute_to_Relative_URLs::instance()->relate_url($url, $ignore_www, $choose_shortest_path);
}*/



function absolute_to_relative_url($url, $ignore_www=true, $choose_shortest_path=true)
{
	global $absolute_to_relative_url_instance;
	
	if (!isset($absolute_to_relative_url_instance))
	{
		$absolute_to_relative_url_instance = new Absolute_to_Relative_URLs();
	}
	
	return $absolute_to_relative_url_instance->relate_url($url, $ignore_www, $choose_shortest_path);
}
?>