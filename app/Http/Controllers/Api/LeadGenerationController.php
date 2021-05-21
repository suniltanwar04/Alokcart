<?php
namespace App\Http\Controllers\Api;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepository;
use App\LeadHandelling;;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;
class LeadGenerationController extends Controller
{
    //
    private $model_name;
    private $order;
    private $leads;
    public function __construct(LeadHandelling $leads)
    {
        parent::__construct();
        $this->leads = $leads;
    }

    public function createLead(Request $request){
        $data = new LeadHandelling;
        $data['leadEmail']=$request->leadEmail;
        $data['leadName']=$request->leadName;
        $data['leadContact']=$request->leadContact;
        $data['leadProduct']=$request->leadProduct;
        $data['leadProductQty']=$request->leadProductQty;
        $data['leadStatus']=1;
        $data['leadGeneratedFrom']=$request->leadGeneratedFrom;
        $data['leadCountry']=$request->leadCountry;
        $data->save();
        echo json_encode(['status'=>true,'msg'=>'Data Submitted Successfully!']);
    }
}
