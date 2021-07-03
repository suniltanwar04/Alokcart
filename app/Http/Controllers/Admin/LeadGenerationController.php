<?php
namespace App\Http\Controllers\Admin;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepository;
use App\LeadHandelling;
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
    public function index(Request $request){
        $shopId= Auth::user()->shop_id;
        $userId= Auth::user()->id;
        $role= Auth::user()->role_id;
        $fromDate   =   $request->from;
        $toDate     =   $request->to;
        $leadCountry    =   $request->leadCountry;
        $country    =  DB::table('leads')
                        ->groupBy('leadCountry')
                        ->select('leadCountry')
                        ->where('leadCountry','!=','')
                        ->get();
        $trashes    =   [];
        if($role==3){
                /*
                $categoriesForSeller=$productBySeller=DB::table('products')->where('shop_id','=',$shopId)
                ->rightJoin('category_product','product_id','=','products.id')
                ->rightJoin('categories','categories.id','=','category_product.category_id')
                ->select('category_id')
                ->groupBy('category_id')
                ->get();
                $availableCategoryForSeller=[];
                foreach($categoriesForSeller as $categoryForSeller){
                        $availableCategoryForSeller[]=$categoryForSeller->category_id;
                }
                // $availableCategoryForSeller= implode(',',$availableCategoryForSeller);
                if(isset($leadCountry)){
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leadCountry','=',$leadCountry)
                    ->where('leadStatus','!=',3)
                    ->where('is_reported','!=','1')
                    ->where('leads.active',1)
                    ->where('lead_type','Internal')
                    // ->groupBy('leadProduct')
                    ->orderBy('leadId','desc')
                    ->get();
                }else if(isset($fromDate) && isset($toDate)){
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leads.updated_at','>=',$fromDate)
                    ->where('leads.updated_at','<=',$toDate)
                    ->where('leadStatus','!=',3)
                    ->where('is_reported','!=','1')
                    ->where('leads.active',1)
                    ->where('lead_type','Internal')
                    // ->groupBy('leadProduct')
                    ->orderBy('leadId','desc')
                    ->get();
                }else{
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    // ->groupBy('leadProduct')
                    ->where('leadStatus','!=',3)
                    ->where('lead_type','Internal')
                    ->where('leads.active',1)
                    ->where('is_reported','!=','1')
                    ->orderBy('leadId','desc')
                    ->get();
                }
                */
                if(isset($leadCountry)){
                    $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Buy')->where('merchant_id',$userId)->where('leadCountry','=',$leadCountry)->orderBy('leadId','desc')->get();
                    $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Buy')->where('merchant_id',$userId)->where('leadCountry','=',$leadCountry)->orderBy('leadId','desc')->get();
                } else if(isset($fromDate) && isset($toDate)){
                    $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Buy')->where('merchant_id',$userId)->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
                    $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Buy')->where('merchant_id',$userId)->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
                } else {
                    $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Buy')->where('merchant_id',$userId)->orderBy('leadId','desc')->get();
                    $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Buy')->where('merchant_id',$userId)->orderBy('leadId','desc')->get();
                }
                $sellers = DB::table('shops')->get();
        }else{
            if(isset($leadCountry)){
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Internal')->where('is_reported','!=','1')->where('leadCountry','=',$leadCountry)->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('is_reported','!=','1')->where('leadCountry','=',$leadCountry)->where('leads.active',0)->orderBy('leadId','desc')->get();
            } else if(isset($fromDate) && isset($toDate)){
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Internal')->where('is_reported','!=','1')->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('is_reported','!=','1')->where('lead_type','Internal')->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->where('leads.active',0)->orderBy('leadId','desc')->get();
            } else {
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Internal')->where('is_reported','!=','1')->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Internal')->where('is_reported','!=','1')->orderBy('leadId','desc')->get();
            }
            $sellers = DB::table('shops')->get();   

        }
        $leadStatus= ['','Open','Active','Closed'];
        $sellerLeadStatus=['','Assigned','Contact','Matured'];
        return view('admin.leads.allLeads',compact('sellerLeadStatus','Leads','sellers','leadStatus','country','leadCountry','trashes'));
    }

    public function web_leads(Request $request){
        $shopId= Auth::user()->shop_id;
        $userId= Auth::user()->id;
        $role= Auth::user()->role_id;
        $fromDate   =   $request->from;
        $toDate     =   $request->to;
        $leadCountry    =   $request->leadCountry;
        $country    =  DB::table('leads')
                        ->groupBy('leadCountry')
                        ->select('leadCountry')
                        ->where('leadCountry','!=','')
                        ->get();
        $trashes    =   [];
        if($role==3){
                $categoriesForSeller=$productBySeller=DB::table('products')->where('shop_id','=',$shopId)
                ->rightJoin('category_product','product_id','=','products.id')
                ->rightJoin('categories','categories.id','=','category_product.category_id')
                ->select('category_id')
                ->groupBy('category_id')
                ->get();
                $availableCategoryForSeller=[];
                foreach($categoriesForSeller as $categoryForSeller){
                        $availableCategoryForSeller[]=$categoryForSeller->category_id;
                }
                // $availableCategoryForSeller= implode(',',$availableCategoryForSeller);
                if(isset($leadCountry)){
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leadCountry','=',$leadCountry)
                    ->where('leadStatus','!=',3)
                    ->where('lead_type','Web')
                    ->where('leads.active',1)
                    //->groupBy('leadProduct')
                    ->orderBy('leadId','desc')
                    ->get();
                }else if(isset($fromDate) && isset($toDate)){
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leads.updated_at','>=',$fromDate)
                    ->where('leads.updated_at','<=',$toDate)
                    ->where('leadStatus','!=',3)
                    ->where('leads.active',1)
                    ->where('lead_type','Web')
                    // ->groupBy('leadProduct')
                    ->orderBy('leadId','desc')
                    ->get();
                }else{
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    // ->groupBy('leadProduct')
                    ->where('leads.active',1)
                    ->where('leadStatus','!=',3)
                    ->where('lead_type','Web')
                    ->orderBy('leadId','desc')
                    ->get();
                }
                $sellers = DB::table('shops')->get();
        }else{
            if(isset($leadCountry)){
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Web')->where('leadCountry','=',$leadCountry)->whereNull('merchant_id')->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->whereNull('merchant_id')->where('lead_type','Web')->where('leadCountry','=',$leadCountry)->orderBy('leadId','desc')->get();
            } else if(isset($fromDate) && isset($toDate)){
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->whereNull('merchant_id')->where('lead_type','Web')->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Web')->whereNull('merchant_id')->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
            } else {
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Web')->whereNull('merchant_id')->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Web')->whereNull('merchant_id')->orderBy('leadId','desc')->get();
            }
            $sellers = DB::table('shops')->get();    
        }
        $leadStatus= ['','Open','Active','Closed'];
        $sellerLeadStatus=['','Assigned','Contact','Matured'];
        return view('admin.leads.webLeads',compact('sellerLeadStatus','Leads','sellers','leadStatus','country','leadCountry','trashes'));
    }

    public function buy_leads(Request $request){
        $shopId= Auth::user()->shop_id;
        $userId= Auth::user()->id;
        $role= Auth::user()->role_id;
        $fromDate   =   $request->from;
        $toDate     =   $request->to;
        $leadCountry    =   $request->leadCountry;
        $country    =  DB::table('leads')
                        ->groupBy('leadCountry')
                        ->select('leadCountry')
                        ->where('leadCountry','!=','')
                        ->get();
        $trashes    =   [];
        if($role==3){
                if(isset($leadCountry)){
                    $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Web')->where('merchant_id',$userId)->where('leadCountry','=',$leadCountry)->orderBy('leadId','desc')->get();
                    $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Web')->where('merchant_id',$userId)->where('leadCountry','=',$leadCountry)->orderBy('leadId','desc')->get();
                } else if(isset($fromDate) && isset($toDate)){
                    $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Web')->where('merchant_id',$userId)->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
                    $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Web')->where('merchant_id',$userId)->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
                } else {
                    $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Web')->where('merchant_id',$userId)->orderBy('leadId','desc')->get();
                    $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Web')->where('merchant_id',$userId)->orderBy('leadId','desc')->get();
                }
                $sellers = DB::table('shops')->get();    
        }else{
            if(isset($leadCountry)){
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Web')->where('leadCountry','=',$leadCountry)->whereNotNull('merchant_id')->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->whereNotNull('merchant_id')->where('lead_type','Web')->where('leadCountry','=',$leadCountry)->orderBy('leadId','desc')->get();
            } else if(isset($fromDate) && isset($toDate)){
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->whereNotNull('merchant_id')->where('lead_type','Web')->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Web')->whereNotNull('merchant_id')->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
            } else {
                $Leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',1)->where('lead_type','Web')->whereNotNull('merchant_id')->orderBy('leadId','desc')->get();
                $trashes = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leads.active',0)->where('lead_type','Web')->whereNotNull('merchant_id')->orderBy('leadId','desc')->get();
            }
            $sellers = DB::table('shops')->get();    
        }
        $leadStatus= ['','Open','Active','Closed'];
        $sellerLeadStatus=['','Assigned','Contact','Matured'];
        return view('admin.leads.buyLeads',compact('sellerLeadStatus','Leads','sellers','leadStatus','country','leadCountry','trashes'));
    }

    public function reported_leads(Request $request){
        $shopId= Auth::user()->shop_id;
        $userId= Auth::user()->id;
        $role= Auth::user()->role_id;
        $fromDate   =   $request->from;
        $toDate     =   $request->to;
        $leadCountry    =   $request->leadCountry;
        $country    =  DB::table('leads')
                        ->groupBy('leadCountry')
                        ->select('leadCountry')
                        ->where('leadCountry','!=','')
                        ->get();
        if($role==3){
                $categoriesForSeller=$productBySeller=DB::table('products')->where('shop_id','=',$shopId)
                ->rightJoin('category_product','product_id','=','products.id')
                ->rightJoin('categories','categories.id','=','category_product.category_id')
                ->select('category_id')
                ->groupBy('category_id')
                ->get();
                $availableCategoryForSeller=[];
                foreach($categoriesForSeller as $categoryForSeller){
                        $availableCategoryForSeller[]=$categoryForSeller->category_id;
                }
                // $availableCategoryForSeller= implode(',',$availableCategoryForSeller);
                if(isset($leadCountry)){
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leadCountry','=',$leadCountry)
                    ->where('leadStatus','!=',3)
                    ->where('is_reported','1')
                    ->groupBy('leadProduct')
                    ->orderBy('leadId','desc')
                    ->get();
                }else if(isset($fromDate) && isset($toDate)){
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leads.updated_at','>=',$fromDate)
                    ->where('leads.updated_at','<=',$toDate)
                    ->where('leadStatus','!=',3)
                    ->where('is_reported','1')
                    ->groupBy('leadProduct')
                    ->orderBy('leadId','desc')
                    ->get();
                }else{
                    $Leads = DB::table('leads')
                    ->leftjoin('products','products.id','=','leads.leadProduct')
                    ->leftjoin('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->groupBy('leadProduct')
                    ->where('leadStatus','!=',3)
                    ->where('is_reported','1')
                    ->orderBy('leadId','desc')
                    ->get();
                }
                $sellers = DB::table('shops')->get();
        }else{
            if(isset($leadCountry)){
                $Leads = DB::table('leads')->where('is_reported','1')->where('leadCountry','=',$leadCountry)->get();
            } else if(isset($fromDate) && isset($toDate)){
                $Leads = DB::table('leads')->where('is_reported','1')->where('leads.updated_at','>=',$fromDate)->where('leads.updated_at','<=',$toDate)->orderBy('leadId','desc')->get();
            } else {
                $Leads = DB::table('leads')->where('is_reported','1')->orderBy('leadId','desc')->get();
            }
            $sellers = DB::table('shops')->get();    
        }
        $leadStatus= ['','Open','Active','Closed'];
        $sellerLeadStatus=['','Assigned','Contact','Matured'];
        return view('admin.leads.reportedLeads',compact('sellerLeadStatus','Leads','sellers','leadStatus','country','leadCountry'));
    }


    public function active(Request $request){
        $shopId= Auth::user()->shop_id;
        $userId= Auth::user()->id;
        $role= Auth::user()->role_id;
        $fromDate   =   $request->from;
        $toDate     =   $request->to;
        $leadCountry    =   $request->leadCountry;
        $country    =  DB::table('leads')
                        ->groupBy('leadCountry')
                        ->select('leadCountry')
                        ->where('leadCountry','!=','')
                        ->where('leadStatus','=',2)
                        ->get();
        if($role==3){
                $categoriesForSeller=$productBySeller=DB::table('products')->where('shop_id','=',1)
                ->rightJoin('category_product','product_id','=','products.id')
                ->rightJoin('categories','categories.id','=','category_product.category_id')
                ->select('category_id')
                ->groupBy('category_id')
                ->get();
                $availableCategoryForSeller=[];
                foreach($categoriesForSeller as $categoryForSeller){
                        $availableCategoryForSeller[]=$categoryForSeller->category_id;
                }
                // $availableCategoryForSeller= implode(',',$availableCategoryForSeller);
                if(isset($leadCountry)){
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leadCountry','=',$leadCountry)
                    ->where('leadStatus','!=',3)
                    ->groupBy('leadProduct')
                    ->get();
                }else if(isset($fromDate) && isset($toDate)){
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leads.updated_at','>=',$fromDate)
                    ->where('leads.updated_at','<=',$toDate)
                    ->where('leadStatus','!=',3)

                    ->groupBy('leadProduct')
                    ->get();
                }else{
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->groupBy('leadProduct')
                    ->where('leadStatus','!=',3)
                    ->get();
                }
                $sellers = DB::table('shops')->get();
        }else{
            $Leads = DB::table('leads')->get();
            $sellers = DB::table('shops')->get();    
        }
        $leadStatus= ['','Open','Active','Closed'];
        $sellerLeadStatus=['','Assigned','Contact','Matured'];
        $leadStatus=false;
        return view('admin.leads.allLeads',compact('leadStatus','sellerLeadStatus','Leads','sellers','leadStatus','country','leadCountry'));
    }

    public function open(Request $request){
        $shopId= Auth::user()->shop_id;
        $userId= Auth::user()->id;
        $role= Auth::user()->role_id;
        $fromDate   =   $request->from;
        $toDate     =   $request->to;
        $leadCountry    =   $request->leadCountry;
        $country    =  DB::table('leads')
                        ->groupBy('leadCountry')
                        ->select('leadCountry')
                        ->where('leadCountry','!=','')
                        ->where('leadStatus','=',1)

                        ->get();
        if($role==3){
                $categoriesForSeller=$productBySeller=DB::table('products')->where('shop_id','=',1)
                ->rightJoin('category_product','product_id','=','products.id')
                ->rightJoin('categories','categories.id','=','category_product.category_id')
                ->select('category_id')
                ->groupBy('category_id')
                ->get();
                $availableCategoryForSeller=[];
                foreach($categoriesForSeller as $categoryForSeller){
                        $availableCategoryForSeller[]=$categoryForSeller->category_id;
                }
                // $availableCategoryForSeller= implode(',',$availableCategoryForSeller);
                if(isset($leadCountry)){
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leadCountry','=',$leadCountry)
                    ->where('leadStatus','!=',3)
                    ->groupBy('leadProduct')
                    ->get();
                }else if(isset($fromDate) && isset($toDate)){
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leads.updated_at','>=',$fromDate)
                    ->where('leads.updated_at','<=',$toDate)
                    ->where('leadStatus','!=',3)

                    ->groupBy('leadProduct')
                    ->get();
                }else{
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->groupBy('leadProduct')
                    ->where('leadStatus','!=',3)
                    ->get();
                }
                $sellers = DB::table('shops')->get();
        }else{
            $Leads = DB::table('leads')->get();
            $sellers = DB::table('shops')->get();    
        }
        $leadStatus= ['','Open','Active','Closed'];
        $sellerLeadStatus=['','Assigned','Contact','Matured'];
        $leadStatus=false;
        return view('admin.leads.allLeads',compact('leadStatus','sellerLeadStatus','Leads','sellers','leadStatus','country','leadCountry'));
    }

    public function closed(Request $request){
        $shopId= Auth::user()->shop_id;
        $userId= Auth::user()->id;
        $role= Auth::user()->role_id;
        $fromDate   =   $request->from;
        $toDate     =   $request->to;
        $leadCountry    =   $request->leadCountry;
        $country    =  DB::table('leads')
                        ->groupBy('leadCountry')
                        ->select('leadCountry')
                        ->where('leadCountry','!=','')
                        ->where('leadStatus','=',3)
                        ->get();
        if($role==3){
                $categoriesForSeller=$productBySeller=DB::table('products')->where('shop_id','=',1)
                ->rightJoin('category_product','product_id','=','products.id')
                ->rightJoin('categories','categories.id','=','category_product.category_id')
                ->select('category_id')
                ->groupBy('category_id')
                ->get();
                $availableCategoryForSeller=[];
                foreach($categoriesForSeller as $categoryForSeller){
                        $availableCategoryForSeller[]=$categoryForSeller->category_id;
                }
                // $availableCategoryForSeller= implode(',',$availableCategoryForSeller);
                if(isset($leadCountry)){
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leadCountry','=',$leadCountry)
                    ->where('leadStatus','!=',3)
                    ->groupBy('leadProduct')
                    ->get();
                }else if(isset($fromDate) && isset($toDate)){
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->where('leads.updated_at','>=',$fromDate)
                    ->where('leads.updated_at','<=',$toDate)
                    ->where('leadStatus','!=',3)

                    ->groupBy('leadProduct')
                    ->get();
                }else{
                    $Leads = DB::table('leads')
                    ->join('products','products.id','=','leads.leadProduct')
                    ->join('category_product','product_id','=','products.id')
                    ->select('leadId','leadCountry','leadName','leadEmail','leadContact','name as leadProduct','leadOwner','leadGeneratedFrom','leadProductQty','leadCountry','leadStatus','leads.updated_at')
                    ->whereIn('category_product.category_id',$availableCategoryForSeller)
                    ->groupBy('leadProduct')
                    ->where('leadStatus','!=',3)
                    ->get();
                }
                $sellers = DB::table('shops')->get();
        }else{
            $Leads = DB::table('leads')->get();
            $sellers = DB::table('shops')->get();    
        }
        $leadStatus= ['','Open','Active','Closed'];
        $sellerLeadStatus=['','Assigned','Contact','Matured'];
        $leadStatus=false;
        return view('admin.leads.allLeads',compact('leadStatus','sellerLeadStatus','Leads','sellers','leadStatus','country','leadCountry'));
    }
    public function createLead(Request $request){
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

    public function create(){
        $cntry = DB::table('countries')->pluck('name')->toArray();
        foreach ($cntry as $key => $value) {
            $countries[$value] = $value;
        }

        $ctgry = DB::table('categories')->pluck('name')->toArray();
        foreach ($ctgry as $key => $value) {
            $categories[$value] = $value;
        }

        $products = DB::table('products')->pluck('name','id')->toArray();
        foreach ($ctgry as $key => $value) {
            $categories[$value] = $value;
        }
        return view('admin.leads._create',compact('countries','categories','products'));
    }

    public function store(Request $request)
    {
        if($request->action_taken == 'create') {
            $lead_check = DB::table('leads')->where('leadEmail',$request->leadEmail)->orwhere('leadContact',$request->leadContact)->first();    
            if($lead_check) {
                return back()->with('error', 'Duplicate Mobile or Email');
            }
        }
        
        $lead = new LeadHandelling;
        $lead->leadEmail=$request->leadEmail;
        $lead->leadName=$request->leadName;
        $lead->leadContact=$request->leadContact;
        $lead->leadProduct=$request->leadProduct;
        $lead->leadProductTitle=$request->leadProductTitle;
        $lead->leadProductDescription=$request->leadProductDescription;
        $lead->leadCategory=$request->leadCategory;
        $lead->leadProductQty=$request->leadProductQty;
        $lead->leadStatus=1;
        $lead->leadGeneratedFrom='Internal';
        $lead->leadCountry=$request->leadCountry;
        $lead->lead_type='Internal';
        $lead->save();
        return back()->with('success', trans('messages.created', ['model' => 'Lead']));
    }

    public function update(Request $request, $id)
    {
        $id = (int)$id;
        $lead = DB::table('leads')->where('leadId',$id)->first();
        $lead_check = DB::table('leads')->where(function ($query) use ($request, $id) { $query->where('leadEmail',$request->leadEmail)->orwhere('leadContact',$request->leadContact); })->where('leadId','!=',$id)->first();
        if($lead_check) {
            if($lead->leadId != $lead_check->leadId)
            return back()->with('error', 'Duplicate Mobile or Email');
        }

        if(!empty($request->leadEmail)) {
            $lead->leadEmail=$request->leadEmail;
        }
        if(!empty($request->leadName)) {
            $lead->leadName=$request->leadName;
        }
        if(!empty($request->leadContact)) {
            $lead->leadContact=$request->leadContact;
        }
        if(!empty($request->leadProduct)) {
            $lead->leadProduct=$request->leadProduct;
        }
        if(!empty($request->leadProductTitle)) {
            $lead->leadProductTitle=$request->leadProductTitle;
        }
        if(!empty($request->leadProductDescription)) {
            $lead->leadProductDescription=$request->leadProductDescription;
        }
        if(!empty($request->leadCategory)) {
            $lead->leadCategory=$request->leadCategory;
        }
        if(!empty($request->leadProductQty)) {
            $lead->leadProductQty=$request->leadProductQty;
        }
        if(!empty($request->leadCountry)) {
            $lead->leadCountry=$request->leadCountry;
        }
        if(!empty($request->leadReport)) {
            $lead->leadReport=$request->leadReport;
            $lead->is_reported='1';
        }
        DB::table('leads')->where('leadId',$id)->update(json_decode(json_encode($lead),true));
        return back()->with('success', trans('messages.updated', ['model' => 'Lead']));
    }

    public function show($id)
    {
        $id = (int)$id;
        $leads = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->select('leads.*','products.name as leadProduct')->where('leadId',$id)->first();
        
        return view('admin.leads._show', compact('leads'));
    }

    public function edit($id)
    {
        $id = (int)$id;
        $leads = DB::table('leads')->where('leadId',$id)->first();
        $cntry = DB::table('countries')->pluck('name')->toArray();
        foreach ($cntry as $key => $value) {
            $countries[$value] = $value;
        }
        $ctgry = DB::table('categories')->pluck('name')->toArray();
        foreach ($ctgry as $key => $value) {
            $categories[$value] = $value;
        }
        $products = DB::table('products')->pluck('name','id')->toArray();
        return view('admin.leads._edit', compact('leads','countries','categories','products'));
    }

    public function report($id)
    {
        $id = (int)$id;
        $leads = DB::table('leads')->where('leadId',$id)->first();
        return view('admin.leads._report', compact('leads'));
    }

    public function internal($id)
    {
        $id = (int)$id;
        $leads = DB::table('leads')->where('leadId',$id)->first();
        $leads->lead_type = 'Internal';
        DB::table('leads')->where('leadId',$id)->update(json_decode(json_encode($leads),true));
        return back()->with('success', trans('messages.updated', ['model' => 'Lead']));
    }

    public function trash(Request $request, $id)
    {
        $id = (int)$id;
        $leads = DB::table('leads')->where('leadId',$id)->first();
        $leads->active = 0;
        $leads->deleted_at = date('Y-m-d H:i:s');
        DB::table('leads')->where('leadId',$id)->update(json_decode(json_encode($leads),true));
        return back()->with('success', trans('messages.trashed', ['model' => 'Lead']));
    }

    public function unreport(Request $request, $id)
    {
        $id = (int)$id;
        $leads = DB::table('leads')->where('leadId',$id)->first();
        $leads->is_reported = '0';
        DB::table('leads')->where('leadId',$id)->update(json_decode(json_encode($leads),true));
        return back()->with('success', trans('messages.updated', ['model' => 'Lead']));
    }

    public function restore(Request $request, $leadId)
    {
        $leadId = (int)$leadId;
        $leads = DB::table('leads')->where('leadId',$leadId)->first();
        $leads->active = 1;
        DB::table('leads')->where('leadId',$leadId)->update(json_decode(json_encode($leads),true));

        return back()->with('success', trans('messages.restored', ['model' => 'Lead']));
    }

    public function updateSeller(Request $request){
        $leadId= $request->leadId;
        $LeadObject = LeadHandelling::find($leadId);
        $LeadObject->leadOwner = $request->leadOwner;
        $LeadObject->save();
        return redirect('/admin/leads');
    }
    public function updateLeadStatus(Request $request){
        $leadId= $request->leadId;
        $LeadObject = LeadHandelling::find($leadId);
        $LeadObject->leadStatus = $request->leadStatus;
        $LeadObject->save();

        return redirect('/admin/leads');
    }
    public function bulkImport(Request $request){
        $file = $request->file('importFile');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv',file($path));
        $i=1;
        $Projectedleads=[]; 
        foreach($data as $leads){
            if($i!=1){
                     $Projectedleads[]=['leadName'=>$leads[0],'leadEmail'=>$leads[1],
                        'leadContact'=>$leads[2],'leadProduct'=>$leads[3],
                        'leadOwner'=>$leads[4],'leadGeneratedFrom'=>$leads[5],
                        'leadProductQty'=>$leads[6],'leadStatus'=>1,'updated_at'=>date('Y-m-d h:i:s')
                        ];
            }
            $i++;
        }
            LeadHandelling::insert($Projectedleads);
            return redirect('/admin/leads');
    }
    public function updateSellerLead(Request $request){
        $data['feedbackStatus']       =   $request->sellerLeadStatus;
        $data['feedbackText']         =   $request->sellerFeedback;
        $data['feedbackLead']         =   $request->sellerLead;
        $data['feedbackSeller']      =    Auth::user()->id;
        $data['feedbackDated']      =   date('Y-m-d h:i:s');
        DB::table('leadFeedback')->insertGetId($data);
        return redirect('/admin/leads');
    }

    public function leadDetails(Request $request){


        $leadId     =   Input::get('lead');
        $allSellerAction     =  DB::table('leadFeedback')
        ->leftJoin('leads','leadId','=','feedbackLead')
        ->leftJoin('shops','owner_id','=','feedbackSeller')
        ->where('feedbackLead','=',$leadId)
        ->get();
        $active=true;
        $leadStatus= ['','Open','Active','Closed'];
        $sellerLeadStatus=['','Assigned','Contact','Matured'];
        return view('admin.leads.detail',compact('active','allSellerAction','leadStatus','sellerLeadStatus'));
    }

    public function destroy(Request $request, $id)
    {
        if($request->type == 'all') {
            DB::table('leads')->where('lead_type','Internal')->where('active',0)->delete();
        } else if($request->type == 'web') {
            DB::table('leads')->where('lead_type','Web')->where('active',0)->delete();

        }

        return back()->with('success',  trans('messages.deleted', ['model' => 'Lead']));
    }

    public function emptyTrash(Request $request)
    {
        echo "fdas";die;
        if($request->type == 'all') {
            DB::table('leads')->where('lead_type','Web')->where('active',0)->delete();
        } else if($request->type == 'web') {
            DB::table('leads')->where('lead_type','Internal')->where('active',0)->delete();

        }
        if($request->ajax())
            return response()->json(['success' => trans('messages.deleted', ['model' => 'Lead'])]);

        return back()->with('success', trans('messages.deleted', ['model' => 'Lead']));
    }
}
