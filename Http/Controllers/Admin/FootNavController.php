<?php
// @author liming
namespace Modules\FootNav\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Modules\FootNav\Http\Controllers\Controller;
use Modules\FootNav\Http\Requests\Admin\FootNavSettingRequest;
use Modules\FootNav\Entities\Applet;
use Modules\FootNav\Entities\BaseModel;

class FootNavController extends Controller
{
    /**
     * 小程序导航设置
     * @param $id
     */
    public function setting(FootNavSettingRequest $request)
    {
        if($request->isMethod('post')) {
            $request->check();
            $data = $request->post();
            $data["foot"] = $data["foot"] ?? [];
            if(!file_exists(module_path('FootNav', '/Config/nav.php'))){
                return $this->failed('配置文件不存在' . __DIR__);
            }else{
                $myfile = fopen(module_path('FootNav', '/Config/nav.php'), "w");
                fwrite($myfile, "<?php");
                fwrite($myfile, "\n");
                fwrite($myfile, "return [");
                fwrite($myfile, "\n");

                fwrite($myfile, '  "head" => [');
                fwrite($myfile, "\n");
                if(isset($data["head"]["fontcolor"]) && in_array($data["head"]["fontcolor"], [0,1])){
                    fwrite($myfile, '    "fontcolor" => "'.$data["head"]["fontcolor"].'",');
                }else{
                    fwrite($myfile, '    "fontcolor" => "0",');
                }
                fwrite($myfile, "\n");
                if(isset($data["head"]["backcolor"]) && $data["head"]["backcolor"] != ""){
                    fwrite($myfile, '    "backcolor" => "'.$data["head"]["backcolor"].'",');
                }else{
                    fwrite($myfile, '    "backcolor" => "#ffffff",');
                }
                fwrite($myfile, "\n");
                fwrite($myfile, "  ],");
                fwrite($myfile, "\n");

                fwrite($myfile, '  "foot" => [');
                fwrite($myfile, "\n");
                foreach ($data["foot"] as $item){
                    fwrite($myfile, '    [');
                    fwrite($myfile, "\n");
                    fwrite($myfile, '      "id" => "'.$item["id"].'",');
                    fwrite($myfile, "\n");
                    fwrite($myfile, '      "is_color" => "'.$item["is_color"].'",');
                    fwrite($myfile, "\n");
                    fwrite($myfile, '      "is_pic" => "'.$item["is_pic"].'",');
                    fwrite($myfile, "\n");
                    fwrite($myfile, '      "name" => "'.$item["name"].'",');
                    fwrite($myfile, "\n");
                    $item["params"] = $item["params"] ?? "";
                    fwrite($myfile, '      "params" => "'.$item["params"].'",');
                    fwrite($myfile, "\n");
                    fwrite($myfile, '      "pic" => "'.$item["pic"].'",');
                    fwrite($myfile, "\n");
                    fwrite($myfile, '      "route" => "'.$item["route"].'",');
                    fwrite($myfile, "\n");
                    fwrite($myfile, '    ],');
                    fwrite($myfile, "\n");
                }
                fwrite($myfile, "  ],");
                fwrite($myfile, "\n");

                fwrite($myfile, "];");
                fwrite($myfile, "\n");

                fclose($myfile);
                return $this->success();
            }
        } else {
            $info = config("footnavnav");
            $foot = $info["foot"];
            $title = "小程序导航设置";
            $domain = BaseModel::getDomain();
            if(Schema::hasTable("applet")){
                $applet = Applet::where("open_type", "navigate")->get()->toArray();
            }else{
                $applet = [];
            }
            foreach ($applet as &$item){
                $item["params"] = json_decode($item["params"], true);
            }
            return view('footnavview::admin.footnav.setting', compact('info', 'foot','title', 'applet', 'domain'));
        }
    }
}
