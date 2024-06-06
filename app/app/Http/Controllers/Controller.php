<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Laundry;
use App\Models\Supply;
use App\Models\Update;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Laravel\Sail\Console\PublishCommand;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home_page(){
        return view('welcome');
    }

    public function dashboard(){

        $completeApplications = Laundry::all();

        $firmRegistrations = [];
        foreach ($completeApplications as $application) {
            $firmName = $application->date;
            if (!isset($firmRegistrations[$firmName])) {
                $firmRegistrations[$firmName] = 0;
            }
            $firmRegistrations[$firmName]++;
        }
        $labels = [];
        $data = [];
        foreach ($firmRegistrations as $firmName => $totalCustomers) {
            $labels[] = $firmName;
            $data[] = $totalCustomers;
        }
        return view('dashboard', compact('labels', 'data'),[
            'laundries' => Laundry::all(),
        ]);
    }

    public function laundry_list(){
        return view('laundry-list',[
            'laundries' => Laundry::latest()->filter(request(['search']))->paginate(10),
            'categories' => Category::all(),
        ]);
    }

    public function store_laundry_records(Request $request){
        $laundry_records=$request->validate([
            'date' => 'required',
            'customer_name' => 'required',
            'phone_number' => 'required',
            'address' =>'required',
            'category' => 'required',
            'weight' => 'nullable',
            'que_number' => 'required',
            'price' => 'required',
        ]);

        try{
            Laundry::create($laundry_records);
            return redirect()->back()->with('laundry_recorded','New laundry recoreded successfully');
        }
        catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function update_records(Request $request, Laundry $laundry){
        $laundryRecords=$request->validate([
            'date' => 'required',
            'customer_name' => 'required',
            'phone_number' => 'required',
            'address' =>'required',
            'category' => 'required',
            'weight' => 'required',
            'que_number' => 'required',
            'status' => 'nullable',
            'price' => 'required',
        ]);

        try{
            $laundry->update($laundryRecords);
            return redirect()->back()->with('update_message','Record updated successfully');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function find_single($id){
        return view('single-list',[
            'laundry'=> Laundry::find($id),
            'categories' => Category::all(),
        ]);
    }

    public function delete_record(Request $request, Laundry $laundry){
        try{
            $laundry->delete();
            return redirect('/laundry-list')->with('record_deleted','Record deleted successfully');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function category(){
        return view('laundry-category',[
            'laundries' => Laundry::all(),
            'categories' => Category::paginate(5),
        ]);
    }

    public function store_category(Request $request){
        $categoryData=$request->validate([
            'category' => 'required',
            'price' => 'required',
        ]);

        try{
            Category::create($categoryData);
            return redirect()->back()->with('category_created','Data saved successfully!');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function delete_category(Request $request, Category $category){
       try{
        $category->delete();
        return redirect()->back();
       }catch(\Throwable $e){
        return $e->getMessage();
       }
    }

    public function go_inventory(){
        return view('inventory',[
            'supplies' => Supply::filter(request(['search']))->paginate(5),
        ]);
    }

    public function store_supply_records(Request $request){
        $supplyRecords=$request->validate([
            'date' => 'required',
            'supply_name' => 'required',
            'quantity' => 'required',
            'type' => 'required',
        ]);

        try{
            Supply::create($supplyRecords);
            return redirect()->back()->with('supply_created','Data inserted successfully');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function delete_supply_record(Request $request, Supply $supply){
        try{
            $supply->delete();
            return redirect()->back();
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function generate_report(){
        return view('generate-report',[
            'supplies' => Supply::all(),
            'categories' => Category::all(),
            'laundries' => Laundry::filter(request(['search']))->paginate(10),
        ]);
    }

    public function user_management(){
        return view('user-management',[
            'users' => User::paginate(5),
        ]);
    }

    public function store_users(Request $request){
        $userData=$request->validate([
            'name' => 'required',
            'username' => ['required', Rule::unique('users','username')],
            'password' => 'required',
            'role' => 'required',
        ]);

        try{
            User::create($userData);
            return redirect()->back()->with('sucess_message','User created successfully');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function single_user($id){
        return view('view-actions',[
            'user' => User::find($id),
        ]);
    }

    public function update_users(Request $request, User $user){
        $userDataUpdated=$request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        try{
            $user->update($userDataUpdated);
            return redirect()->back()->with('updated_message','User updated successfully');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function delete_user(Request $request, User $user){
        try{
            $user->delete();
            return redirect('/user-management')->with('user_deleted_message','User deleted successfully');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function authenticate_user(Request $request){
        $loginDetails=$request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try{
            if(Auth::guard('web')->attempt($loginDetails)){
                $request->session()->regenerateToken();
                return redirect('/dashboard')->with('login_success','Logged in successfully!');
            }else if(Auth::guard('customer')->attempt($loginDetails)){
                $request->session()->regenerateToken();
                return redirect('/customers/dashboard')->with('customer_logged_in','Logged in successfully!');
            }
            else{
                return redirect()->back()->with('error_message','Incorrect username or password!');
            }
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function logout_user(Request $request){
        try{
            Auth::guard('web')->logout();
            return redirect('/')->with('logout_message','Loged out successfully!');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function show_post_news(){
        return view('post-news');
    }

    public function post_news(Request $request){
        $newsData=$request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        try{
            Update::create($newsData);

            return redirect()->back()->with('news_posted','News posted successfully!');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    //CUSTOMER DASHBOARD
    public function customer_dashboard(){
        return view('customers.dashboard',[
            'laundries' => Laundry::all(),
            'updates' => Update::latest()->get(),
        ]);
    }

    public function my_profile(){
        return view('customers.my-profile');
    }

    public function place_order(){
        return view('customers.place-order',[
            'laundries' => Laundry::latest()->paginate(5),
            'categories' => Category::all(),
        ]);
    }

    public function show_single_item($id){
        return view('customers.my-list',[
            'laundry' => Laundry::find($id),
            'categories' => Category::all(),
        ]);
    }

    public function edit_my_laundry(Request $request, Laundry $laundry){
        $myLaundryData=$request->validate([
            'date' => 'required',
            'customer_name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'category' => 'required',
            'que_number' => 'required',
        ]);

        try{
            $laundry->update($myLaundryData);
            return redirect()->back()->with('record_updated','Data updated succesffully!');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function order_history(){
        return view('customers.order-history',[
            'laundries' => Laundry::latest()->paginate(10),
            'categories' => Category::all(),
        ]);
    }

    public function register(){
        return view('register');
    }

    public function store_customers(Request $request){
        $customerData=$request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        try{
            $customer = Customer::create($customerData);

            Auth::guard('customer')->login($customer);

            $request->session()->regenerateToken();

            return redirect('/customers/dashboard')->with('customer_logged_in','Logged in successfully!');

        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function edit_customer_data(Request $request, Customer $customer){
        $customerData=$request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        try{
            $customer->update($customerData);
            return redirect()->back()->with('customer_edited_message','Customer edited successfully!');
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }
}
