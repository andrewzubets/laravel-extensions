<?php 

namespace Azub\Model\Traits;

trait UrlAlias {

	public function getAliasProperty(){
		return 'alias';
	}
	public function getAliasSourceProperty(){
		return 'title';
	}
	public function isAliasEmpty($is_slash = true){
		$alias_prop = $this->getAliasProperty();
		if(empty($this->attributes[$alias_prop])) return true;
		if($is_slash && $this->attributes[$alias_prop] == '/') return true;
		return false;
	}

	public function generateAlias($is_slash = true){
        $field_prop = $this->getAliasSourceProperty();
        $alias_prop = $this->getAliasProperty();

		if($this->isAliasEmpty($is_slash) == false) {
			if($is_slash && substr($this->attributes[$alias_prop], 0,1) != '/')
				$this->attributes[$alias_prop] = '/'.$this->attributes[$alias_prop];
			return;
		}

		$this->attributes[$alias_prop] = ($is_slash ? '/' : '') . az_rus_to_alias($this->{$field_prop});
    }

    public function scopeAlias($query, $value){
    	return $query->where($this->getAliasProperty(), $value);
    }
}
?>