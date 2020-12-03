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

        
        $query=DB::table('users')->join('profiles','users.id','=','profiles.user_id')
                        ->join('products','users.id','=','products.user_id')
                        ->select('users.id','users.name','users.email','users.created_at','profiles.phone_no','profiles.address','products.title')
                        ->orderBy('users.'.$orderBy,$orderByDir)
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
}
