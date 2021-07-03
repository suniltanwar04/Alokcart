<?php

namespace App\Http\Controllers\Buylead;

use Carbon\Carbon;
use App\Category;
use App\Inventory;
use App\CategoryGroup;
use App\CategorySubGroup;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
// use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Session;
// use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Database\Eloquent\Builder;
use DB;

class BuyleadsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        session(['return_to_buy_lead'=>false,'return_to_buy_lead_url'=>'']);
        $term = $request->input('q');

        $products = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->where('leads.active',1)->where('lead_type','Internal')->where('is_reported','!=','1');

        $products_cnt = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->where('leads.active',1)->where('lead_type','Internal')->where('is_reported','!=','1');
        
        $countries = $products_cnt->distinct()->orderBy('leads.leadCountry','asc')->pluck('leads.leadCountry')->toArray();
        
        $products = $products->orderBy('leadId','desc');

        $p_ids = $products->distinct()->pluck('products.id')->toArray();
        $products_new = Inventory::where('active', 1)->whereIn('product_id',$p_ids)->get();
        // $products_new = Inventory::where('active', 1)->get();
        $products_new->load(['product' => function($q) {
            $q->select('id')->with([
                'categories:id,name,slug,category_sub_group_id',
                'categories.subGroup:id,name,slug,category_group_id',
                'categories.subGroup.group:id,name,slug'
            ]);
        }]);


        $category = Null;

        if( $request->has('in')) {
            //$in = array_keys($request->input('in'));
            $category = Category::where('slug', $request->input('in'))->active()->firstOrFail();
            $products = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->join('category_product','leads.leadProduct','category_product.product_id')->join('categories','categories.id','category_product.category_id')->where('categories.slug',$request->input('in'))->where('leads.active',1)->where('lead_type','Internal')->where('is_reported','!=','1')->orderBy('leadId','desc');
        }
        else if($request->has('insubgrp') && ($request->input('insubgrp') != 'all')){
            $category = CategorySubGroup::where('slug', $request->input('insubgrp'))->active()->firstOrFail();
            $products = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->join('category_product','leads.leadProduct','category_product.product_id')->join('categories','categories.id','category_product.category_id')->join('category_sub_groups','category_sub_groups.id','categories.category_sub_group_id')->where('category_sub_groups.slug',$request->input('insubgrp'))->where('leads.active',1)->where('lead_type','Internal')->where('is_reported','!=','1')->orderBy('leadId','desc');
        }
        else if($request->has('ingrp')){
            $category = CategoryGroup::where('slug', $request->input('ingrp'))->active()->firstOrFail();
            $products = DB::table('leads')->leftjoin('products','products.id','=','leads.leadProduct')->join('category_product','leads.leadProduct','category_product.product_id')->join('categories','categories.id','category_product.category_id')->join('category_sub_groups','category_sub_groups.id','categories.category_sub_group_id')->join('category_groups','category_groups.id','category_sub_groups.category_group_id')->where('category_groups.slug',$request->input('ingrp'))->where('leads.active',1)->where('lead_type','Internal')->where('is_reported','!=','1')->orderBy('leadId','desc');
        }

        if($request->has('country')) {
            $products = $products->where('leadCountry', $request->input('country'));
        }

        if($request->has('sort_by') && !empty($request->input('sort_by'))) {
            $end_date = date('Y-m-d H:i:s');
            $start_date = date('Y-m-d H:i:s',strtotime($end_date . ' -'.$request->input('sort_by').' day'));
            $products = $products->whereBetween('leads.created_at', [$start_date,$end_date]);
        } else {
            if($request->has('days')) {
                $end_date = date('Y-m-d H:i:s');
                $start_date = date('Y-m-d H:i:s',strtotime($end_date . ' -'.$request->input('days').' day'));
                $products = $products->whereBetween('leads.created_at', [$start_date,$end_date]);
            }
        }
        if( $request->has('q')) {
            $products = $products->where('leads.leadProductTitle','like' ,'%'.$request->input('q').'%');
        }

        $products = $products->select('leads.*','products.name as leadProduct','products.id as productId','products.slug');
        $products = $products->paginate(config('system.view_listing_per_page', 16));
        $pagination_data = $products;
        $products = $products->toArray();
        foreach($products['data'] as $k => $v) {
            $products['data'][$k] = json_decode(json_encode($v),true);
        }

        return view('search_results', compact('products', 'category', 'brands', 'priceRange', 'pagination_data','products_new','countries'));
    }

    public function addToBuyLeads(Request $request)
    {
        $id = $request->leadId;
        if(Auth::user()) {
            $user_id = Auth::user()->id;
            $role_id = Auth::user()->role_id;
            if($role_id == 3) {
                $lead_count = DB::table('buy_lead_count')->where('merchant_id',$user_id)->where('date',date('Y-m-d'))->first();
                if($lead_count) {
                    if($lead_count->lead_count >= 10) {
                        return response('Item not Added', 403);        
                    }
                    DB::table('buy_lead_count')->where('merchant_id',$user_id)->where('date',date('Y-m-d'))->update(['lead_count'=>($lead_count->lead_count + 1)]);                    
                } else {
                    $data = array();
                    $data['merchant_id']       =   $user_id;
                    $data['date']              =   date('Y-m-d');
                    DB::table('buy_lead_count')->insertGetId($data);
                }
                DB::table('leads')->where('leadId',$id)->update(['merchant_id'=>$user_id, 'lead_type'=>'Buy']);
                return response('Item Added', 200);
            } else {
                return response('Item not added', 444);
            }
        } else {
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https":"http")."://".$_SERVER['HTTP_HOST'].'/buy-leads/'.$id.'/quickView';
            session(['return_to_buy_lead'=>true,'return_to_buy_lead_url'=>$link]);
            return response('Item not added', 444);
        }
    }

    public function quickViewItem($leadId)
    {
        $items = DB::table('leads')->where('leadId',$leadId)->first();
        return view('lead_quickview', compact('items'));
    }
}