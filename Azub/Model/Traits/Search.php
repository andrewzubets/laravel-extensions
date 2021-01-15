<?php 

namespace Azub\Model\Traits;

trait Search {

	public function getSearchProps(){
		return [
			'title'
		];
	}
	public function scopeSearch($query, $value){
        $data = [
            'props' => $this->getSearchProps(),
            'value' => mb_strtolower($value),
        ];

        return $query->where(function($sub) use($data){
            foreach ($data['props'] as $key => $prop) {
                $sql = 'lower('.$prop.') like ? or lower('.$prop.') like ? or lower('.$prop.') like ? or lower('.$prop.') like ?';
                $binds=[
                    $data['value'],
                    '%'.$data['value'],
                    $data['value'].'%',
                    '%'.$data['value'].'%',
                ];
                if($key == 0){
                    $sub->whereRaw($sql, $binds);
                }
                else
                    $sub->orWhereRaw($sql, $binds);
            }
        });     
    }
}
?>