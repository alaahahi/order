<?php


namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\City;
use App\Models\Box;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use PDF;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('customers')->select(['customers.id','customers.company','customers.service_date','customers.Address', 'customers.city_id','customers.Machines_Large', 'customers.Machines_Small', 'customers.Starting_Unit', 'customers.phone']);
            return Datatables::of($data)
                    ->addColumn('Starting_Units', function($data){
                         return date('Y-m-d', strtotime($data->Starting_Unit. ' + 0 day')) ;
                    })
                    ->addColumn('Service_Date', function($data){
                        $date =date('Y-m-d', strtotime($data->Starting_Unit. ' + 15 day'));
                        $ids = $data->id;
                        if ($data->service_date)
                        {
                        return $date; 
                        }
                  else
                  DB::update('update customers set service_date = ? where id = ?',[$date, $ids]);
                    })
                    ->make(true);
        }

        return view('customer');
    }
    public function service_order(Request $request)
    {
      
        if ($request->ajax()) {
            $data = DB::table('customers')->join('city', 'customers.city_id', '=', 'city.id')->join('order', 'customers.id', '=', 'order.Customer_id')
            ->select(['customers.id','customers.company','customers.is_service','customers.service_date','order.order_date','order.Customer_id','customers.Address','city.city', 'customers.city_id','order.Machines_Large', 'order.Machines_Small', 'customers.Starting_Unit', 'customers.phone']);
            return Datatables::of($data)
                    ->addColumn('Starting_Units', function($data){
                         return date('Y-m-d', strtotime($data->Starting_Unit. ' + 0 day')) ;
                    })
                    ->addColumn('Order_Date', function($data){
                        $date =date('Y-m-d', strtotime($data->Starting_Unit. ' + 30 day'));
                        $date_order =date('Y-m-d', strtotime($data->Starting_Unit. ' + 15 day'));
                        $ids = $data->id;
                        if ($data->service_date && $data->order_date)
                        {
                        return $date; 
                        }
                        else
                        DB::update('update order set order_date = ? where id = ?',[$date_order, $ids]);
                        DB::update('update customers set service_date	 = ? where id = ?',[$date, $ids]);
                    })
                    ->addColumn('action', function($row){
                        if ($data->is_service)
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"    data-id="'.$data->id.'" data-original-title="customers" class=" btn btn-success btn-sm ">Done</a>';
                        else
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->id.'" data-id="'.$data->id.'" data-original-title="customers" class=" btn btn-danger btn-sm isdone">Service</a>';
   
                         return $btn;
                    })
                    ->rawColumns(['action'])->filter(
                        function ($query){
                            $today = date('yy-m-d');
                            $query->where('order_date', 'like', "$today");
                    
                    })
                    ->make(true);
        }

        return view('customer_order');

    }
    public function order_today(Request $request)
    {
      
        if ($request->ajax()) {
            $data = DB::table('customers')->join('city', 'customers.city_id', '=', 'city.id')->join('order', 'customers.id', '=', 'order.Customer_id')
            ->select(['customers.id','order.id as order_id','order.Monthly_Rent','order.order_date','order.is_done','customers.company','order.created_at','order.service_date','order.Customer_id','customers.Address','city.city', 'customers.city_id','order.Machines_Large', 'order.Machines_Small','order.Machines_Large_price', 'order.Machines_Small_price', 'customers.Starting_Unit', 'customers.phone']);
            return Datatables::of($data)
                    ->addColumn('orderdate', function($data){  
                        if($data->order_date == date('yy-m-d') ){
                        DB::update('update `order` set is_done = ? where id = ?',[false, $data->order_id]);
                        }
                        return $data->created_at;
                    })
                    ->addColumn('total', function($data){
                        if($data->Monthly_Rent)
                        $total = $data->Monthly_Rent ;
                        else {
                        $total =($data->Machines_Large * $data->Machines_Large_price)+($data->Machines_Small * $data->Machines_Small_price);
                        $ids = $data->order_id;
                        DB::update('update `order` set Monthly_Rent= ? where id = ?',[$total, $ids]);
                        DB::update('update `order` set order_date = ? where id = ?',[$data->created_at, $data->order_id]);
                        $date_servic =date('Y-m-d', strtotime($data->created_at. ' + 15 day'));
                        DB::update('update `order` set service_date=? where id =?',[$date_servic,$data->order_id]);
                        }
                        return $total;
                    })
                    ->addColumn('action', function($data){
                       if ($data->is_done)
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"    data-id="'.$data->order_id.'" data-original-title="IsDone" class=" btn btn-success btn-sm ">Done</a>';
                        else
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->order_id.'" data-id="'.$data->order_id.'" data-original-title="IsDone" class=" btn btn-danger btn-sm isdone">Pay</a>';
   
                         return $btn;
                    })
                    ->rawColumns(['action'])->filter(
                        function ($query){
                            $today = date('yy-m-d');
                            $next_order =date('Y-m-d', strtotime($today.' +1 month'));
                            $query->where('order.order_date', 'like', "$next_order")->orWhere( 'order.created_at', '=',$today)->orwhere('order.order_date', 'like', "$today");
                    })
                    ->make(true);
        }

        return view('order_today');

    }
    public function service_today(Request $request)
    {
      
        if ($request->ajax()) {
            $data = DB::table('customers')->join('city', 'customers.city_id', '=', 'city.id')->join('order', 'customers.id', '=', 'order.Customer_id')
            ->select(['customers.id','order.is_service','order.id as order_id','order.created_at as order_create_at','customers.company','order.service_date','order.order_date','order.Customer_id','customers.Address','city.city', 'customers.city_id','order.Machines_Large', 'order.Machines_Small', 'customers.Starting_Unit', 'customers.phone','order.service_day']);
            return Datatables::of($data)
                    ->addColumn('action', function($data){
                        $today = date('yy-m-d');
                        if($data->service_date == date('yy-m-d'))
                        DB::update('update `order` set is_service = false   where id =?',[$data->order_id]);
                        if ($data->is_service)
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"    data-id="'.$data->order_id.'" data-original-title="customers" class=" btn btn-success btn-sm ">Done</a>';
                        else
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" id="'.$data->order_id.'" data-id="'.$data->order_id.'" data-original-title="customers" class=" btn btn-danger btn-sm is_service">Service</a>';
   
                         return $btn;
                    })
                    ->rawColumns(['action'])->filter(
                        function ($query){
                            $today = date('yy-m-d');
                            $query->where('order.service_date', 'like', "$today");
                    
                    })
                    ->make(true);
        }

        return view('service_today');

    }
    public function generatePDF_not_bills($from =0,$to=0)
    {
        $new = date('yy-m-d');
        if ($from == 0) $from ="2020-10-1";
        if ($to == 0) $to =date('yy-m-d');
          $bill = DB::table('order')
          ->join('customers', 'customers.id', '=', 'order.Customer_id')
          ->join('city', 'customers.city_id', '=', 'city.id')
          ->whereBetween('order.order_date', [$from, $to])
          ->where('order.is_done', '=', 0)
          ->where('order.order_date', '<=',$new );
          $customers = $bill->select('*')->get() ;
        $pdf = PDF::loadView('not_bills_pdf',compact('customers','new','from','to'))->setPaper('a4', 'landscape');
        return $pdf->download('Order List Today-'.$new.'..pdf');
    }  

    public function generatePDF_bills($from =0,$to=0,$total=0)
    {
        $new = date('yy-m-d');
        if ($from == 0) $from ="2020-10-1";
        if ($to == 0) $to =date('yy-m-d');
          $bill = DB::table('box')
          ->join('customers', 'customers.id', '=', 'box.Customer_id')
          ->join('order', 'order.id', '=', 'box.order_id')
          ->join('city', 'customers.city_id', '=', 'city.id')
          ->whereBetween('box.created_at', [$from, $to]);
          $customers = $bill->select('*')->get() ;
        $pdf = PDF::loadView('bills_pdf',compact('customers','new','from','to','total'))->setPaper('a4', 'landscape');
        return $pdf->download('Order List Today-'.$new.'..pdf');
    }  
        public function generatePDF_service_today()
        {
            $new = date('yy-m-d');
            $customers = DB::table('customers')
            ->join('order', 'order.Customer_id', '=', 'customers.id')
            ->select('*')->where('order.service_date', '=', $new)
            ->get();
            $pdf = PDF::loadView('service_today_pdf',compact('customers','new'))->setPaper('a4', 'landscape');
            return $pdf->download('Service Today-'.$new.'..pdf');
        }
        public function generatePDF_order_today()
        {
            $new = date('yy-m-d');
            $customers = DB::table('customers')
            ->join('order', 'order.Customer_id', '=', 'customers.id')
            ->select('*')->where('order.order_date', '=',  $new)
            ->orWhere( 'order.created_at', '=',  $new)->orWhere( 'order_date', '=',  $new)
            ->get();
            $pdf = PDF::loadView('order_today_pdf',compact('customers','new'))->setPaper('a4', 'landscape');
            return $pdf->download('Order List Today-'.$new.'..pdf');
        }  
        public function generatePDF_order_today_all()
        {
            $new = date('yy-m-d');
            $customers = DB::table('customers')
            ->join('order', 'order.Customer_id', '=', 'customers.id')
            ->select('*')->where('order.order_date', '=',  $new )
            ->orWhere( 'order.order_date', '=',  $new)->orWhere( 'order_date', '=',  $new)
            ->get();
            $pdf = PDF::loadView('order_today_all_pdf',compact('customers','new'))->setPaper('a4', 'portscape');
            return $pdf->download('ALL Order Today-'.$new.'..pdf');
        } 
        public function bill_today(Request $request)
        {
            $new = date('yy-m-d');
            $customers = DB::table('box')
            ->join('customers', 'customers.id', '=', 'box.Customer_id')
            ->join('order', 'order.id', '=', 'box.order_id')
            ->join('city', 'customers.city_id', '=', 'city.id')
            ->where('box.created_at', '=',  $new )
            ->select('*')->get();
            if ($request->ajax()) {
            return Datatables::of($customers)->make(true);
            }
            //return   response()->json($customers);
           return view('bill_today',compact('customers'));

        }  
        public function bills(Request $request,$from =0,$to=0)
        {
          if ($from == 0) $from ="2020-10-1";
          if ($to == 0) $to =date('yy-m-d');
            $bill = DB::table('box')
            ->join('customers', 'customers.id', '=', 'box.Customer_id')
            ->join('order', 'order.id', '=', 'box.order_id')
            ->join('city', 'customers.city_id', '=', 'city.id')
            ->whereBetween('box.created_at', [$from, $to]);
            $bills = $bill->select('*','order.id as o_id','box.created_at as created')->get() ;
            if ($request->ajax()) {
            return  Datatables::of($bills)
            ->addColumn('action', function($bills){
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"    data-id="'.$bills->o_id.'" data-original-title="print" class=" btn btn-warning btn-sm print '.$bills->o_id.' ">Print</a>';
                  return $btn;
             })
            ->make(true);
            }
            //return   response()->json($customers);
           return view('bills');

        } 
        public function not_bills(Request $request,$from =0,$to=0)
        {
            $new = date('yy-m-d');
          if ($from == 0) $from ="2020-10-1";
          if ($to == 0) $to =date('yy-m-d');
            $bill = DB::table('order')
            ->join('customers', 'customers.id', '=', 'order.Customer_id')
            ->join('city', 'customers.city_id', '=', 'city.id')
            ->whereBetween('order.order_date', [$from, $to])
            ->where('order.is_done', '=', 0)
            ->where('order.order_date', '<=',$new );
            $bills = $bill->select('*','order.id as o_id')->get() ;
            if ($request->ajax()) {
            return  Datatables::of($bills)
            ->addColumn('action', function($bills){
                if ($bills->is_done)
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip"    data-id="'.$bills->o_id.'" data-original-title="IsDone" class=" btn btn-success btn-sm ">Done</a>';
                 else
                 $btn = '<a href="javascript:void(0)" data-toggle="tooltip" id="'.$bills->o_id.'" data-id="'.$bills->o_id.'" data-original-title="IsDone" class=" btn btn-danger btn-sm isdone">Pay</a>
                  <a href="javascript:void(0)" data-toggle="tooltip"    data-id="'.$bills->o_id.'" data-original-title="print" class=" btn btn-warning btn-sm print '.$bills->o_id.' ">Print</a>
                 ';
                  return $btn;
             })
            ->make(true);
            
            }
            //return   response()->json($customers);
           return view('not_bills',compact('bills','new'));

        } 
        public function invoice()
        {
            $new = date('yy-m-d');
            $customers = DB::table('customers')
            ->join('order', 'order.Customer_id', '=', 'customers.id')
            ->select('*')->where('order.order_date', '=',  $new)
            ->get();
            return view('invoice',compact('customers','new'));

        }  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\request  $request
     * @return \Illuminate\Http\Response
     */
    public function addorder(Request $request)
    {
        $name = $request->input('names');     
        return $name;  //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = array('id' => $id);
        $customer  = Customer::where($where)->first();
      
        return Response::json($where);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
    }
    public function isdone($id)
    {
        $new = date('yy-m-d');
        DB::update('update `order` set is_done = true ,order_date =DATE_ADD(order_date, INTERVAL 1 MONTH)  where id =?',[$id]);
        $orders = DB::table('order')
        ->join('customers', 'customers.id', '=', 'order.customer_id')
        ->select('customers.id as customer_id','order.Machines_Large', 'order.id','order.Machines_Small','order.Machines_Large_price', 'order.Machines_Small_price')->where('order.id', '=',  $id)
        ->first();
        //DB::update('update `customers` set  service_date =DATE_ADD(service_date, INTERVAL 0.5 MONTH)  where customers.id =?',[$orders->customer_id]);
        $total = ($orders->Machines_Large * $orders->Machines_Large_price)+($orders->Machines_Small * $orders->Machines_Small_price);
        DB::insert('insert into box (Customer_id, order_id,total,created_at) values (?,?,?,?)', [$orders->customer_id,$orders->id,$total,$new]);
        return response()->json(['success'=>'Item saved successfully.']);
    }
    public function print_order($id)
    {
        $new = date('yy-m-d');
        $customers = DB::table('order')
        ->join('customers', 'customers.id', '=', 'order.customer_id')
        ->select('customers.id as customer_id','order.Machines_Large','customers.company','customers.phone','customers.Address', 'order.id','order.Machines_Small','order.Machines_Large_price', 'order.Machines_Small_price')
        ->where('order.id', '=',  $id)
        ->get();
        $pdf = PDF::loadView('order_today_all_pdf',compact('customers','new'))->setPaper('a4', 'portscape');
        return $pdf->download('ALL Order Today-'.$new.'.pdf');
    }
    public function is_service($id)
    {
        $new = date('yy-m-d');
        $day = DB::table('order')
        ->select('service_day')->where('id', '=',  $id)
        ->first();
        DB::update('update `order` set is_service = true,service_date =DATE_ADD(service_date, INTERVAL ? day)  where id =?',[$day->service_day,$id]);
        return response()->json(['success'=>'Item saved successfully.']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where('id',$id)->delete();
  
        return Response::json($customer);
    }
}
