<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;

use App\Models\Task;
use App\User;
use GuzzleHttp\Client;
class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
  

     $url = 'http://capi.tokeet.com/v1/task?account=1499700995.4461';
        $headers = ['Accept' => 'application/json', 'Authorization' => '0aad3f53-e918-4ea5-b1fc-08a72670bc9e'];
        $http = new \GuzzleHttp\Client();
        $response = $http->get($url, [
            'headers' => $headers,
            'form_params' => [],
        ]);
        //return $response;
        $curl = curl_init();


        $tasks = Task::orderBy('id', 'desc')->paginate(12);

        // merge to array locale and tokket server
        $result = array_map(function($tasks,$response){  
        return array_merge(isset($tasks) ? $tasks : array(), isset($response) ? $response : array());
        },$tasks,$response);  
  
        //return($results);
        return view('task.dashboard',['results'=>$results]);
    }


     public function create()
    {
       $users = User::all();
        return view('task.create',['users'=>$users]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        

        $tasks_rules=array(
            'name'=>'required|string|max:255',
            'list'=>'required|string|max:255',
            'due'=>'required|after:yesterday',
            
        );
        $tasks_validation=Validator::make($request->all(), $tasks_rules);

        if($tasks_validation->fails())
        {
            return redirect()->back()->withErrors($tasks_validation)->withInput();
        }

       

        $task_add = New Task();
        $task_add->name = $request->name;
        $task_add->due = $request->due;
        $task_add->list = $request->list;
        $task_add->inquiry_id = $request->inquiry_id;
        $task_add->user_id = $request->user_id;
        $task_add->notes = $request->notes;
        if($request->status == 'active'){
          $task_add->status = 1;
        }elseif($request->status == 'complete'){
        $task_add->status = 2;} else {$task_add->status = 0;}

        $task_add->save();

          return back()->with('success','saved Task successfully');
           
    }


    public function edit($id)
      {
          $users = User::all();

          $tasks = Task::findOrFail($id);

           $url = 'http://capi.tokeet.com/v1/task/$id_task?account=1499700995.4461';
        $headers = ['Accept' => 'application/json', 'Authorization' => '0aad3f53-e918-4ea5-b1fc-08a72670bc9e'];
        $http = new \GuzzleHttp\Client();
        $response = $http->get($url, [
            'headers' => $headers,
            'form_params' => [],
        ]);
        //return $response;
        $curl = curl_init();


         // merge to array locale and tokket server one array resulte
        $results = array_map(function($tasks,$response){  
        return array_merge(isset($tasks) ? $tasks : array(), isset($response) ? $response : array());
        },$tasks,$response); 



          return view('task.edit',['results'=>$results,'users'=>$users]);
      }


     public function update(Request $request, $id)
    {
         //dd($request->all());
         $tasks_rules=array(
            'name'=>'required|string|max:255',
            'list'=>'required|string|max:255',
            'due'=>'required|after:yesterday',
            
        );
        $tasks_validation=Validator::make($request->all(), $tasks_rules);

        if($tasks_validation->fails())
        {
            return redirect()->back()->withErrors($tasks_validation)->withInput();
        }


        $url = 'http://capi.tokeet.com/v1/task/$id_task?account=1499700995.4461';
        $headers = ['Accept' => 'application/json', 'Authorization' => '0aad3f53-e918-4ea5-b1fc-08a72670bc9e'];
        $http = new \GuzzleHttp\Client();
        $response = $http->get($url, [
            'headers' => $headers,
            'form_params' => [],
        ]);
        //return $response;
        $curl = curl_init();

        $check_id = Task::where('id',$id)->first();

        if($check_id != '' && $response == '' ){
          // في حال موجود على اللوكلا وغير موجود ع السيرفر يتم تعديله على اللوكال فقط
        $task_add = Task::findOrFail($id);
        $task_add->name = $request->name;
        $task_add->due = $request->due;
        $task_add->list = $request->list;
        $task_add->inquiry_id = $request->inquiry_id;
        $task_add->user_id = $request->user_id;
        $task_add->notes = $request->notes;
        if($request->status == 'active'){
          $task_add->status = 1;
        }elseif($request->status == 'complete'){
        $task_add->status = 2;} else {$task_add->status = 0;}

        $task_add->save();
      }
      
      // في حال كانت القيمة موجودة locale and tokket server
      elseif ($check_id != '' && $response != '') {

        $task_add = Task::findOrFail($id);
        $task_add->name = $request->name;
        $task_add->due = $request->due;
        $task_add->list = $request->list;
        $task_add->inquiry_id = $request->inquiry_id;
        $task_add->user_id = $request->user_id;
        $task_add->notes = $request->notes;
        if($request->status == 'active'){
          $task_add->status = 1;
        }elseif($request->status == 'complete'){
        $task_add->status = 2;} else {$task_add->status = 0;}

        $task_add->save();


        $url = url('capi.tokeet.com/v1/task/$id_task?account=1499700995.4461
');
            $headers = ['Accept' => 'application/json'];
            $http = new Client();
            $response = $http->post($url, [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->name,
                    'list' => $request->list,
                    'due' => $request->due,
                ],
            ]);

      }
      // اذا كانت فقط القيمة في السيرفر tokket
      else
      {
         $url = url('capi.tokeet.com/v1/task/$id_task?account=1499700995.4461
          ');
            $headers = ['Accept' => 'application/json'];
            $http = new Client();
            $response = $http->post($url, [
                'headers' => $headers,
                'form_params' => [
                    'name' => $request->name,
                    'list' => $request->list,
                    'due' => $request->due,
                ],
            ]);


      }

        


            
        return back()->with('success','Edit successfully');
           
    }


     public function destroy($id)
    {
        // dd($id);
        $task = Task::query()->findOrFail($id);
        if ($task->delete()) {
            return back()->with('success','Deleted successfully');
        }
        return back()->with('falis','Deleted Falis');
    }

}
