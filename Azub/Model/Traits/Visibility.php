<?php 

namespace Azub\Model\Traits;

trait Visibility {

	public function getVisibilityProperty(){
		return 'is_visible';
	}
    public function scopeIsVisible($query){
    	return $query->where($this->getVisibilityProperty(), 1);
    }
}
?>