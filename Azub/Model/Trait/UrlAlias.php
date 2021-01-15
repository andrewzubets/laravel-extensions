<?php 

namespace Azub\Model\Trait;

trait UrlAlias {

	public function isAliasEmpty($alias_prop = 'alias', $is_slash = true){
		if(empty($this->attributes[$alias_prop])) return true;
		if($is_slash && $this->attributes[$alias_prop] == '/') return true;
		return false;
	}
	public function generateAlias( $field_prop = 'title', $alias_prop = 'alias', $is_slash = true){
        
		if($this->isAliasEmpty($alias_prop, $is_slash) == false) {
			if($is_slash && substr($this->attributes[$alias_prop], 0,1) != '/')
				$this->attributes[$alias_prop] = '/'.$this->attributes[$alias_prop];
			return;
		}

		$this->attributes[$alias_prop] = ($is_slash ? '/' : '') . az_rus_to_alias($this->{$field_prop});
    }   
}
?>