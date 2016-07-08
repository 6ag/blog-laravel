<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded = [];

    public function tree()
    {
        $newCategories = [];
        $categories = $this->orderBy('cate_order', 'asc')->get();
        $this->getTree($categories, $newCategories);
        return $newCategories;
    }

    public function getTree($categories, &$newCategories, $pid = 0)
    {
        foreach ($categories as $key => $value) {
            if ($pid == $value->cate_pid) {
                $newCategories[$key] = $value;

                $count = 0;
                $this->getLineCount($count, $categories, $value->cate_pid);
                $line = '';
                for ($i = 0; $i < $count; $i++) {
                    $line .= '&nbsp;&nbsp;&nbsp;&nbsp;—';
                }
                $newCategories[$key]['_cate_name'] = $line . $value->cate_name;

                foreach ($categories as $value_c) {
                    if ($value->cate_id == $value_c->cate_pid) {
                        $this->getTree($categories, $newCategories, $value_c->cate_pid);
                        break;
                    }
                }
            }
        }

    }

    // 计算横线数量
    public function getLineCount(&$count,$categories, $current_pid)
    {
        foreach ($categories as $value) {
            if ($current_pid == 0) {
                return $count;
            }
            if ($current_pid == $value->cate_id) {
                $current_pid = $value->cate_pid;
                $count++;
                $this->getLineCount($count, $categories, $current_pid);
            }
        }
    }

}
