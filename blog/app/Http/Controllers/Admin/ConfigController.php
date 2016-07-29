<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends BaseController
{
    // get admin/config/{config} 显示单个配置项信息
    public function show()
    {

    }

    // get admin/config  全部配置项列表
    public function index()
    {
        $data = Config::orderBy('conf_order', 'asc')->get();

        // 根据添加项重组
        foreach ($data as $k => $v) {
            switch ($v->field_type) {
                case 'input':
                    $data[$k]['conf_html'] = '<input type="text" class="lg" name="conf_content[]" value="'. $v->conf_content .'">';
                    break;
                case 'textarea':
                    $data[$k]['conf_html'] = '<textarea class="lg" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    $arr = explode(',', $v->field_value);
                    $html = '';
                    foreach ($arr as $kk => $vv) {
                        $array = explode('|', $vv); // 值 名称
                        if (!empty($v->conf_content)) {
                            $checked = $v->conf_content == $array[0] ? 'checked' : '';
                        } else {
                            $checked = $kk == 0 ? 'checked' : '';
                        }
                        $html .= '<input class="lg" type="radio" id="id' . $array[0] .'" name="conf_content[]" value="' . $array[0] .'" ' . $checked .' >' . '<label for="id' . $array[0] .'"> ' . $array[1] .'</label>';
                    }
                    $data[$k]['conf_html'] = $html;
                    break;
            }
        }
        return view('admin.config.index')->with('data', $data);
    }

    // get admin/config/create 添加配置项
    public function create()
    {
        return view('admin.config.add');
    }

    // post admin/config 添加配置项提交处理
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'conf_name' => 'required',
            'conf_title' => 'required',
        ];

        $message = [
            'conf_name.required' => '配置项名称不能为空',
            'conf_title.required' => '配置项标题不能为空',
        ];

        $validator = Validator::make($input, $rules, $message);

        if ($validator->passes()) {
            $result = Config::create($input);
            if ($result) {
                return redirect()->route('admin.config.index');
            } else {
                return back()->with('errors', '添加配置项失败');
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    // get admin/config/{config}/edit 编辑配置项
    public function edit($conf_id)
    {
        $conf = Config::find($conf_id);
        $data = [];
        return view('admin/config/edit', compact('conf', 'data'));
    }

    // put admin/config/{config} 更新配置项
    public function update($conf_id)
    {
        $input = Input::except('_token', '_method');
        $result = Config::where('conf_id', $conf_id)->update($input);
        if ($result) {
            $this->putFile();
            return redirect()->route('admin.config.index');
        } else {
            return back()->with('errors', '更新配置项失败');
        }

    }

    // delete admin/config/{config} 删除配置项
    public function destroy($conf_id)
    {
        $result = Config::where('conf_id', $conf_id)->delete();
        if ($result) {
            $this->putFile();
            $data = [
                'status' => 1,
                'msg' => '删除配置项成功',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '删除分类失败',
            ];
        }

        return $data;
    }

    // 修改网站配置内容
    public function changeContent()
    {
        $input = Input::all();
        foreach($input['conf_id'] as $k => $v){
            Config::where('conf_id',$v)->update(['conf_content' => $input['conf_content'][$k]]);
        }
        $this->putFile();
        return back()->with('errors','配置项更新成功！');
    }

    // 将网站配置信息写入配置文件
    public function putFile()
    {
        $config = Config::pluck('conf_content','conf_name')->all();
        $path = base_path('config/web.php');
        $str = '<?php return '.var_export($config, true).';';
        file_put_contents($path, $str);
    }

    // 排序改变
    public function changeorder()
    {
        $conf = Config::find(Input::get('conf_id'));
        $conf->conf_order = Input::get('conf_order');
        $result = $conf->update();
        if ($result) {
            $data = [
                'status' => 1,
                'msg' => '更新配置项排序成功',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '更新配置项排序失败',
            ];
        }

        return $data;
    }
}
