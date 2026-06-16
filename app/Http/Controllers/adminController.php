<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
 

class adminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where([
            ['name', '=', $request->name],
            ['password', '=', $request->password],
        ])->first();

        if (!$admin) {

            $request->merge(['user' => null]);

            $request->validate(
                [
                    'user' => 'required',
                ],
                [
                    'user.required' => 'User does not exist',
                ]
            );
        }

        Session::put("admin",$admin);
        return redirect ("dashboard");
        
    }

    public function dashboard()
    {
        $admin = Session::get("admin");
        if($admin){
            $users = User::paginate(10);
            return view('admin', ['name' => $admin->name , 'users' => $users]);
        } else {
            return redirect ("admin-login");
        }
        
    }   

    public function categories(){
        $categories = Category::get();
        // return $categories;
        $admin = Session::get("admin");
        if($admin){
            return view('categories', ['name' => $admin->name , 'categories' => $categories]);
        } else {
            return redirect ("admin-login");
        }
    }

    public function logout(){
        Session::forget("admin");
        return redirect ("admin-login");
    }

    public function addCategory(Request $request){
        $validation = $request->validate([
            'category' => 'required | min:3 | max:20 | unique:categories,name',
        ]);
        $admin = Session::get("admin");
        $category = new Category();
        $category->name = $request->category;
        $category->creator = $admin->name;
        if($category->save()){
            Session::flash('category',"category".$request->category." added successfully");
        } else {
            return "Error";
        }
            return redirect ("admin-categories");
    }

    public function deleteCategory($id){
        $isdeleted = Category::find($id)->delete();
        if ($isdeleted) {
            Session::flash('category',"category deleted successfully");
        } else {
            return "Error";
        }
        return redirect ("admin-categories");
    }

public function addQuiz(Request $request)
{
    $admin = Session::get("admin");
    $totalMCQs = 0;

    if(!$admin){
        return redirect("admin-login");
    }

    $categories = Category::all();

    // Quiz creation form submitted
    if($request->isMethod('post')){

        $request->validate([
            'quiz' => 'required|min:3|max:100',
            'category' => 'required'
        ]);

        $quiz = new Quiz();

        $quiz->name = $request->quiz;
        $quiz->category_id = $request->category;

        if($quiz->save()){

            Session::put('quizDetails', $quiz);

            return redirect('/add-quiz');
        }

        return "Quiz could not be saved";
    }
    else{
    $quiz = Session::get('quizDetails');

    if($quiz){
        $totalMCQs = Mcq::where('quiz_id', $quiz->id)->count();
    }else{
        $totalMCQs = 0;
    }
}

    return view('add-quiz', [
        'name' => $admin->name,
        'categories' => $categories,
        'totalMCQs'=>$totalMCQs,
    ]);
}

public function addMCQs(Request $request){
    //return $request;

    $request -> validate([
        "question"=>"required | min:5",
        "a"=>"required",
        "b"=>"required ",
        "c"=>"required ",
        "d"=>"required ",
        "correct_ans"=>"required",

    ]);
    $mcq = new Mcq();
    $quiz = Session::get('quizDetails');
    $admin = Session::get("admin");
    $mcq->question = $request->question;
    $mcq->a = $request->a;
    $mcq->b = $request->b;
    $mcq->c = $request->c;
    $mcq->d = $request->d;
    $mcq->correct_ans = $request->correct_ans;
    //dd($admin);
    $mcq->admin_id = $admin->id;
    $mcq->quiz_id = $quiz->id;
    $mcq->category_id = $quiz->category_id;
    if ($mcq->save()){
        if ($request->submit=="add-more"){
            return redirect(url()->previous());
        }else{
            Session::forget('quizDetails');
            return redirect("/admin-categories");
        }
    }
}

public function endQuiz(){
    Session::forget('quizDetails');
            return redirect("/admin-categories");
}

public function showQuiz($id){
    $admin = Session::get("admin");
    $mcqs = Mcq::where('quiz_id',$id)->get();
    
    if($admin){
        return view('show-quiz',["name"=>$admin->name, "mcqs"=>$mcqs]);
    }else{
        return redirect ('admin-login');
    };
}

public function quizList($id,$category){
    $admin = Session::get("admin");
    
    if ($admin){
        $quizData = Quiz::where('category_id', $id)->get();
        return view ('quiz-list',['name'=>$admin->name, "quizData"=>$quizData, 'category'=>$category]);
    }else{
        return redirect('admin-login');
    }
}

}