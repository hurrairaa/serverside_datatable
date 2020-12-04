<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\PaginationResourceCollection;

use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    public function index(Request $request)
    {   

        $length = $request->input('length');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        $year=$request->input('year');
        $month=$request->input('month');
        $dateRange=$request->date;
        $query=DB::table('users')->join('profiles','users.id','=','profiles.user_id')
                        ->join('products','users.id','=','products.user_id')
                        ->select('users.id','users.name','users.email','users.created_at','profiles.phone_no','profiles.address','products.title')
                        ->orderBy($this->getOrderBy($orderBy),$orderByDir)
                        ;
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%')
                ->orWhere('address', 'like', '%' . $searchValue . '%')
                ->orWhere('phone_no', 'like', '%' . $searchValue . '%')
                ->orWhere('address', 'like', '%' . $searchValue . '%')
                ->orWhere('title','like','%'.$searchValue.'%');
            });
        }
        if(isset($month)){
            $query->whereMonth('users.created_at', $month);
        }
        if(isset($year)){
            $query->whereYear('users.created_at', '=', $year);
        }
        if(isset($dateRange)){
            $dateRange=explode('|',$dateRange);
            if($dateRange[0]==$dateRange[1]){
                $query->where('users.created_at','=',$dateRange[0]);
            }else{
                $query->where('users.created_at','>=',$dateRange[0])->where('users.created_at','<=',$dateRange[1]);
            }

        }
        $data = $query->paginate($length);
        
        return [
            'data' => $data->items(),
            'links'=>[
                "first"=>$data->url('first'),
                "last"=> $data->url('last'),
                "prev"=> $data->previousPageUrl(),
                "next"=> $data->nextPageUrl()
            ],
            'payload' => $request->all(),
            "meta"=> [
                "current_page"=> $data->currentPage(),
                "from"=> $data->currentPage(),
                "last_page"=> $data->lastPage(),
            //     "path"=> $data->path,
                "per_page"=> $data->count(),
            //     "to"=> $data->to,
                "total"=> $data->lastPage()
            ]
        ];
        // return new DataTableCollectionResource($data);
        
    }
    private function getOrderBy($orderBy){
        if(in_array($orderBy,['name','email'])){
            return 'users.'.$orderBy;
        }else if(in_array($orderBy,['address','phone_no'])){
            return 'profiles.'.$orderBy;
        }if(in_array($orderBy,['title'])){
            return 'products.'.$orderBy;
        }else{
            return 'users.id';
        }
    }
}
